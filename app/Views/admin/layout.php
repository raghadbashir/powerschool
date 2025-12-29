
<?php
$currentPath = service('uri')->getPath();
function isActive($path, $currentPath)
{
    return str_starts_with($currentPath, $path) ? 'active' : '';
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title><?= $title ?? 'Admin Panel' ?></title>

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

/* Sidebar links */
.sidebar a {
    color: #7dace6ff;
    text-decoration: none;
    padding: 10px 14px;
    border-radius: 10px;
    margin-bottom: 6px;
    display: block;
    font-weight: 500;
    transition: background 0.2s ease;
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
/* ===== FORM INPUTS ===== */
.form-input {
    width: 100%;
    padding: 12px;
    margin-top: 6px;
    margin-bottom: 16px;
    border-radius: 10px;
    border: 1px solid #e5e7eb;
    font-size: 15px;
}

.form-input:focus {
    outline: none;
    border-color: #2563eb;
    box-shadow: 0 0 0 2px rgba(37,99,235,0.2);
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

/* Headings spacing */
.main h1 {
    margin-top: 0;
    color: #1e293b;
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

    <!-- SIDEBAR (ONCE, FOR ALL PAGES) -->
    <?php $current = service('uri')->getSegment(2); ?>

<aside class="sidebar">
    <h2>Admin</h2>

    <div class="academic-year-badge">
    Academic Year:
    <strong><?= session('academic_year_name') ?></strong>
</div>

    <a class="<?= $current === 'dashboard' ? 'active' : '' ?>"
       href="<?= site_url('admin/dashboard') ?>">
        Dashboard
    </a>

    <a class="<?= $current === 'students' ? 'active' : '' ?>"
       href="<?= site_url('admin/students') ?>">
        Students
    </a>

    <a class="<?= $current === 'parents' ? 'active' : '' ?>"
       href="<?= site_url('admin/parents') ?>">
        Parents
    </a>

    <a class="<?= $current === 'teachers' ? 'active' : '' ?>"
       href="<?= site_url('admin/teachers') ?>">
        Teachers
    </a>

    <a class="<?= $current === 'classes' ? 'active' : '' ?>"
       href="<?= site_url('admin/classes') ?>">
        Classes
    </a>

    <a class="<?= $current === 'subjects' ? 'active' : '' ?>"
       href="<?= site_url('admin/subjects') ?>">
        Subjects
    </a>

    <a class="<?= $current === 'manage-teaching' ? 'active' : '' ?>"
       href="<?= site_url('admin/manage-teaching') ?>">
        Teaching
    </a>

    <a class="<?= $current === 'report-cards' ? 'active' : '' ?>"
       href="<?= site_url('admin/report-cards') ?>">
        Report Cards
    </a>

 <a class="<?= $current === 'academic-years' ? 'active' : '' ?>"
   href="<?= site_url('admin/academic-years') ?>">
    Academic Years
</a>

<a class="<?= $current === 'promotions' ? 'active' : '' ?>"
   href="<?= site_url('admin/promotions') ?>">
    Student Promotions
</a>
<a href="<?= site_url('admin/graduates') ?>">
    Graduated Students
</a>
<a class="logout" href="<?= site_url('login') ?>">Logout</a>
</aside>


    <!-- PAGE CONTENT GOES HERE -->
    <main class="main">
        <?= $this->renderSection('content') ?>
    </main>

</div>
</div>

</body>
</html>