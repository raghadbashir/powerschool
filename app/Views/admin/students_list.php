<?= $this->extend('admin/layout') ?>
<?= $this->section('content') ?>

<style>
:root {
    --primary: #1e3a8a;
    --secondary: #2563eb;
    --danger: #dc2626;
    --bg-card: #ffffff;
    --bg-soft: #f8fafc;
    --text-muted: #64748b;
    --success: #15803d;
}

/* ===== PAGE HEADER ===== */
.page-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 26px;
}

.page-header h1 {
    margin: 0;
    color: var(--primary);
}

.page-header p {
    margin-top: 6px;
    color: var(--text-muted);
    font-size: 14px;
}

/* ===== BUTTON ===== */
.btn {
    padding: 10px 18px;
    background: var(--secondary);
    color: white;
    border-radius: 10px;
    text-decoration: none;
    font-weight: 600;
    transition: background .2s ease, transform .1s ease;
}

.btn:hover {
    background: #1d4ed8;
    transform: translateY(-1px);
}

/* ===== SUCCESS MESSAGE ===== */
.alert-success {
    background: #dcfce7;
    color: var(--success);
    padding: 12px 18px;
    border-radius: 10px;
    font-weight: 600;
    margin-bottom: 20px;
}

/* ===== CARD ===== */
.card {
    background: var(--bg-card);
    padding: 26px;
    border-radius: 18px;
    box-shadow: 0 18px 40px rgba(0,0,0,0.08);
}

/* ===== TABLE ===== */
.modern-table {
    width: 100%;
    border-collapse: collapse;
}

.modern-table th {
    background: #f1f5f9;
    color: var(--primary);
    font-weight: 700;
    padding: 14px;
    text-align: left;
    font-size: 14px;
}

.modern-table td {
    padding: 14px;
    border-bottom: 1px solid #e5e7eb;
    font-size: 14px;
}

.modern-table tr:hover {
    background: #f8fafc;
}

/* ===== ACTION BUTTONS ===== */
.action-btn {
    padding: 6px 14px;
    border-radius: 999px;
    font-size: 13px;
    font-weight: 600;
    text-decoration: none;
    margin-right: 8px;
    display: inline-block;
}

.action-edit {
    background: #e0e7ff;
    color: #1e40af;
}

.action-edit:hover {
    background: #c7d2fe;
}

.action-delete {
    background: #fee2e2;
    color: #991b1b;
}

.action-delete:hover {
    background: #fecaca;
}

/* ===== BACK LINK ===== */
.back-link {
    display: inline-block;
    margin-top: 20px;
    color: var(--text-muted);
    font-weight: 600;
    text-decoration: none;
}

.back-link:hover {
    color: var(--secondary);
}
</style>

<!-- ===== HEADER ===== -->
<div class="page-header">
    <div>
        <h1>Students</h1>
        <p>Manage student records and class assignments</p>
    </div>

    <a class="btn" href="<?= site_url('admin/add-student') ?>">
        ➕ Add Student
    </a>
</div>

<!-- ===== SUCCESS MESSAGE ===== -->
<?php if (session()->get('success')): ?>
    <div class="alert-success">
        <?= session()->get('success') ?>
    </div>
<?php endif; ?>

<!-- ===== TABLE CARD ===== -->
<div class="card">
    <table class="modern-table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Student No.</th>
                <th>Name</th>
                <th>Grade</th>
                <th>Section</th>
                <th>Date of Birth</th>
                <th>Parent</th>
                <th>Actions</th>
            </tr>
        </thead>

        <tbody>
        <?php foreach ($students as $s): ?>
            <tr>
                <td><?= esc($s['id']) ?></td>
                <td><?= esc($s['student_number']) ?></td>
                <td><?= esc($s['name']) ?></td>
                <td><?= esc($s['class_grade']) ?></td>
                <td><?= esc($s['class_section']) ?></td>
                <td><?= esc($s['date_of_birth']) ?></td>
                <td><?= esc($s['parent_name']) ?></td>
                <td>
                    <a class="action-btn action-edit"
                       href="<?= site_url('admin/edit-student/'.$s['id']) ?>">
                        Edit
                    </a>

                    <a class="action-btn action-delete"
                       href="<?= site_url('admin/delete-student/'.$s['id']) ?>"
                       onclick="return confirm('Delete this student?')">
                        Delete
                    </a>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
</div>

<a class="back-link" href="<?= site_url('admin/dashboard') ?>">
    ⬅ Back to Dashboard
</a>

<?= $this->endSection() ?>