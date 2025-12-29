<?php

namespace App\Controllers;

use CodeIgniter\Controller;

class StudentController extends Controller
{
    // ============================================================
    // DASHBOARD
    // ============================================================
    
       private function requireStudent()
    {
        if (!session()->get('logged_in') || session()->get('role') !== 'student') {
            return redirect()->to('/student/login');
        }
        return null;
    }

    public function dashboard()
    {
        if ($resp = $this->requireStudent()) return $resp;

        $db = \Config\Database::connect();

        $studentId = session()->get('student_id');
        $currentYearId = (int) session()->get('academic_year_id');

// active enrollment this year
$currentEnroll = $db->table('student_enrollments se')
    ->select('se.*, c.grade, c.section')
    ->join('classes c', 'c.id = se.class_id', 'left')
    ->where('se.student_id', $studentId)
    ->where('se.academic_year_id', $currentYearId)
    ->where('se.status', 'active')
    ->get()->getRowArray();

    

// last year enrollment result (latest enrollment that is NOT active)
$lastResult = $db->table('student_enrollments se')
    ->select('se.academic_year_id, se.status, c.grade, c.section')
    ->join('classes c', 'c.id = se.class_id', 'left')
    ->where('se.student_id', $studentId)
    ->where('se.academic_year_id <', $currentYearId)
    ->orderBy('se.academic_year_id', 'DESC')
    ->get()->getRowArray();

        $student = $db->table('students s')
            ->select('s.*, c.grade, c.section')
            ->join('classes c', 'c.id = s.class_id', 'left')
            ->where('s.id', $studentId)
            ->get()
            ->getRowArray();

        if (!$student) {
            session()->destroy();
            return redirect()->to('/student/login');
        }



        $periods = $db->table('timetable_periods')->orderBy('id', 'ASC')->get()->getResultArray();
        $yearId = session()->get('academic_year_id');

        $entries = $db->table('timetable_entries te')
    ->select('te.*, teachers.name AS teacher_name')
    ->join('teachers', 'teachers.id = te.teacher_id', 'left')
    ->where('te.class_id', $student['class_id'])
    ->where('te.academic_year_id', $yearId)
    ->get()
    ->getResultArray();

        $days = ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday'];
        $timetableGrid = [];
        foreach ($periods as $period) {
            foreach ($days as $day) $timetableGrid[$period['id']][$day] = '';
        }
        foreach ($entries as $row) {
            if (isset($timetableGrid[$row['period_id']][$row['day']])) {
                $timetableGrid[$row['period_id']][$row['day']] = $row['subject'];
            }
        }

        $attendance = $db->table('attendance')
            ->where('student_id', $student['id'])
            ->orderBy('date', 'DESC')
            ->get()
            ->getResultArray();

        $totalDays = count($attendance);
        $presentDays = 0;
        $absentDays = 0;

        foreach ($attendance as $a) {
            if ($a['status'] === 'present') $presentDays++;
            if ($a['status'] === 'absent')  $absentDays++;
        }

        $attendancePercentage = $totalDays > 0 ? round(($presentDays / $totalDays) * 100, 2) : 0;
        $recentAttendance = array_slice($attendance, 0, 10);

        $notifications = $db->table('notifications')
    ->where('user_id', $studentId)               // ✅ correct column
    ->where('academic_year_id', $currentYearId)  // ✅ year filtering
    ->orderBy('created_at', 'DESC')
    ->limit(6)
    ->get()
    ->getResultArray();
            



// =======================
// CLASS MESSAGES (Teacher → Students)
// =======================

        return view('student/dashboard', [
            'student'           => $student,
            'periods'           => $periods,
            'timetableGrid'     => $timetableGrid,
            'attendance'        => $attendance,
            'recentAttendance'  => $recentAttendance,
            'totalDays'         => $totalDays,
            'presentDays'       => $presentDays,
            'absentDays'        => $absentDays,
            'attendancePercent' => $attendancePercentage,
            'notifications'     => $notifications,
            'currentEnroll' => $currentEnroll,
'lastResult'    => $lastResult,
        ]);
    }

   
public function uploadHomeworkForm($homeworkId)
{
    if ($resp = $this->requireStudent()) return $resp;

    $db = \Config\Database::connect();
    $studentId = session()->get('student_id');
    $academicYearId = session()->get('academic_year_id');

    // Homework info (FILTER BY YEAR ✅)
    $homework = $db->table('homeworks')
        ->where('id', $homeworkId)
        ->where('academic_year_id', $academicYearId)
        ->get()
        ->getRowArray();

    if (!$homework) {
        return redirect()->to('/student/dashboard')
            ->with('error', 'Homework not available for this academic year');
    }

    // Check if already submitted
    $existing = $db->table('homework_submissions')
        ->where('homework_id', $homeworkId)
        ->where('student_id', $studentId)
        ->get()
        ->getRowArray();

    return view('student/upload_homework', [
        'homework' => $homework,
        'existing' => $existing
    ]);
}



public function submitHomework($homeworkId)
{
    if ($resp = $this->requireStudent()) return $resp;

    $studentId = session()->get('student_id');
    $academicYearId = session()->get('academic_year_id');
    $db = \Config\Database::connect();

    // 🔒 Validate homework belongs to active year
    $homework = $db->table('homeworks')
        ->where('id', $homeworkId)
        ->where('academic_year_id', $academicYearId)
        ->get()
        ->getRowArray();

    if (!$homework) {
        return redirect()->to('/student/dashboard')
            ->with('error', 'Invalid homework for this academic year');
    }

    $file = $this->request->getFile('submission');

    if (!$file || !$file->isValid()) {
        return redirect()->back()->with('error', 'Invalid file');
    }

    $newName = $file->getRandomName();
    $file->move('uploads/homework_submissions', $newName);

    // Prevent duplicate submissions
    $exists = $db->table('homework_submissions')
        ->where('homework_id', $homeworkId)
        ->where('student_id', $studentId)
        ->where('academic_year_id', $academicYearId)
        ->get()
        ->getRowArray();

    if ($exists) {
        $db->table('homework_submissions')
            ->where('id', $exists['id'])
            ->update([
                'submitted_file' => 'uploads/homework_submissions/' . $newName,
                'submitted_at'   => date('Y-m-d H:i:s')
            ]);
    } else {
        $db->table('homework_submissions')->insert([
            'homework_id'      => $homeworkId,
            'student_id'       => $studentId,
            'academic_year_id' => $academicYearId, // ✅ IMPORTANT
            'submitted_file'   => 'uploads/homework_submissions/' . $newName,
            'submitted_at'     => date('Y-m-d H:i:s')
        ]);
    }

    return redirect()->to('/student/dashboard')
        ->with('success', 'Homework submitted successfully');
}


public function grades()
{
    if ($resp = $this->requireStudent()) return $resp;

    $db = \Config\Database::connect();
    $studentId = session()->get('student_id');

    // Get student info (for class_id)
    $student = $db->table('students')
        ->where('id', $studentId)
        ->get()
        ->getRowArray();

    if (!$student) {
        session()->destroy();
        return redirect()->to('/student/login');
    }

    // Fetch MIDTERM grades only
    $grades = $db->table('grades g')
        ->select('
            g.subject,
            g.midterm,
            g.term,
            g.comment,
            t.name AS teacher_name
        ')
        ->join('teachers t', 't.id = g.teacher_id', 'left')
        ->where('g.student_id', $studentId)
        ->where('g.midterm IS NOT NULL')
            ->where('g.academic_year_id', session()->get('academic_year_id'))

        ->orderBy('g.created_at', 'DESC')
        ->get()
        ->getResultArray();

    return view('student/grades', [
        'grades' => $grades
    ]);
}



public function messages()
{
    if ($resp = $this->requireStudent()) return $resp;

    $db = \Config\Database::connect();
    $studentId = session()->get('student_id');

    // Get student (to know class_id)
    $student = $db->table('students')
        ->where('id', $studentId)
        ->get()
        ->getRowArray();

    if (!$student) {
        session()->destroy();
        return redirect()->to('/student/login');
    }

    // Get class info
    $class = $db->table('classes')
        ->where('id', $student['class_id'])
        ->get()
        ->getRowArray();

    // Get messages for this class
    $messages = $db->table('class_messages cm')
        ->select('cm.message, cm.created_at, t.name AS teacher_name')
        ->join('teachers t', 't.id = cm.teacher_id', 'left')
        ->where('cm.class_id', $student['class_id'])
        ->orderBy('cm.created_at', 'DESC')
        ->get()
        ->getResultArray();

    return view('student/messages', [
        'class'    => $class,
        'messages' => $messages
    ]);
}

public function attendance()
{
    if ($resp = $this->requireStudent()) return $resp;

    $db = \Config\Database::connect();
    $studentId = session()->get('student_id');

    $student = $db->table('students')
        ->where('id', $studentId)
        ->get()
        ->getRowArray();

   $attendance = $db->table('attendance')
    ->where('student_id', $studentId)
    ->where('academic_year_id', session('academic_year_id'))
    ->orderBy('date', 'DESC')
    ->get()
    ->getResultArray();

    return view('student/attendance', [
        'student'    => $student,
        'attendance' => $attendance
    ]);
}
public function homework()
{
    if ($resp = $this->requireStudent()) return $resp;

    $db = \Config\Database::connect();
    $studentId = session()->get('student_id');
    $academicYearId = session()->get('academic_year_id');

    $student = $db->table('students')
        ->where('id', $studentId)
        ->get()
        ->getRowArray();

    if (!$student) {
        return redirect()->to('/student/dashboard');
    }

    $homework = $db->table('homeworks h')
        ->select('h.*, s.submitted_file, s.submitted_at')
        ->join(
            'homework_submissions s',
            's.homework_id = h.id AND s.student_id = ' . (int)$studentId,
            'left'
        )
        ->where('h.class_id', $student['class_id'])
        ->where('h.academic_year_id', $academicYearId) // ✅ THIS IS THE KEY LINE
        ->orderBy('h.due_datetime', 'ASC')
        ->get()
        ->getResultArray();

    return view('student/homework', [
        'homework' => $homework
    ]);
}
public function reportCard()
{
    $studentId = session()->get('student_id');

    $db = \Config\Database::connect();

    $grades = $db->table('grades')
        ->where('student_id', $studentId)
        ->where('is_issued', 1) // 🔒 KEY LINE
        ->orderBy('term', 'ASC')
        ->get()
        ->getResultArray();

    return view('student/report_card', [
        'grades' => $grades
    ]);
}
    // ============================================================
    // LOGOUT
    // ============================================================
    public function logout()
    {
        session()->remove(['student_logged_in', 'student_id']);
        return redirect()->to('/student/login');
    }
}