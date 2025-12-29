<?php

namespace App\Controllers;

use Config\Database;

class AdminPromotionController extends BaseController
{
    public function index()
{
    $db = Database::connect();

    $currentYearId = (int) session()->get('academic_year_id');

    // Find NEXT academic year automatically
    $nextYear = $db->table('academic_years')
        ->where('id >', $currentYearId)
        ->orderBy('id', 'ASC')
        ->get()
        ->getRowArray();

    if (!$nextYear) {
        throw new \Exception('No next academic year found.');
    }

    // Distinct grades
    $grades = $db->table('classes')
        ->select('grade')
        ->distinct()
        ->orderBy('grade', 'ASC')
        ->get()
        ->getResultArray();

    return view('admin/promotions/index', [
        'currentYearId' => $currentYearId,
        'nextYear'      => $nextYear,
        'grades'        => $grades
    ]);
}

    public function preview()
{
    $db = Database::connect();

    $fromYear = (int) session()->get('academic_year_id');

    $toYear = $db->table('academic_years')
        ->where('id >', $fromYear)
        ->orderBy('id', 'ASC')
        ->get()
        ->getRowArray();

    if (!$toYear) {
        return $this->response->setJSON(['students' => []]);
    }

    $grade = (int) $this->request->getGet('grade');

    $students = $this->getPromotionCandidates($db, $fromYear, $grade);

    return $this->response->setJSON([
        'from_year' => $fromYear,
        'to_year'   => $toYear['id'],
        'students'  => $students
    ]);
}

    private function getPromotionCandidates($db, int $fromYear, int $grade)
{
    $rows = $db->table('student_enrollments se')
        ->select('
            se.student_id,
            se.class_id,
            c.grade,
            c.section,
            s.name AS student_name
        ')
        ->join('students s', 's.id = se.student_id')
        ->join('classes c', 'c.id = se.class_id')
        ->where('se.academic_year_id', $fromYear)
        ->where('se.status', 'active')
        ->where('c.grade', $grade)
        ->orderBy('s.name', 'ASC')
        ->get()
        ->getResultArray();

    return array_map(fn($r) => $this->buildPreviewRow($db, $r), $rows);
}



private function buildPreviewRow($db, array $row)
{
    $currentGrade = (int) $row['grade'];

    // 🔒 HARD RULE: Grade 12 defaults to GRADUATE
    if ($currentGrade === 12) {
        return [
            'student_id'       => (int) $row['student_id'],
            'student_name'     => $row['student_name'],
            'from_class'       => "Grade {$row['grade']} - {$row['section']}",
            'current_grade'    => $currentGrade,
            'current_class_id' => (int) $row['class_id'],
            'action'           => 'graduate',
            'target_class_id'  => null,
            'target_class'     => '-',
        ];
    }

    // ---------- Grades 1–11 ----------
    $nextGrade = $currentGrade + 1;

    $nextClass = $db->table('classes')
        ->where('grade', $nextGrade)
        ->where('section', $row['section'])
        ->get()->getRowArray();

    // Default: promote
    $action = 'promote';
    $targetClassId = null;
    $targetLabel = null;

    if ($nextClass) {
        $targetClassId = (int) $nextClass['id'];
        $targetLabel = "Grade {$nextGrade} - {$nextClass['section']}";
    } else {
        // No next class → repeat
        $action = 'repeat';
        $targetClassId = (int) $row['class_id'];
        $targetLabel = "Repeat: Grade {$row['grade']} - {$row['section']}";
    }

    return [
        'student_id'       => (int) $row['student_id'],
        'student_name'     => $row['student_name'],
        'from_class'       => "Grade {$row['grade']} - {$row['section']}",
        'current_grade'    => $currentGrade,
        'current_class_id' => (int) $row['class_id'],
        'action'           => $action,
        'target_class_id'  => $targetClassId,
        'target_class'     => $targetLabel,
    ];
}
public function process()
{
    $data = $this->request->getJSON(true);

    if (empty($data['students'])) {
        return $this->response
            ->setStatusCode(400)
            ->setJSON(['error' => 'No students provided']);
    }

    $fromYear = (int) session()->get('academic_year_id');
    $toYear   = $this->getNextAcademicYearId();

    return $this->runPromotion($fromYear, $toYear, $data['students']);
}


private function getNextAcademicYearId()
{
    $db = \Config\Database::connect();

    $currentYear = (int) session()->get('academic_year_id');

    $next = $db->table('academic_years')
        ->where('id >', $currentYear)
        ->orderBy('id', 'ASC')
        ->get()
        ->getRowArray();

    if (!$next) {
        throw new \Exception('No next academic year found');
    }

    return (int) $next['id'];
}

    private function runPromotion(int $fromYear, int $toYear, array $students)
    {
        $db = Database::connect();
        $db->transBegin();

        $summary = [
            'promoted'  => 0,
            'repeated'  => 0,
            'graduated' => 0,
            'skipped'   => 0,
            'errors'    => [],
        ];

        try {
            foreach ($students as $row) {
                // if UI sends "include=false"
                if (isset($row['include']) && $row['include'] == false) {
                    $summary['skipped']++;
                    continue;
                }

                $result = $this->processStudent($db, $row, $fromYear, $toYear);

                if ($result === 'promoted')  $summary['promoted']++;
                if ($result === 'repeated')  $summary['repeated']++;
                if ($result === 'graduated') $summary['graduated']++;
            }

            $db->transCommit();

            return $this->response->setJSON([
                'status'  => 'success',
                'message' => 'Promotion completed',
                'summary' => $summary
            ]);
        } catch (\Throwable $e) {
            $db->transRollback();

            return $this->response->setStatusCode(500)->setJSON([
                'status'  => 'error',
                'message' => $e->getMessage(),
                'summary' => $summary
            ]);
        }
    }

    private function processStudent($db, array $row, int $fromYear, int $toYear)
    {
        $studentId = (int) $row['student_id'];
        $action    = $row['action'] ?? 'promote';

        // Decide final status for the OLD enrollment
        $statusMap = [
            'promote'   => 'promoted',
            'repeat'    => 'repeated',
            'graduate'  => 'graduated',
        ];
        $oldStatus = $statusMap[$action] ?? 'promoted';

        // Close old active enrollment
        $db->table('student_enrollments')
            ->where('student_id', $studentId)
            ->where('academic_year_id', $fromYear)
            ->where('status', 'active')
            ->update(['status' => $oldStatus]);

        // Graduate => no new enrollment
       if ($action === 'graduate') {

    // 1️⃣ Close enrollment
    $db->table('student_enrollments')
        ->where('student_id', $studentId)
        ->where('academic_year_id', $fromYear)
        ->update(['status' => 'graduated']);

    // 2️⃣ Insert into graduates table
    $db->table('graduates')->insert([
        'student_id'         => $studentId,
        'graduation_year_id' => $fromYear,
        'final_class_id'     => $row['current_class_id'],
        'graduated_at'       => date('Y-m-d H:i:s'),
    ]);

    // 3️⃣ Mark student inactive
    $db->table('students')
        ->where('id', $studentId)
        ->update(['status' => 'graduated', 'class_id' => null]);

    return 'graduated';
}

        // Determine target class:
        // repeat => same class, promote => target_class_id
        if ($action === 'repeat') {
            $targetClassId = (int) ($row['current_class_id'] ?? 0);
        } else {
            $targetClassId = (int) ($row['target_class_id'] ?? 0);
        }

        if (!$targetClassId) {
            throw new \Exception("Missing target class for student {$studentId}");
        }

        // Prevent duplicates in target year
        $exists = $db->table('student_enrollments')
            ->where('student_id', $studentId)
            ->where('academic_year_id', $toYear)
            ->get()->getRowArray();

        if ($exists) {
            throw new \Exception("Student {$studentId} already enrolled in target year");
        }

        // Insert new active enrollment in target year
        $db->table('student_enrollments')->insert([
            'student_id'       => $studentId,
            'class_id'         => $targetClassId,
            'academic_year_id' => $toYear,
            'status'           => 'active',
            'created_at'       => date('Y-m-d H:i:s'),
        ]);

        // Update student's current class_id (so student sees grade change)
        $db->table('students')
            ->where('id', $studentId)
            ->update(['class_id' => $targetClassId]);

        return ($action === 'repeat') ? 'repeated' : 'promoted';
    }
}