<?php

namespace App\Controllers;

use App\Models\ParentModel;
use App\Models\StudentModel;
use App\Models\AttendanceModel;
use App\Models\GradeModel;
use App\Models\HomeworkModel;
use App\Models\HomeworkSubmissionModel;
use App\Models\ParentTeacherMessageModel;

class ParentController extends BaseController
{
   public function dashboard()
{
    if (!session()->get('parent_logged_in')) {
        return redirect()->to('parent/login');
    }

    $parentId = session()->get('parent_id');

    $parentModel  = new ParentModel();
    $studentModel = new StudentModel();

    $parent = $parentModel->find($parentId);
    $attendanceModel = new AttendanceModel();

    $children = $studentModel
    ->select('students.*, classes.grade, classes.section')
    ->join('classes', 'classes.id = students.class_id')
    ->where('students.parent_id', $parentId)
    ->findAll();
      // 🔹 Attendance summary per child
    foreach ($children as &$child) {

        $totalDays = $attendanceModel
            ->where('student_id', $child['id'])
            ->countAllResults();

        $present = $attendanceModel
            ->where('student_id', $child['id'])
            ->where('status', 'present')
            ->countAllResults();

        $absent = $attendanceModel
            ->where('student_id', $child['id'])
            ->where('status', 'absent')
            ->countAllResults();

        $late = $attendanceModel
            ->where('student_id', $child['id'])
            ->where('status', 'late')
            ->countAllResults();

        $attendanceRate = $totalDays > 0
            ? round(($present / $totalDays) * 100)
            : 0;

        // attach summary to child
        $child['attendance'] = [
            'total' => $totalDays,
            'present' => $present,
            'absent' => $absent,
            'late' => $late,
            'rate' => $attendanceRate
        ];
    }

    return view('parent/dashboard', [
        'parent'   => $parent,
        'children' => $children
    ]);

    
}

public function grades($studentId)
{
    if (!session()->get('parent_logged_in')) {
        return redirect()->to('/parent/login');
    }

    $parentId = session()->get('parent_id');
    $academicYearId = session()->get('academic_year_id');

    $studentModel = new \App\Models\StudentModel();
    $gradeModel   = new \App\Models\GradeModel();

    // 1️⃣ Ensure student belongs to this parent (NO academic year here)
    $student = $studentModel
        ->where('id', $studentId)
        ->where('parent_id', $parentId)
        ->first();

    if (!$student) {
        return redirect()->to('/parent/dashboard')
            ->with('error', 'Unauthorized access');
    }

    // 2️⃣ Fetch grades filtered by academic year
    $grades = $gradeModel
        ->where('student_id', $studentId)
        ->where('academic_year_id', $academicYearId)
        ->orderBy('created_at', 'DESC')
        ->findAll();

    return view('parent/grades', [
        'student' => $student,
        'grades'  => $grades
    ]);
}
public function attendance($studentId)
{
    // 1. Auth check
    if (!session()->get('parent_logged_in')) {
        return redirect()->to('/parent/login');
    }

    $parentId = session()->get('parent_id');

    $studentModel = new StudentModel();
    $attendanceModel = new AttendanceModel();

    // 2. Ensure student belongs to this parent
    $student = $studentModel
        ->where('id', $studentId)
        ->where('parent_id', $parentId)
        ->first();

    if (!$student) {
        return redirect()->to('/parent/dashboard')
            ->with('error', 'Unauthorized access');
    }

    // 3. Fetch attendance
    $attendance = $attendanceModel
->where('student_id', $studentId)
->where('academic_year_id', session('academic_year_id'))        ->orderBy('date', 'DESC')
        ->findAll();

    return view('parent/attendance', [
        'student'    => $student,
        'attendance' => $attendance
    ]);
}



public function homework($studentId)
{
    if (!session()->get('parent_logged_in')) {
        return redirect()->to('/parent/login');
    }

    $parentId = session()->get('parent_id');

    $studentModel = new StudentModel();
    $homeworkModel = new HomeworkModel();
    $submissionModel = new HomeworkSubmissionModel();

    // 1️⃣ Ensure student belongs to parent
    $student = $studentModel
        ->where('id', $studentId)
        ->where('parent_id', $parentId)
        ->first();

    if (!$student) {
        return redirect()->to('/parent/dashboard')
            ->with('error', 'Unauthorized access');
    }

    // 2️⃣ Fetch homework for student's class
   // 2️⃣ Fetch homework for student's class (FILTER BY ACADEMIC YEAR)
$homeworks = $homeworkModel
    ->where('class_id', $student['class_id'])
    ->where('academic_year_id', session()->get('academic_year_id')) // ✅ ADD THIS
    ->orderBy('due_datetime', 'ASC')
    ->findAll();

    // 3️⃣ Attach submission status
    foreach ($homeworks as &$hw) {
        $submission = $submissionModel
            ->where('homework_id', $hw['id'])
            ->where('student_id', $studentId)
            ->first();

        $hw['submitted'] = $submission ? true : false;
        $hw['submitted_at'] = $submission['submitted_at'] ?? null;
    }

    return view('parent/homework', [
        'student' => $student,
        'homeworks' => $homeworks
    ]);
}



public function messages()
{
    if (!session()->get('parent_logged_in')) {
        return redirect()->to('/parent/login');
    }

    $parentId  = session()->get('parent_id');
    $studentId = session()->get('parent_active_child_id'); // ✅ from dashboard
    $yearId    = session()->get('academic_year_id');

    if (!$studentId) {
        return redirect()->to('/parent/dashboard')
            ->with('error', 'Please select a student first.');
    }

    $db = \Config\Database::connect();

    // 🔹 Mark messages as READ for this student
    $db->table('parent_teacher_messages')
        ->where('parent_id', $parentId)
        ->where('student_id', $studentId)
        ->where('is_read', 0)
        ->update([
            'is_read' => 1,
            'read_at' => date('Y-m-d H:i:s')
        ]);

    // 🔹 Fetch messages ONLY for selected student
    $messages = $db->table('parent_teacher_messages ptm')
        ->select('ptm.*, s.name AS student_name')
        ->join('students s', 's.id = ptm.student_id')
        ->where('ptm.parent_id', $parentId)
        ->where('ptm.student_id', $studentId)
        ->where('ptm.academic_year_id', $yearId)
        ->orderBy('ptm.created_at', 'DESC')
        ->get()
        ->getResultArray();

    return view('parent/messages', [
        'messages' => $messages
    ]);
}

public function selectChild()
{
    $childId = $this->request->getPost('child_id');

    if ($childId) {
        session()->set('parent_active_child_id', $childId);
    }

    return redirect()->back();
}
}