<?php
$current = service('uri')->getSegment(2);
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title><?= $title ?? 'Parent Panel' ?></title>

<style>
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
    background: rgba(255,255,255,0.15);
}

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

/* ===== MAIN ===== */
.main {
    flex: 1;
    padding: 35px;
    overflow-y: auto;
}

.card {
    background: white;
    padding: 24px;
    border-radius: 16px;
    box-shadow: 0 14px 30px rgba(0,0,0,0.08);
    margin-bottom: 20px;
}

/* ===== MODERN TABLE ===== */
.table-card {
    background: white;
    border-radius: 16px;
    box-shadow: 0 14px 30px rgba(0,0,0,0.08);
    padding: 20px;
    overflow-x: auto;
}

.modern-table {
    width: 100%;
    border-collapse: collapse;
    min-width: 600px;
}

.modern-table thead th {
    background: linear-gradient(135deg, #2563eb, #1d4ed8);
    color: white;
    padding: 14px;
    text-align: left;
    font-size: 14px;
    font-weight: 600;
    white-space: nowrap;
}

.modern-table tbody td {
    padding: 14px;
    border-bottom: 1px solid #e5e7eb;
    font-size: 14px;
    color: #1e293b;
}

.modern-table tbody tr:nth-child(even) {
    background: #f8fafc;
}

.modern-table tbody tr:hover {
    background: #eef2ff;
}

.modern-table td strong {
    font-weight: 600;
}

/* Status badges */
.badge-present {
    background: #dcfce7;
    color: #166534;
    padding: 4px 10px;
    border-radius: 999px;
    font-size: 12px;
    font-weight: 600;
}

.badge-absent {
    background: #fee2e2;
    color: #991b1b;
    padding: 4px 10px;
    border-radius: 999px;
    font-size: 12px;
    font-weight: 600;
}

/* Back link */
.back-link {
    display: inline-block;
    margin-top: 20px;
    color: #2563eb;
    font-weight: 600;
    text-decoration: none;
}

.back-link:hover {
    text-decoration: underline;
}



.children-grid {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 20px;
}

.student-card {
    background: white;
    border-radius: 14px;
    padding: 18px;
    text-align: center;
    cursor: pointer;
    box-shadow: 0 10px 24px rgba(0,0,0,0.08);
    transition: all 0.2s ease;
    border: 2px solid transparent;
}

.student-card:hover {
    transform: translateY(-2px);
}

.student-card input {
    display: none;
}

.student-card.active {
    border-color: #2563eb;
    background: #eff6ff;
}


.disabled-link {
    pointer-events: none;
    opacity: 0.45;
    filter: grayscale(30%);
}



/* ===== HOMEWORK CARDS ===== */
.homework-list {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(320px, 1fr));
    gap: 20px;
}

.homework-card {
    background: white;
    border-radius: 16px;
    padding: 20px;
    box-shadow: 0 14px 30px rgba(0,0,0,0.08);
    transition: transform 0.2s ease, box-shadow 0.2s ease;
}

.homework-card:hover {
    transform: translateY(-2px);
    box-shadow: 0 18px 36px rgba(0,0,0,0.12);
}

.homework-card h3 {
    margin-top: 0;
    margin-bottom: 10px;
    color: #1e293b;
}

.homework-meta {
    font-size: 14px;
    color: #475569;
    margin-bottom: 10px;
}

.homework-meta strong {
    color: #1e293b;
}

.homework-desc {
    font-size: 14px;
    color: #334155;
    margin-bottom: 12px;
}

.homework-footer {
    display: flex;
    justify-content: space-between;
    align-items: center;
    font-size: 13px;
}

/* Status badges */
.badge-submitted {
    background: #dcfce7;
    color: #166534;
    padding: 4px 10px;
    border-radius: 999px;
    font-weight: 600;
}

.badge-not-submitted {
    background: #fee2e2;
    color: #991b1b;
    padding: 4px 10px;
    border-radius: 999px;
    font-weight: 600;
}



/* ===== MESSAGES ===== */
.message-list {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(360px, 1fr));
    gap: 20px;
}

.message-card {
    background: white;
    border-radius: 16px;
    padding: 20px;
    box-shadow: 0 14px 30px rgba(0,0,0,0.08);
    transition: transform 0.2s ease, box-shadow 0.2s ease;
}

.message-card:hover {
    transform: translateY(-2px);
    box-shadow: 0 18px 36px rgba(0,0,0,0.12);
}

.message-header {
    margin-bottom: 10px;
    font-size: 14px;
    color: #475569;
}

.message-header strong {
    color: #1e293b;
}

.message-body {
    font-size: 15px;
    color: #1f2937;
    margin: 12px 0;
    line-height: 1.6;
}

.message-reply {
    margin-top: 14px;
    padding: 12px 14px;
    background: #f1f5f9;
    border-left: 4px solid #2563eb;
    border-radius: 10px;
    font-size: 14px;
}

.message-footer {
    margin-top: 12px;
    font-size: 12px;
    color: #64748b;
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

<?php
$current = service('uri')->getSegment(2);
$activeChildId = session('parent_active_child_id');
$disabled = !$activeChildId ? 'disabled-link' : '';
?>
<body>

<div class="wrapper">
<div class="container">

<aside class="sidebar">
    <h2>Parent</h2>

    <div class="academic-year-badge">
    Academic Year:
    <strong><?= session('academic_year_name') ?></strong>
</div>
<a class="<?= $current === 'dashboard' ? 'active' : '' ?>"
   href="<?= site_url('parent/dashboard') ?>">
    Dashboard
</a>

<a class="<?= $disabled ?> <?= $current === 'grades' ? 'active' : '' ?>"
   href="<?= $activeChildId ? site_url('parent/grades/'.$activeChildId) : '#' ?>">
    Grades
</a>

<a class="<?= $disabled ?> <?= $current === 'attendance' ? 'active' : '' ?>"
   href="<?= $activeChildId ? site_url('parent/attendance/'.$activeChildId) : '#' ?>">
    Attendance
</a>

<a class="<?= $disabled ?> <?= $current === 'homework' ? 'active' : '' ?>"
   href="<?= $activeChildId ? site_url('parent/homework/'.$activeChildId) : '#' ?>">
    Homework
</a>

<a class="<?= $current === 'messages' ? 'active' : '' ?>"
   href="<?= site_url('parent/messages') ?>">
    Messages
</a>
<a class="logout" href="<?= site_url('parent/logout') ?>">
    Logout
</a>
</aside>

<main class="main">
    <?= $this->renderSection('content') ?>
</main>

</div>
</div>

</body>
</html>