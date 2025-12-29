<?php
$current = service('uri')->getSegment(2);

// Helper to detect active link
function isActive($segment, $current)
{
    return $segment === $current ? 'active' : '';
}

// ✅ READ FROM SESSION
$currentClassId = session('teacher_current_class_id');
$currentSubject = session('teacher_current_subject');
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title><?= $title ?? 'Teacher Panel' ?></title>

<style>
/* ===== GLOBAL ===== */
* { box-sizing: border-box; }

body {
    margin: 0;
    font-family: "Segoe UI", Arial, sans-serif;
    background: linear-gradient(135deg, #cfe9f7, #eef3f8);
}

/* ===== LAYOUT ===== */
.wrapper {
    display: flex;
    min-height: 100vh;
    padding: 30px;
}

.container {
    display: flex;
    width: 100%;
    background: rgba(255,255,255,0.7);
    border-radius: 24px;
    backdrop-filter: blur(14px);
    overflow: hidden;
    box-shadow: 0 20px 40px rgba(0,0,0,0.08);
}

/* ===== SIDEBAR ===== */
.sidebar {
    width: 240px;
    background: linear-gradient(180deg, #eaf2fb, #f5f9fd);
    padding: 25px 20px;
    display: flex;
    flex-direction: column;
    border-right: 1px solid rgba(0,0,0,0.05);
}

.sidebar h2 {
    margin: 0 0 25px 10px;
    color: #1e293b;
    font-size: 22px;
}

.disabled-link {
    pointer-events: none;
    opacity: .45;
    filter: grayscale(20%);
}

/* Sidebar links */
.sidebar a {
    color: #7dace6ff;
    text-decoration: none;
    padding: 10px 14px;
    border-radius: 10px;
    margin-bottom: 6px;
    display: block;
    font-weight: 500;
    transition: all 0.2s ease;
}

.sidebar a:hover {
    background: rgba(255,255,255,0.3);
}

/* ACTIVE LINK */
.sidebar a.active {
    background: linear-gradient(135deg, #2563eb, #1d4ed8);
    color: white;
    font-weight: 700;
    box-shadow: 0 8px 20px rgba(37,99,235,0.35);
}

/* Logout */
.sidebar .logout {
    margin-top: auto;
    background: #fee2e2;
    color: #b91c1c;
    text-align: center;
    font-weight: 600;
}

.sidebar .logout:hover {
    background: #fecaca;
}

/* ===== MAIN CONTENT ===== */
.main {
    flex: 1;
    padding: 35px;
    overflow-y: auto;
}

.main h1 {
    margin-top: 0;
    color: #1e293b;
}

/* ===== CARDS ===== */
.card {
    background: white;
    padding: 24px;
    border-radius: 16px;
    box-shadow: 0 14px 30px rgba(0,0,0,0.08);
    margin-bottom: 30px;
}

/* ===== TABLE ===== */
table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 12px;
}

th, td {
    padding: 12px;
    text-align: center;
    border-bottom: 1px solid #e5e7eb;
}

th {
    background: #2563eb;
    color: white;
}

/* ===== BUTTONS ===== */
.btn {
    display: inline-block;
    padding: 8px 14px;
    border-radius: 8px;
    background: #2563eb;
    color: white;
    text-decoration: none;
    font-weight: 600;
}

.btn:hover {
    background: #1d4ed8;
}

/* ===== ATTENDANCE TABLE ===== */
.attendance-table {
    width: 100%;
    border-collapse: separate;
    border-spacing: 0;
    margin-top: 16px;
    border-radius: 14px;
    overflow: hidden;
}

.attendance-table th {
    background: linear-gradient(135deg, #2563eb, #1d4ed8);
    color: white;
    padding: 14px;
    font-weight: 600;
    text-align: center;
}

.attendance-table td {
    padding: 14px;
    text-align: center;
    background: #ffffff;
    border-bottom: 1px solid #e5e7eb;
}

.attendance-table tr:hover td {
    background: #f8fafc;
}

/* Student name column */
.attendance-table .student-name {
    text-align: left;
    font-weight: 600;
    color: #1e293b;
}

/* Radio buttons hidden */
.attendance-table input[type="radio"] {
    display: none;
}

/* Status buttons */
.status-label {
    display: inline-block;
    padding: 8px 14px;
    border-radius: 999px;
    cursor: pointer;
    font-weight: 600;
    font-size: 14px;
    transition: all 0.2s ease;
    border: 2px solid transparent;
}

/* Present */
.status-present {
    background: #ecfdf5;
    color: #047857;
    border-color: #6ee7b7;
}

input[type="radio"]:checked + .status-present {
    background: #10b981;
    color: white;
    border-color: #059669;
}

/* Absent */
.status-absent {
    background: #fef2f2;
    color: #b91c1c;
    border-color: #fecaca;
}

input[type="radio"]:checked + .status-absent {
    background: #ef4444;
    color: white;
    border-color: #dc2626;
}

/* Late */
.status-late {
    background: #fffbeb;
    color: #92400e;
    border-color: #fde68a;
}

input[type="radio"]:checked + .status-late {
    background: #f59e0b;
    color: white;
    border-color: #d97706;
}



/* ===== ATTENDANCE HISTORY TABLE ===== */
.history-table {
    width: 100%;
    border-collapse: separate;
    border-spacing: 0;
    border-radius: 14px;
    overflow: hidden;
    margin-top: 10px;
}

.history-table th {
    background: linear-gradient(135deg, #2563eb, #1d4ed8);
    color: white;
    padding: 14px;
    text-align: center;
    font-weight: 600;
}

.history-table td {
    padding: 14px;
    background: #ffffff;
    border-bottom: 1px solid #e5e7eb;
    text-align: center;
}

.history-table tr:hover td {
    background: #f8fafc;
}

.history-table .student-name {
    text-align: left;
    font-weight: 600;
    color: #1e293b;
}

/* Styled select */
.status-select {
    padding: 8px 14px;
    border-radius: 999px;
    font-weight: 600;
    border: 2px solid transparent;
    cursor: pointer;
    appearance: none;
    text-align: center;
}

/* Status colors */
.status-select.present {
    background: #ecfdf5;
    color: #047857;
    border-color: #6ee7b7;
}

.status-select.absent {
    background: #fef2f2;
    color: #b91c1c;
    border-color: #fecaca;
}

.status-select.late {
    background: #fffbeb;
    color: #92400e;
    border-color: #fde68a;
}



/* ===== ATTENDANCE HISTORY TABLE ===== */
.history-table {
    width: 100%;
    border-collapse: separate;
    border-spacing: 0;
    border-radius: 14px;
    overflow: hidden;
}

.history-table th {
    background: linear-gradient(135deg, #2563eb, #1d4ed8);
    color: white;
    padding: 14px;
    font-weight: 600;
    text-align: center;
}

.history-table td {
    padding: 14px;
    background: white;
    border-bottom: 1px solid #e5e7eb;
    text-align: center;
}

.history-table tr:hover td {
    background: #f8fafc;
}

/* ===== FORM STYLES ===== */
.form-group {
    margin-bottom: 18px;
}

.form-group label {
    display: block;
    font-weight: 600;
    margin-bottom: 6px;
    color: #1e293b;
}

.form-group input,
.form-group select,
.form-group textarea {
    width: 100%;
    padding: 12px 14px;
    border-radius: 12px;
    border: 1px solid #e5e7eb;
    font-size: 14px;
    background: white;
    transition: border 0.2s ease, box-shadow 0.2s ease;
}

.form-group input:focus,
.form-group select:focus,
.form-group textarea:focus {
    outline: none;
    border-color: #2563eb;
    box-shadow: 0 0 0 3px rgba(37,99,235,0.15);
}

.form-row {
    display: grid;
    grid-template-columns: 2fr 1fr;
    gap: 20px;
}

/* ===== MODERN TABLE ===== */
.table-wrapper {
    overflow-x: auto;
}

.modern-table {
    width: 100%;
    border-collapse: separate;
    border-spacing: 0;
    font-size: 14px;
}

.modern-table thead th {
    background: linear-gradient(135deg, #2563eb, #1d4ed8);
    color: white;
    padding: 14px;
    text-align: center;
    font-weight: 600;
    position: sticky;
    top: 0;
}

.modern-table tbody td {
    padding: 14px;
    text-align: center;
    background: white;
    border-bottom: 1px solid #e5e7eb;
}

.modern-table tbody tr:hover {
    background: #f8fafc;
}

/* Student name emphasis */
.student-name {
    text-align: left;
    font-weight: 600;
    color: #1e293b;
}

/* Total score highlight */
.total-score {
    font-weight: 700;
    color: #2563eb;
}

/* Comment styling */
.comment-cell {
    text-align: left;
    color: #475569;
    font-style: italic;
}

/* ===== GRADE ENTRY TABLE ===== */
.table-wrapper {
    overflow-x: auto;
}

.modern-table {
    width: 100%;
    border-collapse: separate;
    border-spacing: 0;
    font-size: 14px;
}

.modern-table thead th {
    background: linear-gradient(135deg, #2563eb, #1d4ed8);
    color: white;
    padding: 14px;
    text-align: center;
    font-weight: 600;
}

.modern-table tbody td {
    padding: 12px;
    border-bottom: 1px solid #e5e7eb;
    background: white;
}

.modern-table tbody tr:hover {
    background: #f8fafc;
}

/* Student name */
.student-name {
    font-weight: 600;
    color: #1e293b;
}

/* Inputs */
.grade-input {
    width: 70px;
    padding: 6px 8px;
    border-radius: 8px;
    border: 1px solid #d1d5db;
    text-align: center;
}

.grade-input:focus {
    outline: none;
    border-color: #2563eb;
    box-shadow: 0 0 0 2px rgba(37,99,235,0.2);
}

/* Total */
.total-input {
    width: 70px;
    padding: 6px 8px;
    border-radius: 8px;
    border: none;
    background: #eff6ff;
    font-weight: 700;
    color: #2563eb;
    text-align: center;
}

/* Comment */
.comment-input {
    width: 100%;
    padding: 6px 10px;
    border-radius: 8px;
    border: 1px solid #d1d5db;
}

/* Term select */
.term-select {
    padding: 8px 12px;
    border-radius: 8px;
    border: 1px solid #d1d5db;
}

.academic-year-badge {
    background: #e0f2fe;
    color: #0369a1;
    padding: 6px 12px;
    border-radius: 8px;
    font-weight: 600;
    margin-bottom: 12px;
}
</style>
</head>

<body>

<div class="wrapper">
<div class="container">

<aside class="sidebar">
    <h2>Teacher</h2>

    <div class="academic-year-badge">
    Academic Year:
    <strong><?= session('academic_year_name') ?></strong>
</div>

    <a class="<?= isActive('dashboard', $current) ?>"
       href="<?= site_url('teacher/dashboard') ?>">
        Dashboard
    </a>

    <?php $disabled = !$currentClassId ? 'disabled-link' : ''; ?>

    <a class="<?= isActive('attendance', $current) ?> <?= $disabled ?>"
       href="<?= $currentClassId ? site_url('teacher/attendance/'.$currentClassId) : '#' ?>">
        Take Attendance
    </a>

    <a class="<?= isActive('attendance-history', $current) ?> <?= $disabled ?>"
       href="<?= $currentClassId ? site_url('teacher/attendance-history/'.$currentClassId) : '#' ?>">
        Attendance History
    </a>

    <a class="<?= isActive('class-students', $current) ?> <?= $disabled ?>"
       href="<?= $currentClassId ? site_url('teacher/class-students/'.$currentClassId) : '#' ?>">
        View Students
    </a>

    <a class="<?= isActive('homework', $current) ?> <?= $disabled ?>"
       href="<?= $currentClassId ? site_url('teacher/homework/create?class='.$currentClassId) : '#' ?>">
        Create Homework
    </a>

    <a class="<?= isActive('homework', $current) ?> <?= $disabled ?>"
       href="<?= $currentClassId ? site_url('teacher/homework/list?class='.$currentClassId) : '#' ?>">
        View Homeworks
    </a>

    <?php $gradesDisabled = (!$currentClassId || !$currentSubject) ? 'disabled-link' : ''; ?>

    <a class="<?= isActive('grades', $current) ?> <?= $gradesDisabled ?>"
       href="<?= ($currentClassId && $currentSubject)
            ? site_url('teacher/grades/'.$currentClassId.'/'.$currentSubject)
            : '#' ?>">
        Enter Grades
    </a>

    <a class="<?= isActive('grades', $current) ?> <?= $gradesDisabled ?>"
       href="<?= ($currentClassId && $currentSubject)
            ? site_url('teacher/grades/view/'.$currentClassId.'/'.$currentSubject)
            : '#' ?>">
        View Grades
    </a>

    <a class="<?= isActive('messages', $current) ?> <?= $disabled ?>"
       href="<?= $currentClassId ? site_url('teacher/messages/'.$currentClassId) : '#' ?>">
        Messages
    </a>

    <a class="logout" href="<?= site_url('teacher/logout') ?>">
        Logout
    </a>
</aside>

<!-- ===== MAIN CONTENT ===== -->
<main class="main">
    <?= $this->renderSection('content') ?>
</main>

</div>
</div>

</body>
</html>