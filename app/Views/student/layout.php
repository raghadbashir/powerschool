<?php
$current = service('uri')->getSegment(2);
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title><?= $title ?? 'Student Panel' ?></title>

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

.sidebar a {
    color: #7dace6ff;
    text-decoration: none;
    padding: 10px 14px;
    border-radius: 10px;
    margin-bottom: 6px;
    display: block;
    font-weight: 500;
}

.sidebar a:hover {
    background: rgba(255,255,255,0.2);
}

.sidebar a.active {
    background: linear-gradient(135deg, #2563eb, #1d4ed8);
    color: white;
    font-weight: 700;
    box-shadow: 0 8px 20px rgba(37,99,235,0.35);
}


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

/* ===== MAIN ===== */
.main {
    flex: 1;
    padding: 35px;
    overflow-y: auto;
}

.main h1 {
    margin-top: 0;
    color: #1e293b;
}

/* ===== ENHANCED TABLE ===== */
.table-card {
    background: white;
    border-radius: 16px;
    padding: 20px;
    box-shadow: 0 14px 30px rgba(0,0,0,0.08);
}

.table-card table {
    width: 100%;
    border-collapse: collapse;
}

.table-card th {
    background: linear-gradient(135deg, #2563eb, #1d4ed8);
    color: white;
    font-weight: 600;
    padding: 14px;
}

.table-card td {
    padding: 14px;
    text-align: center;
    color: #1f2937;
}

.table-card tr:hover td {
    background: #f8fafc;
}

/* ===== STATUS BADGES ===== */
.status {
    padding: 6px 12px;
    border-radius: 999px;
    font-size: 13px;
    font-weight: 600;
    display: inline-block;
}

.status.submitted {
    background: #dcfce7;
    color: #166534;
}

.status.pending {
    background: #e0f2fe;
    color: #075985;
}

.status.late {
    background: #fee2e2;
    color: #991b1b;
}

.status.closed {
    background: #f1f5f9;
    color: #475569;
}

/* Upload button */
.action-link {
    display: inline-block;
    padding: 6px 12px;
    border-radius: 8px;
    background: #2563eb;
    color: white;
    font-weight: 600;
    text-decoration: none;
}

.action-link:hover {
    background: #1d4ed8;
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

/* ===== BUTTON ===== */
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


/* ===== DASHBOARD TOP GRID ===== */
.dashboard-top {
    display: grid;
    grid-template-columns: 1fr 1fr;   /* two equal columns */
    gap: 30px;
    margin-bottom: 30px;
}

/* Make both cards same height */
.student-info-card,
.notifications-card {
    height: 260px;        /* square-ish size */
    display: flex;
    flex-direction: column;
}

/* Notifications scrolling if too many */
.notifications-card {
    overflow-y: auto;
}

/* Notification items */
.notification-item {
    padding: 12px 14px;
    margin-bottom: 10px;
    border-left: 4px solid #2563eb;
    background: #f8fafc;
    border-radius: 8px;
}

/* Smaller text spacing */
.notification-item small {
    color: #64748b;
    font-size: 12px;
}


/* ===== ATTENDANCE TABLE ===== */
.table-card {
    background: white;
    border-radius: 16px;
    padding: 20px;
    box-shadow: 0 14px 30px rgba(0,0,0,0.08);
}

.table-card table {
    width: 100%;
    border-collapse: collapse;
}

.table-card th {
    background: linear-gradient(135deg, #2563eb, #1d4ed8);
    color: white;
    font-weight: 600;
    padding: 14px;
    text-align: center;
}

.table-card td {
    padding: 14px;
    text-align: center;
    color: #1f2937;
}

.table-card tr:hover td {
    background: #f8fafc;
}

/* ===== ATTENDANCE BADGES ===== */
.attendance {
    padding: 6px 14px;
    border-radius: 999px;
    font-size: 13px;
    font-weight: 600;
    display: inline-block;
}

.attendance.present {
    background: #dcfce7;
    color: #166534;
}

.attendance.absent {
    background: #fee2e2;
    color: #991b1b;
}

.attendance.late {
    background: #fef3c7;
    color: #92400e;
}

/* ===== GRADES TABLE ===== */
.grades-card {
    background: white;
    border-radius: 16px;
    padding: 22px;
    box-shadow: 0 14px 30px rgba(0,0,0,0.08);
}

.grades-card table {
    width: 100%;
    border-collapse: collapse;
}

.grades-card th {
    background: linear-gradient(135deg, #2563eb, #1d4ed8);
    color: white;
    font-weight: 600;
    padding: 14px;
    text-align: center;
}

.grades-card td {
    padding: 14px;
    text-align: center;
    color: #1f2937;
}

.grades-card tr:hover td {
    background: #f8fafc;
}

/* ===== GRADE BADGES ===== */
.grade-badge {
    padding: 6px 14px;
    border-radius: 999px;
    font-size: 13px;
    font-weight: 600;
    display: inline-block;
}

.grade-good {
    background: #dcfce7;
    color: #166534;
}

.grade-average {
    background: #fef3c7;
    color: #92400e;
}

.grade-poor {
    background: #fee2e2;
    color: #991b1b;
}

/* Comment styling */
.grade-comment {
    color: #64748b;
    font-size: 14px;
    text-align: left;
}

/* ===== WEEKLY TIMETABLE ===== */
.timetable-card {
    background: white;
    padding: 24px;
    border-radius: 18px;
    box-shadow: 0 14px 30px rgba(0,0,0,0.08);
}

.timetable {
    width: 100%;
    border-collapse: separate;
    border-spacing: 0;
    margin-top: 16px;
    overflow: hidden;
    border-radius: 14px;
}

.timetable th {
    background: linear-gradient(135deg, #2563eb, #1d4ed8);
    color: white;
    padding: 14px;
    font-weight: 600;
    text-align: center;
}

.timetable th:first-child {
    border-top-left-radius: 14px;
}

.timetable th:last-child {
    border-top-right-radius: 14px;
}

.timetable td {
    padding: 14px;
    text-align: center;
    background: #ffffff;
    border-bottom: 1px solid #e5e7eb;
    color: #1f2937;
}

/* Period column */
.timetable .period-cell {
    background: #f1f5f9;
    font-weight: 600;
    color: #334155;
    white-space: nowrap;
}

/* Empty cells */
.timetable .empty {
    color: #94a3b8;
    font-style: italic;
}

/* Hover row */
.timetable tr:hover td {
    background: #f8fafc;
}

/* Mobile scroll */
.timetable-wrapper {
    overflow-x: auto;
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
    <h2>Student</h2>

    <div class="academic-year-badge">
    Academic Year:
    <strong><?= session('academic_year_name') ?></strong>
</div>

    <a class="<?= $current === 'dashboard' ? 'active' : '' ?>"
       href="<?= site_url('student/dashboard') ?>">Dashboard</a>

    <a class="<?= $current === 'attendance' ? 'active' : '' ?>"
       href="<?= site_url('student/attendance') ?>">Attendance</a>

    <a class="<?= $current === 'homework' ? 'active' : '' ?>"
       href="<?= site_url('student/homework') ?>">Homework</a>

    <a class="<?= $current === 'messages' ? 'active' : '' ?>"
       href="<?= site_url('student/messages') ?>">Messages</a>

    <a class="<?= $current === 'grades' ? 'active' : '' ?>"
       href="<?= site_url('student/grades') ?>">Grades</a>

         <!-- ✅ NEW REPORT CARD BUTTON -->
    <a class="<?= $current === 'report-card' ? 'active' : '' ?>"
       href="<?= site_url('student/report-card') ?>">
       Report Card
    </a>

    <a class="logout" href="<?= site_url('student/logout') ?>">Logout</a>
</aside>

<main class="main">
    <?= $this->renderSection('content') ?>
</main>

</div>
</div>

</body>
</html>