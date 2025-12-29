<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

$routes->get('/', 'Home::chooseRole');// HOME + ROLE CHOOSER



// $routes->get('/', 'Home::index');
$routes->get('choose-role', 'Home::chooseRole');

// ADMIN LOGIN (keep as /login)
$routes->get('login', 'Login::index');
$routes->post('login', 'Login::check');

// GLOBAL LOGOUT (redirects based on session role)
$routes->match(['get','post'], 'logout', 'Login::logout');

// STUDENT AUTH
$routes->get('student/login', 'StudentAuth::login');
$routes->post('student/login', 'StudentAuth::authenticate');
$routes->get('student/logout', 'StudentAuth::logout');

// PARENT AUTH
$routes->get('parent/login', 'ParentAuth::loginForm');
$routes->post('parent/login', 'ParentAuth::attemptLogin');
$routes->get('parent/logout', 'ParentAuth::logout');

// PARENT DASHBOARD
// PARENT DASHBOARD
$routes->get('parent/dashboard', 'ParentController::dashboard');
// TEACHER AUTH
$routes->get('teacher/login', 'TeacherAuth::login');
$routes->post('teacher/login', 'TeacherAuth::authenticate');
$routes->get('teacher/logout', 'TeacherAuth::logout');
$routes->get('/choose-role', 'Auth::chooseRole');

$routes->get('/signup', 'Signup::index');
$routes->post('/signup/submit', 'Signup::submit');
// DASHBOARDS
$routes->get('admin/dashboard', 'Admin::dashboard');
$routes->get('teacher/dashboard', 'TeacherController::dashboard');
$routes->get('student/dashboard', 'StudentController::dashboard');

// =======================================================
// 👨‍💼 ADMIN MANAGEMENT
// =======================================================
$routes->get('admin/students', 'Admin::students');
$routes->get('admin/add-student', 'Admin::addStudentForm');
$routes->post('admin/save-student', 'Admin::saveStudent');
$routes->get('admin/edit-student/(:num)', 'Admin::editStudent/$1');
$routes->post('admin/update-student/(:num)', 'Admin::updateStudent/$1');
$routes->get('admin/delete-student/(:num)', 'Admin::deleteStudent/$1');

$routes->get('admin/parents', 'Admin::parents');
$routes->get('admin/add-parent', 'Admin::addParentForm');
$routes->post('admin/save-parent', 'Admin::saveParent');

$routes->get('admin/teachers', 'Admin::teachers');
$routes->get('admin/add-teacher', 'Admin::addTeacherForm');
$routes->post('admin/save-teacher', 'Admin::saveTeacher');
$routes->get('admin/edit-teacher/(:num)', 'Admin::editTeacher/$1');
$routes->post('admin/update-teacher/(:num)', 'Admin::updateTeacher/$1');
$routes->get('admin/delete-teacher/(:num)', 'Admin::deleteTeacher/$1');
$routes->get('admin/delete-teaching/(:num)', 'Admin::deleteTeaching/$1');


// =======================================================
// 🏫 CLASSES & SUBJECTS
// =======================================================
$routes->get('admin/classes', 'Admin::classes');
$routes->get('admin/add-class', 'Admin::addClassForm');
$routes->post('admin/save-class', 'Admin::saveClass');
$routes->get('admin/edit-class/(:num)', 'Admin::editClass/$1');
$routes->post('admin/update-class/(:num)', 'Admin::updateClass/$1');
$routes->get('admin/delete-class/(:num)', 'Admin::deleteClass/$1');

$routes->get('admin/subjects', 'Admin::subjects');
$routes->get('admin/add-subject', 'Admin::addSubjectForm');
$routes->post('admin/save-subject', 'Admin::saveSubject');
$routes->get('admin/delete-subject/(:num)', 'Admin::deleteSubject/$1');


// =======================================================
// 📅 TIMETABLE
// =======================================================
$routes->get('admin/manage-timetable', 'Admin::manageTimetable');
$routes->post('admin/save-timetable-entry', 'Admin::saveTimetableEntry');


// =======================================================
// 👩‍🏫 TEACHER FEATURES
// =======================================================
$routes->get('teacher/attendance/(:num)', 'TeacherController::classAttendance/$1');
$routes->post('teacher/attendance/submit/(:num)', 'TeacherController::submitAttendance/$1');

$routes->get('teacher/attendance-history/(:num)', 'TeacherController::attendanceHistory/$1');
$routes->get('teacher/attendance-history/(:num)/(:segment)', 'TeacherController::attendanceHistoryDetails/$1/$2');
$routes->post('teacher/update-attendance/(:num)/(:segment)', 'TeacherController::updateAttendance/$1/$2');

$routes->get('teacher/export-attendance/(:num)/(:segment)', 'TeacherController::exportAttendance/$1/$2');
$routes->get('teacher/class-students/(:num)', 'TeacherController::classStudents/$1');

$routes->get('teacher/messages/(:num)', 'TeacherController::viewMessages/$1');
$routes->post('teacher/messages/add/(:num)', 'TeacherController::addMessage/$1');

$routes->get('teacher/materials/(:num)', 'TeacherController::viewMaterials/$1');
$routes->post('teacher/materials/upload/(:num)', 'TeacherController::uploadMaterial/$1');

$routes->get('teacher/homework/create', 'TeacherController::createHomeworkForm');
$routes->post('teacher/homework/save', 'TeacherController::saveHomework');
$routes->get('teacher/homework/list', 'TeacherController::homeworkList');
$routes->get('teacher/homework/submissions/(:num)', 'TeacherController::viewSubmissions/$1');

$routes->get('teacher/grades/(:num)/(:any)', 'TeacherController::enterGrades/$1/$2');
$routes->post('teacher/grades/save', 'TeacherController::saveGrades');
$routes->get('teacher/grades/view/(:num)/(:any)', 'TeacherController::viewGrades/$1/$2');

$routes->get('teacher/message-parent/(:num)', 'TeacherController::messageParentForm/$1');
$routes->post('teacher/message-parent/send', 'TeacherController::sendMessageToParent');


// =======================================================
// 🎒 STUDENT FEATURES
// =======================================================
$routes->get('student/homework/(:num)', 'StudentController::uploadHomework/$1');
$routes->post('student/homework/submit/(:num)', 'StudentController::submitHomework/$1');


// =======================================================
// 👨‍👩‍👧 PARENT FEATURES
// =======================================================
$routes->get('parent/messages', 'ParentController::messages');





// =========================
// Admin – Class Details
// =========================
$routes->get('admin/class-details/(:num)', 'Admin::classDetails/$1');

// =========================
// Admin – Report Cards
// =========================
$routes->get('admin/report-cards', 'Admin::reportCardClasses');
$routes->get('admin/report-cards/classes', 'Admin::reportCardClasses');
$routes->get('admin/report-cards/students/(:num)', 'Admin::reportCardStudents/$1');
$routes->get('admin/report-cards/generate/(:num)/(:any)', 'Admin::generateReportCards/$1/$2');


$routes->get('admin/manage-teaching', 'Admin::manageTeaching');

$routes->post('admin/save-teaching', 'Admin::saveTeaching');


$routes->get('admin/edit-parent/(:num)', 'Admin::editParent/$1');
$routes->post('admin/update-parent/(:num)', 'Admin::updateParent/$1');

$routes->get('admin/class/(:num)', 'Admin::classDetails/$1');



//hhhhhh
 $routes->get('dashboard', 'TeacherController::dashboard');

    // ✅ NEW: set current class/subject in session
$routes->post('teacher/set-current', 'TeacherController::setCurrent');


// Student Homework Upload
$routes->get('student/homework/upload/(:num)', 'StudentController::uploadHomeworkForm/$1');
$routes->post('student/homework/upload/(:num)', 'StudentController::submitHomework/$1');


$routes->get('student/grades', 'StudentController::grades');
$routes->get('student/messages', 'StudentController::messages');
$routes->get('student/attendance', 'StudentController::attendance');
$routes->get('student/homework', 'StudentController::homework');


$routes->get('parent/grades/(:num)', 'ParentController::grades/$1');

$routes->get('parent/attendance/(:num)', 'ParentController::attendance/$1');
$routes->get('parent/homework/(:num)', 'ParentController::homework/$1');
$routes->get('parent/messages', 'ParentController::messages');
$routes->post('parent/select-child', 'ParentController::selectChild');


$routes->get('teacher/set-current', 'TeacherController::setCurrent');

$routes->post('teacher/send-message-parent', 'TeacherController::sendMessageParent');


$routes->get('admin/academic-years', 'AdminAcademicYears::index');
$routes->post('admin/academic-years/store', 'AdminAcademicYears::store');
$routes->get('admin/academic-years/activate/(:num)', 'AdminAcademicYears::activate/$1');


$routes->get('admin/academic-years/activate/(:num)', 'Admin::activateAcademicYear/$1');

$routes->get('admin/promotions/preview', 'AdminPromotionController::preview');


$routes->get('admin/promotions', 'AdminPromotionController::index');
$routes->get('admin/promotions/preview', 'AdminPromotionController::preview');
$routes->post('admin/promotions/process', 'AdminPromotionController::process');


$routes->get('admin/graduates', 'AdminGraduatesController::index');

$routes->get('admin/graduated-students', 'AdminGraduatesController::index');

// Report Cards (Admin)
$routes->get('admin/report-cards', 'Admin::reportCardClasses');
$routes->get('admin/report-cards/students/(:num)', 'Admin::reportCardStudents/$1');
$routes->get(
    'admin/report-cards/generate/(:num)/(:any)',
    'Admin::generateReportCards/$1/$2'
);

$routes->get('student/report-card', 'StudentController::reportCard');

$routes->post('admin/issue-report-card', 'Admin::issueReportCard');