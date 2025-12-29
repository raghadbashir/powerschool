<?php

namespace App\Controllers;
use CodeIgniter\Exceptions\PageNotFoundException; 

use App\Models\StudentModel;

class Admin extends BaseController
{
   public function dashboard()
{
    $db = \Config\Database::connect();

    $studentModel = new \App\Models\StudentModel();
    $parentModel  = new \App\Models\ParentModel();
    $teacherModel = new \App\Models\TeacherModel();
    $classModel   = new \App\Models\ClassModel();
    $subjectModel = new \App\Models\SubjectModel();

    
    // Class sizes
    $classSizes = $this->getClassSizes();

    // Recent students (with grade + section)
    $recentStudents = $db->table('students')
        ->select('students.*, classes.grade, classes.section')
        ->join('classes', 'classes.id = students.class_id', 'left')
        ->orderBy('students.id', 'DESC')
        ->limit(5)
        ->get()
        ->getResultArray();

    // Recent teachers
    $recentTeachers = $this->getRecentTeachers();

    // Recent assignments
    $recentAssignments = $this->getRecentAssignments();

    // Classes with student count (for dashboard cards)
    $classes = $db->table('classes c')
        ->select('c.*, COUNT(s.id) as student_count')
        ->join('students s', 's.class_id = c.id', 'left')
        ->groupBy('c.id')
        ->orderBy('c.grade', 'ASC')
        ->orderBy('c.section', 'ASC')
        ->get()
        ->getResultArray();

    // Prepare data array
    $data = [
        'students_count'     => $studentModel->countAll(),
        'parents_count'      => $parentModel->countAll(),
        'teachers_count'     => $teacherModel->countAll(),
        'classes_count'      => $classModel->countAll(),
        'classSizes'         => $classSizes,
        'recentStudents'     => $recentStudents,
        'recentTeachers'     => $recentTeachers,
        'recentAssignments'  => $recentAssignments,
        'classes'            => $classes,  // NEW
        'subjects_count' => $subjectModel->countAll(),
    ];

    return view('admin/dashboard', $data);
}


public function students()
{
    $studentModel = new \App\Models\StudentModel();
    $parentModel  = new \App\Models\ParentModel();
    $classModel   = new \App\Models\ClassModel();

$students = $studentModel
    ->where('status', 'active')
    ->findAll();
    foreach ($students as &$s) {

        // Parent
        if ($s['parent_id']) {
            $parent = $parentModel->find($s['parent_id']);
            $s['parent_name'] = $parent['parent_name'] ?? 'Not Assigned';
        } else {
            $s['parent_name'] = 'Not Assigned';
        }

        // Class
        if ($s['class_id']) {
            $class = $classModel->find($s['class_id']);
            if ($class) {
                $s['class_grade']   = $class['grade'];
                $s['class_section'] = $class['section'];
                $s['class_name']    = 'Grade '.$class['grade'].' - '.$class['section'];
            }
        }
    }

    return view('admin/students_list', ['students' => $students]);
}


public function addStudentForm()
{
    $parentModel = new \App\Models\ParentModel();
    $classModel  = new \App\Models\ClassModel();

    return view('admin/add_student', [
        'parents'    => $parentModel->findAll(),
        'classes'    => $classModel->findAll(),
        'validation' => session()->getFlashdata('validation')
    ]);
}

public function saveStudent()
{
    $db = \Config\Database::connect();
    $studentModel = new StudentModel();

    // 🔐 SERVER-SIDE VALIDATION
    $rules = [
        'student_number' => [
            'rules'  => 'required|numeric|min_length[5]|max_length[10]|is_unique[students.student_number]',
            'errors' => [
                'required'  => 'Student number is required.',
                'numeric'   => 'Student number must be numeric.',
                'is_unique' => 'This student number already exists.'
            ]
        ],
        'name' => [
            'rules'  => 'required|min_length[3]|max_length[100]',
            'errors' => [
                'required' => 'Student name is required.'
            ]
        ],
        'date_of_birth' => [
            'rules'  => 'required|valid_date',
            'errors' => [
                'required' => 'Date of birth is required.'
            ]
        ],
        'parent_id' => [
            'rules'  => 'required|is_not_unique[parents.id]',
            'errors' => [
                'required' => 'Please select a parent.'
            ]
        ],
        'class_id' => [
            'rules'  => 'required|is_not_unique[classes.id]',
            'errors' => [
                'required' => 'Please select a class.'
            ]
        ]
    ];

    // 🚫 BLOCK INVALID / CONSOLE DATA
    if (! $this->validate($rules)) {
        return redirect()
            ->back()
            ->withInput()
            ->with('validation', $this->validator);
    }

    // ✅ SAFE TO CONTINUE
    $currentYearId = session()->get('academic_year_id');
    if (!$currentYearId) {
        return redirect()->back()->with('error', 'No active academic year.');
    }

    $db->transBegin();

    try {
        // 🔒 WHITELISTED DATA ONLY
        $studentData = [
            'student_number' => $this->request->getPost('student_number'),
            'name'           => $this->request->getPost('name'),
            'date_of_birth'  => $this->request->getPost('date_of_birth'),
            'parent_id'      => $this->request->getPost('parent_id'),
            'class_id'       => $this->request->getPost('class_id'),
            'status'         => 'active', // forced by backend
        ];

        $studentModel->insert($studentData);
        $studentId = $studentModel->getInsertID();

        // Create enrollment
        $db->table('student_enrollments')->insert([
            'student_id'       => $studentId,
            'class_id'         => $studentData['class_id'],
            'academic_year_id' => $currentYearId,
            'status'           => 'active',
            'created_at'       => date('Y-m-d H:i:s'),
        ]);

        $db->transCommit();

        return redirect()->to('/admin/students')
            ->with('success', 'Student added successfully!');
    } catch (\Throwable $e) {
        $db->transRollback();
        return redirect()->back()->with('error', 'Something went wrong.');
    }
}
public function editStudent($id)
{
    $studentModel = new StudentModel();
    $parentModel  = new \App\Models\ParentModel();
    $classModel   = new \App\Models\ClassModel();

    return view('admin/edit_student', [
        'student' => $studentModel->find($id),
        'parents' => $parentModel->findAll(),
        'classes' => $classModel->findAll(),
    ]);
}
public function updateStudent($id)
{
    $studentModel    = new \App\Models\StudentModel();
    $enrollmentModel = new \App\Models\StudentEnrollmentModel();

    $classId = $this->request->getPost('class_id');
    $yearId  = session()->get('academic_year_id');

    // 1️⃣ Update student profile
    $studentModel->update($id, [
        'student_number' => $this->request->getPost('student_number'),
        'name'           => $this->request->getPost('name'),
        'date_of_birth'  => $this->request->getPost('date_of_birth'),
        'parent_id'      => $this->request->getPost('parent_id'),
        'class_id'       => $classId,
    ]);

    // 2️⃣ Update ACTIVE enrollment class for current year
    $enrollmentModel
        ->where('student_id', $id)
        ->where('academic_year_id', $yearId)
        ->where('status', 'active')
        ->set(['class_id' => $classId])
        ->update();

    return redirect()->to('/admin/students')
        ->with('success', 'Student updated successfully!');
}


public function deleteStudent($id)
{
    $studentModel    = new \App\Models\StudentModel();
    $enrollmentModel = new \App\Models\StudentEnrollmentModel();

    $db = \Config\Database::connect();
    $db->transBegin();

    try {
        // delete enrollments first
        $enrollmentModel->where('student_id', $id)->delete();
        $studentModel->delete($id);

        $db->transCommit();
        return redirect()->to('/admin/students')
            ->with('success', 'Student deleted successfully!');

    } catch (\Throwable $e) {
        $db->transRollback();
        return redirect()->back()
            ->with('error', 'Delete failed');
    }
}



public function parents()
{
    $parentModel = new \App\Models\ParentModel();
    $parents = $parentModel->findAll();

    return view('admin/parents_list', ['parents' => $parents]);
}

public function addParentForm()
{
    return view('admin/add_parent');
}



public function saveParent()
{
    $parentModel = new \App\Models\ParentModel();

    $data = [
        'parent_name' => $this->request->getPost('parent_name'),
        'email'       => $this->request->getPost('email'),
        'phone'       => $this->request->getPost('phone'),
    ];

    $parentModel->insert($data);

    return redirect()->to('/admin/parents')->with('success', 'Parent added successfully!');
}


public function editParent($id)
{
    $parentModel = new \App\Models\ParentModel();
    $parent = $parentModel->find($id);

    return view('admin/edit_parent', ['parent' => $parent]);
}


public function updateParent($id)
{
    $parentModel = new \App\Models\ParentModel();

    $data = [
        'parent_name' => $this->request->getPost('parent_name'),
        'email'       => $this->request->getPost('email'),
        'phone'       => $this->request->getPost('phone'),
    ];

    $parentModel->update($id, $data);

    return redirect()->to('/admin/parents')->with('success', 'Parent updated successfully!');
}

public function deleteParent($id)
{
    $parentModel = new \App\Models\ParentModel();
    $parentModel->delete($id);

    return redirect()->to('/admin/parents')->with('success', 'Parent deleted successfully!');
}







public function teachers()
{
    $teacherModel = new \App\Models\TeacherModel();
    $teachers = $teacherModel->findAll();

    return view('admin/teachers_list', ['teachers' => $teachers]);
}


public function addTeacherForm()
{
    return view('admin/add_teacher');
}



public function saveTeacher()
{
    $teacherModel = new \App\Models\TeacherModel();
    $userModel = new \App\Models\UserModel();

    $name  = $this->request->getPost('name');
    $email = $this->request->getPost('email');
    $phone = $this->request->getPost('phone');

    // --- Create login user ---
    $userData = [
        'username' => $name,     // username = name
        'email'    => $email,    // store email correctly
        'password' => null,      // teacher will set password later
        'role'     => 'teacher'
    ];

    $userModel->insert($userData);
    $userId = $userModel->getInsertID();

    // --- Create teacher profile ---
    $teacherData = [
        'name'           => $name,
        'email'          => $email,
        'phone'          => $phone,
        'specialization' => $this->request->getPost('specialization'),
        'gender'         => $this->request->getPost('gender'),
        'hire_date'      => $this->request->getPost('hire_date'),
    ];

    $teacherModel->insert($teacherData);

    return redirect()->to('/admin/teachers')->with('success', 'Teacher added successfully!');
}
// ========================
// EDIT TEACHER
// ========================
public function editTeacher($id)
{
    $teacherModel = new \App\Models\TeacherModel();
    $teacher = $teacherModel->find($id);

    return view('admin/edit_teacher', ['teacher' => $teacher]);
}


// ========================
// UPDATE TEACHER
// ========================
public function updateTeacher($id)
{
    $teacherModel = new \App\Models\TeacherModel();

    $data = [
        'name'            => $this->request->getPost('name'),
        'email'           => $this->request->getPost('email'),
        'phone'           => $this->request->getPost('phone'),
        'specialization'  => $this->request->getPost('specialization'),
        'gender'          => $this->request->getPost('gender'),
        'hire_date'       => $this->request->getPost('hire_date'),
    ];

    $teacherModel->update($id, $data);

    return redirect()->to('/admin/teachers')->with('success', 'Teacher updated successfully!');
}


// ========================
// DELETE TEACHER
// ========================
public function deleteTeacher($id)
{
    $teacherModel = new \App\Models\TeacherModel();
    $teacherModel->delete($id);

    return redirect()->to('/admin/teachers')->with('success', 'Teacher deleted successfully!');
}











// -------------------- CLASSES ------------------------

public function classes()
{
    $db = \Config\Database::connect();

    // Get all classes
    $classes = $db->table('classes')->get()->getResultArray();

    $studentModel = new \App\Models\StudentModel();

    foreach ($classes as &$c) {
        // Count students by class_id NOT grade/section
        $c['student_count'] = $studentModel
            ->where('class_id', $c['id'])
            ->countAllResults();
    }

    return view('admin/classes_list', ['classes' => $classes]);
}


public function addClassForm()
{
    return view('admin/add_class');
}

public function saveClass()
{
    $model = new \App\Models\ClassModel();

    $data = [
        'grade' => $this->request->getPost('grade'),
        'section' => $this->request->getPost('section'),
    ];

    $model->insert($data);

    return redirect()->to('admin/classes')->with('success', 'Class added!');
}

// ========================
// EDIT CLASS
// ========================
public function editClass($id)
{
    $classModel = new \App\Models\ClassModel();
    $class = $classModel->find($id);

    return view('admin/edit_class', ['class' => $class]);
}


// ========================
// UPDATE CLASS
// ========================
public function updateClass($id)
{
    $classModel = new \App\Models\ClassModel();

    $data = [
        'grade'   => $this->request->getPost('grade'),
        'section' => $this->request->getPost('section'),
    ];

    $classModel->update($id, $data);

    return redirect()->to('/admin/classes')->with('success', 'Class updated successfully!');
}


// ========================
// DELETE CLASS
// ========================
public function deleteClass($id)
{
    $classModel = new \App\Models\ClassModel();
    $classModel->delete($id);

    return redirect()->to('/admin/classes')->with('success', 'Class deleted successfully!');
}





//class teachers
public function assignTeacherForm()
{
    $classModel = new \App\Models\ClassModel();
    $teacherModel = new \App\Models\TeacherModel();

    return view('admin/assign_teacher', [
        'classes' => $classModel->findAll(),
        'teachers' => $teacherModel->findAll()
    ]);
}

public function saveAssignment()
{
    $model = new \App\Models\ClassTeacherModel();

    $data = [
        'class_id' => $this->request->getPost('class_id'),
        'teacher_id' => $this->request->getPost('teacher_id')
    ];

    $model->insert($data);

    return redirect()->to('/admin/assign-teacher')->with('success', 'Teacher assigned successfully!');
}







public function manageTeaching()
{
    $teacherModel = new \App\Models\TeacherModel();
    $classModel   = new \App\Models\ClassModel();
    $assignModel  = new \App\Models\TeacherClassSubjectModel();

    $data = [
        'teachers' => $teacherModel->findAll(),
        'classes'  => $classModel->findAll(),
        'assignments' => $assignModel->findAll()
    ];

    return view('admin/manage_teaching', $data);
}



public function saveTeaching()
{
    $assignModel = new \App\Models\TeacherClassSubjectModel();

    $data = [
        'teacher_id' => $this->request->getPost('teacher_id'),
        'class_id'   => $this->request->getPost('class_id'),
        'subject'    => $this->request->getPost('subject'),
    ];

    $assignModel->insert($data);

    return redirect()->to('/admin/manage-teaching')
                     ->with('success', 'Teaching assignment added!');
}


public function deleteTeaching($id)
{
    $assignModel = new \App\Models\TeacherClassSubjectModel();
    $assignModel->delete($id);

    return redirect()->to('/admin/manage-teaching');
}




//for stats

public function getClassSizes()
{
    $db = \Config\Database::connect();

    // Join classes with students to count students per class
    $query = $db->query("
        SELECT 
            c.id,
            c.grade,
            c.section,
            COUNT(s.id) AS student_count
        FROM classes c
        LEFT JOIN students s ON s.class_id = c.id
        GROUP BY c.id, c.grade, c.section
        ORDER BY c.grade, c.section
    ");

    return $query->getResultArray();
}

public function getRecentStudents()
{
    $studentModel = new \App\Models\StudentModel();
    return $studentModel->orderBy('created_at', 'DESC')
                        ->limit(5)
                        ->findAll();
}

public function getRecentTeachers()
{
    $teacherModel = new \App\Models\TeacherModel();
    return $teacherModel->orderBy('created_at', 'DESC')
                        ->limit(5)
                        ->findAll();
}

public function getRecentAssignments()
{
    $db = \Config\Database::connect();

    $query = $db->query("
        SELECT t.name AS teacher_name,
               c.grade,
               c.section,
               a.subject,
               a.created_at
        FROM teacher_class_subject a
        JOIN teachers t ON t.id = a.teacher_id
        JOIN classes c ON c.id = a.class_id
        ORDER BY a.created_at DESC
        LIMIT 5
    ");

    return $query->getResultArray();
}








////class details





public function classDetails($id)
    {
        $classModel   = new \App\Models\ClassModel();
        $studentModel = new \App\Models\StudentModel();
        $assignModel  = new \App\Models\TeacherClassSubjectModel();
        $teacherModel = new \App\Models\TeacherModel();

        // 1) Get the class itself
        $class = $classModel->find($id);
        if (!$class) {
            throw PageNotFoundException::forPageNotFound('Class not found');
        }

        // 2) Get students in this class
        $students = $studentModel
            ->where('class_id', $id)
            ->orderBy('name', 'ASC')
            ->findAll();

        // 3) Get teacher assignments for this class
        $assignments = $assignModel
            ->select('teacher_class_subject.*, teachers.name AS teacher_name, teachers.specialization')
            ->join('teachers', 'teachers.id = teacher_class_subject.teacher_id', 'left')
            ->where('teacher_class_subject.class_id', $id)
            ->orderBy('teachers.name', 'ASC')
            ->findAll();

        $data = [
            'class'         => $class,
            'students'      => $students,
            'student_count' => count($students),
            'assignments'   => $assignments,
        ];

        return view('admin/class_details', $data);
    }











//subjects
public function subjects()
{
    $model = new \App\Models\SubjectModel();
    $subjects = $model->findAll();

    return view('admin/subjects_list', ['subjects' => $subjects]);
}

public function addSubjectForm()
{
    return view('admin/add_subject');
}


public function saveSubject()
{
    $model = new \App\Models\SubjectModel();

    $data = [
        'name' => $this->request->getPost('name'),
        'code' => $this->request->getPost('code'),
    ];

    $model->insert($data);

    return redirect()->to('/admin/subjects')->with('success', 'Subject added!');
}

public function deleteSubject($id)
{
    $model = new \App\Models\SubjectModel();
    $model->delete($id);

    return redirect()->to('/admin/subjects')->with('success', 'Subject deleted!');
}













//timetable

public function manageTimetable()
{
    $class_id = $this->request->getGet('class_id');

    $periodModel = new \App\Models\TimetablePeriodModel();
    $db = \Config\Database::connect();

    // All subjects taught to this class
    $subjects = $db->table('teacher_class_subject')
        ->select('teacher_class_subject.id AS tcs_id,
                  teacher_class_subject.subject,
                  teacher_class_subject.teacher_id,
                  teachers.name AS teacher_name')
        ->join('teachers', 'teachers.id = teacher_class_subject.teacher_id')
        ->where('teacher_class_subject.class_id', $class_id)
        ->get()
        ->getResultArray();

    // Load saved timetable entries
   // Load saved timetable entries WITH teacher name
$yearId = session()->get('academic_year_id');

$entries = $db->table('timetable_entries te')
    ->select('te.*, teachers.name AS teacher_name')
    ->join('teachers', 'teachers.id = te.teacher_id', 'left')
    ->where('te.class_id', $class_id)
    ->where('te.academic_year_id', $yearId) // ✅ FILTER
    ->get()
    ->getResultArray();

    return view('admin/manage_timetable', [
        'periods'  => $periodModel->findAll(),
        'subjects' => $subjects,
        'entries'  => $entries,     // <---- NEW
        'class_id' => $class_id,
    ]);
}

public function saveTimetableEntry()
{
   $json = $this->request->getJSON(true);

    $entryModel = new \App\Models\TimetableEntryModel();

   
    $data = [
        'class_id'         => $json['class_id'],
        'period_id'        => $json['period_id'],
        'subject'          => $json['subject'],
        'tcs_id'           => $json['tcs_id'],
        'teacher_id'       => $json['teacher_id'],
        'day'              => $json['day'],
        'academic_year_id' => session()->get('academic_year_id'), // ✅ HERE
    ];

    // Insert
    if ($entryModel->insert($data)) {
        return $this->response->setJSON(['status' => 'success']);
    } else {
        return $this->response->setJSON([
            'status' => 'error',
            'message' => $entryModel->errors()

        ]);
    }
}


public function reportCardClasses()
{
    $db = \Config\Database::connect();

    $classes = $db->table('classes')->get()->getResultArray();

    return view('admin/reportcards_select', [
        'classes' => $classes
    ]);
}

public function reportCardStudents($classId)
{
    $db = \Config\Database::connect();

    $students = $db->table('students')
        ->where('class_id', $classId)
        ->orderBy('name', 'ASC')
        ->get()
        ->getResultArray();

    return view('admin/reportcard_students', [
        'students' => $students,
        'classId'  => $classId
    ]);
}

public function generateReportCards($classId, $term)
{
    $db = \Config\Database::connect();

    $students = $db->table('students')
        ->where('class_id', $classId)
        ->get()
        ->getResultArray();

    $subjects = $db->table('teacher_class_subject tcs')
        ->select('tcs.subject')
        ->where('tcs.class_id', $classId)
        ->groupBy('tcs.subject')
        ->get()
        ->getResultArray();

    $grades = $db->table('grades')
        ->where('class_id', $classId)
        ->where('term', $term)
        ->get()
        ->getResultArray();

    $gradeMap = [];
    foreach ($grades as $g) {
        $gradeMap[$g['student_id']][$g['subject']] = $g;
    }

    return view('admin/reportcards_preview', [
        'students' => $students,
        'subjects' => $subjects,
        'gradeMap' => $gradeMap,
        'term'     => $term,
        'classId'  => $classId
    ]);
}


public function issueReportCard()
{
    $classId = $this->request->getPost('class_id');
    $term    = $this->request->getPost('term');

    $db = \Config\Database::connect();

    $db->table('grades')
        ->where('class_id', $classId)
        ->where('term', $term)
        ->update(['is_issued' => 1]);

    return redirect()->back()
        ->with('success', 'Report cards issued successfully');
}

}






