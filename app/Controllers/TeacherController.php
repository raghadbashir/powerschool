<?php

namespace App\Controllers;

use App\Models\TeacherModel;
use App\Models\ClassTeacherModel;
use App\Models\TimetableEntryModel;
use App\Models\TimetablePeriodModel;

class TeacherController extends BaseController

{ private function requireTeacher()
    {
        if (!session()->get('logged_in') || session()->get('role') !== 'teacher') {
            return redirect()->to('/teacher/login');
        }
        return null;
    }

   public function dashboard()
    {
        if ($resp = $this->requireTeacher()) return $resp;

        $db = \Config\Database::connect();

        $teacherId = session()->get('teacher_id');

        $teacher = $db->table('teachers')
            ->where('id', $teacherId)
            ->get()
            ->getRowArray();

        if (!$teacher) {
            session()->destroy();
            return redirect()->to('/teacher/login');
        }

        // Assigned classes + subjects
    $yearId = session()->get('academic_year_id');

$assignments = $db->table('teacher_class_subject tcs')
    ->select([
        'tcs.class_id',
        'tcs.subject AS subject_name', // ✅ subject is TEXT
        'tcs.teacher_id',
        'c.grade',
        'c.section'
    ])
    ->join('classes c', 'c.id = tcs.class_id', 'left')
    ->where('tcs.teacher_id', $teacherId)
    ->where('tcs.academic_year_id', $yearId)
    ->get()
    ->getResultArray();

$timetable = (new TimetableEntryModel())
    ->where('teacher_id', $teacherId)
    ->where('academic_year_id', $yearId) // ✅ FILTER
    ->orderBy('day', 'ASC')
    ->orderBy('period_id', 'ASC')
    ->findAll();
        $periods = (new TimetablePeriodModel())->findAll();

        return view('teacher/dashboard', [
            'teacher'     => $teacher,
            'assignments' => $assignments,
            'timetable'   => $timetable,
            'periods'     => $periods
        ]);
    }



    // ============================================================
    // ATTENDANCE — SHOW FORM
    // ============================================================
    public function classAttendance($classId)
    {
        $db = \Config\Database::connect();

      

        // Fetch class info
        $class = $db->table('classes')->where('id', $classId)->get()->getRowArray();

        // Fetch students in this class
        $students = $db->table('students')
            ->where('class_id', $classId)
            ->orderBy('name', 'ASC')
            ->get()
            ->getResultArray();

        return view('teacher/attendance_form', [
            'class'    => $class,
            'students' => $students,
            'date'     => date('Y-m-d')
        ]);
    }




   // ============================================================
    // ATTENDANCE
    // ============================================================
    public function submitAttendance($classId)
    {
        if (!session()->get('teacher_id')) {
    return redirect()->to('/teacher/login');
}

        $attendanceModel = new \App\Models\AttendanceModel();

        foreach ($this->request->getPost('status') as $studentId => $status) {
           $attendanceModel->insert([
    'student_id'        => $studentId,
    'class_id'          => $classId,
    'teacher_id'        => session()->get('teacher_id'),
    'academic_year_id'  => session()->get('academic_year_id'),
    'date'              => $this->request->getPost('date'),
    'status'            => $status
]);
        }

        return redirect()->back()->with('success', 'Attendance saved');
    }






public function attendanceHistory($classId)
{
    $db = \Config\Database::connect();

    // Get class info
    $class = $db->table('classes')
        ->where('id', $classId)
        ->get()
        ->getRowArray();

    // Get unique attendance dates
    $dates = $db->table('attendance')
    ->select('date')
    ->where('class_id', $classId)
    ->where('academic_year_id', session('academic_year_id'))
    ->groupBy('date')
    ->orderBy('date', 'DESC')
    ->get()
    ->getResultArray();

    return view('teacher/attendance_history', [
        'class' => $class,   // <-- THIS FIXES THE ERROR
        'dates' => $dates
    ]);
}




public function attendanceHistoryDetails($classId, $date)
{
    $db = \Config\Database::connect();

    // Fetch attendance records for that date & class
    $records = $db->table('attendance a')
        ->select('a.*, s.name AS student_name')
        ->join('students s', 's.id = a.student_id')
       ->where('a.class_id', $classId)
->where('a.academic_year_id', session('academic_year_id'))
->where('a.date', $date)
        ->get()
        ->getResultArray();

    // Fetch class info
    $class = $db->table('classes')
        ->where('id', $classId)
        ->get()
        ->getRowArray();

    return view('teacher/attendance_history_details', [
        'class'   => $class,
        'date'    => $date,
        'records' => $records
    ]);
}


public function updateAttendance($classId, $date)
{
    if (!session()->get('teacher_id')) {
    return redirect()->to('/teacher/login');
}

    $attendanceModel = new \App\Models\AttendanceModel();

    $statuses = $this->request->getPost('status');

    foreach ($statuses as $attendanceId => $status) {
        $attendanceModel->update($attendanceId, [
            'status' => $status
        ]);
    }

    return redirect()->back()->with('success', 'Attendance updated successfully!');
}





//to convert attendance to cvs


public function exportAttendance($classId, $date)
{
    $db = \Config\Database::connect();

    // Fetch attendance records
    $records = $db->table('attendance a')
        ->select('s.name AS student_name, a.status')
        ->join('students s', 's.id = a.student_id')
       ->where('a.class_id', $classId)
->where('a.academic_year_id', session('academic_year_id'))
->where('a.date', $date)
        ->orderBy('s.name', 'ASC')
        ->get()
        ->getResultArray();

    // Prepare CSV
    $filename = "attendance_{$classId}_{$date}.csv";

    header('Content-Type: text/csv');
    header("Content-Disposition: attachment; filename=$filename");

    $output = fopen('php://output', 'w');

    fputcsv($output, ['Student Name', 'Status']);

    foreach ($records as $r) {
        fputcsv($output, [$r['student_name'], $r['status']]);
    }

    fclose($output);
    exit;
}


public function classStudents($classId)
{
    $db = \Config\Database::connect();

    // Get class info
    $class = $db->table('classes')->where('id', $classId)->get()->getRowArray();

    // Get students
    $students = $db->table('students s')
        ->select('s.*, p.parent_name, p.phone AS parent_phone')
        ->join('parents p', 'p.id = s.parent_id', 'left')
        ->where('s.class_id', $classId)
        ->orderBy('s.name', 'ASC')
        ->get()
        ->getResultArray();

    return view('teacher/class_students', [
        'class'    => $class,
        'students' => $students
    ]);
}



 // ============================================================
    // CLASS MESSAGES
    // ============================================================
    public function viewMessages($classId)
    {
        if (!session()->get('teacher_id')) {
    return redirect()->to('/teacher/login');
}

        $teacherId = session()->get('teacher_id');
        $db = \Config\Database::connect();

        $class = $db->table('classes')->where('id', $classId)->get()->getRowArray();
$messages = $db->table('class_messages cm')
    ->select('cm.*, t.name AS teacher_name')
    ->join('teachers t', 't.id = cm.teacher_id')
    ->where('cm.class_id', $classId)
    ->where('cm.teacher_id', session()->get('teacher_id'))
    ->where('cm.academic_year_id', session()->get('academic_year_id')) // ✅ ADD THIS
    ->orderBy('cm.created_at', 'DESC')
    ->get()
    ->getResultArray();

        return view('teacher/messages', compact('class', 'messages'));
    }


public function addMessage($classId)
{
    if (!session()->get('teacher_id')) {
        return redirect()->to('/teacher/login');
    }

    $db = \Config\Database::connect();

    // OPTIONAL: get teacher name (safe)
    $teacher = $db->table('teachers')
        ->select('name')
        ->where('id', session()->get('teacher_id'))
        ->get()
        ->getRowArray();

    $teacherName = $teacher['name'] ?? 'Teacher';

   $db->table('class_messages')->insert([
    'teacher_id'       => session()->get('teacher_id'),
    'class_id'         => $classId,
    'academic_year_id' => session()->get('academic_year_id'), // ✅ ADD THIS
    'message'          => $this->request->getPost('message'),
    'created_at'       => date('Y-m-d H:i:s')
]);

    // 2️⃣ Get all students in the class
    $students = $db->table('students')
        ->where('class_id', $classId)
        ->get()
        ->getResultArray();

    // 3️⃣ Insert notification for each student
    foreach ($students as $student) {
        $db->table('notifications')->insert([
            'user_id'    => $student['id'],
            'type'       => 'class_message',
            'message'    => 'New class message from ' . $teacherName,
            'is_read'    => 0,
            'created_at'=> date('Y-m-d H:i:s')
        ]);
    }

    // 4️⃣ Redirect LAST
    return redirect()->to("/teacher/messages/$classId")
        ->with('success', 'Message posted!');
}





public function viewMaterials($classId)
{
    $db = \Config\Database::connect();

    // Class info
    $class = $db->table('classes')->where('id', $classId)->get()->getRowArray();

    // Get uploaded materials
    $materials = $db->table('class_materials')
        ->where('class_id', $classId)
        ->orderBy('created_at', 'DESC')
        ->get()
        ->getResultArray();

    return view('teacher/materials', [
        'class'     => $class,
        'materials' => $materials
    ]);
}

 // ============================================================
    // MATERIALS
    // ============================================================
    public function uploadMaterial($classId)
    {
        if (!session()->get('teacher_logged_in')) {
            return redirect()->to('/teacher/login');
        }

        $db = \Config\Database::connect();

        $file = $this->request->getFile('file');
        $path = null;

        if ($file && $file->isValid()) {
            $name = $file->getRandomName();
            $file->move('uploads/materials', $name);
            $path = "uploads/materials/$name";
        }

        $db->table('class_materials')->insert([
            'teacher_id' => session()->get('teacher_id'),
            'class_id'   => $classId,
            'title'      => $this->request->getPost('title'),
            'description'=> $this->request->getPost('description'),
            'file_path'  => $path
        ]);

        return redirect()->back()->with('success', 'Material uploaded');
    }



public function createHomeworkForm()
{
    $teacherId = session()->get('teacher_id');

    $db = \Config\Database::connect();

    // Get classes this teacher teaches
    $classes = $db->table('teacher_class_subject tcs')
        ->select('c.id, c.grade, c.section, tcs.subject')
        ->join('classes c', 'c.id = tcs.class_id')
        ->where('tcs.teacher_id', $teacherId)
        ->get()
        ->getResultArray();

    return view('teacher/homework_form', [
        'classes' => $classes
    ]);
}



public function saveHomework()
{
    $db = \Config\Database::connect();

    $data = [
    'class_id'         => $this->request->getPost('class_id'),
    'subject'          => $this->request->getPost('subject'),
    'title'            => $this->request->getPost('title'),
    'description'      => $this->request->getPost('description'),
    'due_datetime'     => $this->request->getPost('due_datetime'),
    'max_grade'        => $this->request->getPost('max_grade'),
    'teacher_id'       => session()->get('teacher_id'),
    'academic_year_id' => session()->get('academic_year_id'),
];

    // Handle file upload
    $file = $this->request->getFile('attachment');
    if ($file && $file->isValid()) {
        $newName = $file->getRandomName();
        $file->move('uploads/homework', $newName);
        $data['attachment'] = $newName;
    }

    // Insert ONLY ONCE
   // Insert homework
$db->table('homeworks')->insert($data);

// ============================
// CREATE NOTIFICATIONS
// ============================
$currentYearId = session()->get('academic_year_id');

// Get students in the class
$students = $db->table('students')
    ->where('class_id', $data['class_id'])
    ->get()
    ->getResultArray();

// Create notification for each student
foreach ($students as $student) {
    $db->table('notifications')->insert([
        'user_id'           => $student['id'],
        'user_type'         => 'student',              // optional but recommended
        'type'              => 'homework_assigned',
        'message'           => 'New homework assigned: ' . $data['title'],
        'academic_year_id'  => $currentYearId,         // ✅ THIS WAS MISSING
        'is_read'           => 0,
        'created_at'        => date('Y-m-d H:i:s'),
    ]);
}
// Get last inserted homework ID
$homeworkId = $db->insertID();

// Get students in the class
$students = $db->table('students')
    ->where('class_id', $data['class_id'])
    ->get()
    ->getResultArray();

// Create notification for each student
foreach ($students as $student) {
    $db->table('notifications')->insert([
        'user_id'    => $student['id'],
        'type'       => 'homework_assigned',
        'message'    => 'New homework assigned: ' . $data['title'],
        'is_read'    => 0,
        'created_at' => date('Y-m-d H:i:s'),
    ]);
}

return redirect()->to('/teacher/homework/list')
    ->with('success', 'Homework created!');
}



public function homeworkList()
{
    $teacherId = session()->get('teacher_id');
    $academicYearId = session()->get('academic_year_id');

    $db = \Config\Database::connect();

    $homeworks = $db->table('homeworks h')
        ->select('h.*, c.grade, c.section')
        ->join('classes c', 'c.id = h.class_id')
        ->where('h.teacher_id', $teacherId)

        // ✅ ADD THIS
        ->where('h.academic_year_id', $academicYearId)

        ->orderBy('h.due_datetime', 'ASC')
        ->get()
        ->getResultArray();

    return view('teacher/homework_list', [
        'homeworks' => $homeworks
    ]);
}



public function viewSubmissions($homeworkId)
{
    $db = \Config\Database::connect();

    // Get homework
   $homework = $db->table('homeworks')
    ->where('id', $homeworkId)
    ->where('academic_year_id', session()->get('academic_year_id'))
    ->get()
    ->getRowArray();
    // Get students in the class
    $students = $db->table('students s')
        ->select('s.id AS student_id, s.name AS student_name')
        ->where('s.class_id', $homework['class_id'])
        ->get()
        ->getResultArray();

    // Get submissions mapped by student_id
    $submissions = $db->table('homework_submissions')
        ->where('homework_id', $homeworkId)
        ->get()
        ->getResultArray();

    // Convert submissions to an associative array
    $map = [];
    foreach ($submissions as $sub) {
        $map[$sub['student_id']] = $sub;
    }

    // Merge students + submissions
    $result = [];
    foreach ($students as $s) {
        $sid = $s['student_id'];

       $result[] = [
    'student_id'     => $sid,
    'student_name'   => $s['student_name'],
    'submitted_file' => $map[$sid]['submitted_file'] ?? null,
];
    }

   return view('teacher/homework_submissions', [
    'homework'     => $homework,
    'students'     => $result  // This is the merged array your view expects
]);
}


public function enterGrades($classId, $subject)
{
    $db = \Config\Database::connect();
    $teacherId = session()->get('teacher_id');

    // Fetch students in class
    $students = $db->table('students')
        ->where('class_id', $classId)
        ->get()
        ->getResultArray();

    return view('teacher/enter_grades', [
        'classId' => $classId,
        'subject' => $subject,
        'students' => $students,
        'teacherId' => $teacherId
    ]);
}




public function saveGrades()
{
    $db = \Config\Database::connect();

    $classId   = $this->request->getPost('class_id');
    $subject   = $this->request->getPost('subject');
    $teacherId = session()->get('teacher_id');
    $term      = $this->request->getPost('term');

    $midterms  = $this->request->getPost('midterm');
    $finals    = $this->request->getPost('final');
    $comments  = $this->request->getPost('comment');

    // Get teacher name (optional but nice)
    $teacher = $db->table('teachers')
        ->select('name')
        ->where('id', $teacherId)
        ->get()
        ->getRowArray();

    $teacherName = $teacher['name'] ?? 'Teacher';

    foreach ($midterms as $studentId => $midterm) {

        $final   = $finals[$studentId] ?? null;
        $comment = $comments[$studentId] ?? null;
        $total   = (int)$midterm + (int)$final;

        // 1️⃣ Save or update grade
        $existing = $db->table('grades')
            ->where([
                'student_id' => $studentId,
                'class_id'   => $classId,
                'subject'    => $subject,
                'term'       => $term
            ])
            ->get()
            ->getRowArray();

        if ($existing) {
            $db->table('grades')->where('id', $existing['id'])->update([
                'midterm' => $midterm,
                'final'   => $final,
                'total'   => $total,
                'comment' => $comment
            ]);
        } else {
         $db->table('grades')->insert([
    'student_id'       => $studentId,
    'class_id'         => $classId,
    'academic_year_id' => session()->get('academic_year_id'),
    'subject'          => $subject,
    'term'             => $term,
    'midterm'          => $midterm,
    'final'            => $final,
    'total'            => $total,
    'comment'          => $comment
]);
        }

        // 2️⃣ CREATE NOTIFICATION (MIDTERM ONLY)
        if ($midterm !== null && $midterm !== '') {
            $db->table('notifications')->insert([
                'user_id'    => $studentId,
                'type'       => 'midterm_grade',
                'message'    => "Midterm grade posted for $subject",
                'is_read'    => 0,
                'created_at'=> date('Y-m-d H:i:s')
            ]);
        }
    }

    return redirect()->back()->with('success', 'Grades saved successfully!');
}





public function viewGrades($classId, $subject)
{
    $db = \Config\Database::connect();

    $grades = $db->table('grades g')
        ->select('g.*, s.name as student_name')
        ->join('students s', 's.id = g.student_id')
       ->where('g.class_id', $classId)
->where('g.subject', $subject)
->where('g.academic_year_id', session()->get('academic_year_id'))
        ->get()
        ->getResultArray();

    return view('teacher/view_grades', [
        'grades'  => $grades,
        'subject' => $subject,
        'classId' => $classId
    ]);
}




public function messageParentForm($studentId)
{
    if ($resp = $this->requireTeacher()) return $resp;

    $db = \Config\Database::connect();

    $student = $db->table('students')->where('id', $studentId)->get()->getRowArray();
    if (!$student) return redirect()->back();

    $parent = $db->table('parents')->where('id', $student['parent_id'])->get()->getRowArray();

    // 🔹 Fetch message history for this student
    $messages = $db->table('parent_teacher_messages')
        ->where('student_id', $studentId)
        ->orderBy('created_at', 'DESC')
        ->get()
        ->getResultArray();

    return view('teacher/message_parent_form', [
        'student'  => $student,
        'parent'   => $parent,
        'messages' => $messages
    ]);
}





public function sendMessageParent()
{
    $data = [
        'teacher_id'       => session('teacher_id'),
        'parent_id'        => $this->request->getPost('parent_id'),
        'student_id'       => $this->request->getPost('student_id'),
        'academic_year_id' => session()->get('academic_year_id'), // ✅ ADD THIS
        'subject'          => $this->request->getPost('subject'),
        'message'          => $this->request->getPost('message'),
        'is_read'          => 0,
        'created_at'       => date('Y-m-d H:i:s')
    ];

    $model = new \App\Models\ParentTeacherMessageModel();
    $model->insert($data);

    return redirect()->back()->with('success', 'Message sent successfully');
}
public function setCurrent()
{
    $classId = $this->request->getGet('class_id');
    $subject = $this->request->getGet('subject');

    if (!$classId || !$subject) {
        return redirect()->to('teacher/dashboard');
    }

    session()->set([
        'teacher_current_class_id' => $classId,
        'teacher_current_subject'  => $subject
    ]);

    return redirect()->to('teacher/dashboard');
}






 // ============================================================
    // LOGOUT (OPTIONAL)
    // ============================================================
    public function logout()
    {
        session()->remove(['teacher_logged_in', 'teacher_id', 'teacher_email']);
        return redirect()->to('/teacher/login');
    }







}