<?= $this->extend('admin/layout') ?>
<?= $this->section('content') ?>

<style>
/* ===== COLORS ===== */
:root {
    --primary: #1e3a8a;
    --secondary: #2563eb;
    --danger: #dc2626;
    --bg-card: #ffffff;
    --bg-soft: #f8fafc;
}

/* ===== HEADINGS ===== */
h1, h2, h3 {
    color: var(--primary);
    margin-top: 0;
}

/* ===== CARD ===== */
.card {
    background: var(--bg-card);
    padding: 24px;
    border-radius: 16px;
    box-shadow: 0 14px 30px rgba(0,0,0,0.08);
    margin-bottom: 30px;
}

/* ===== ACTION BUTTONS ===== */
.actions {
    display: flex;
    gap: 12px;
    flex-wrap: wrap;
    margin-top: 12px;
}

.btn {
    padding: 10px 16px;
    background: var(--secondary);
    color: white;
    border-radius: 10px;
    text-decoration: none;
    font-weight: 600;
    transition: background .2s ease, transform .2s ease;
}

.btn:hover {
    background: #1d4ed8;
    transform: translateY(-2px);
}

.btn-danger {
    background: var(--danger);
}

.btn-danger:hover {
    background: #b91c1c;
}

/* ===== TABLE ===== */
table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 15px;
}

th, td {
    padding: 12px 14px;
    text-align: center;
}

th {
    background: var(--primary);
    color: white;
}

tr:nth-child(even) {
    background: var(--bg-soft);
}

tr:hover {
    background: #eef2ff;
}
</style>

<h1>
    Class Details –
    Grade <?= esc($class['grade']) ?>, Section <?= esc($class['section']) ?>
</h1>

<div class="card">
    <p>
        <strong>Total Students:</strong> <?= esc($student_count) ?>
    </p>

    <div class="actions">
        <a class="btn" href="<?= site_url('admin/add-student') ?>">➕ Add Student</a>
        <a class="btn" href="<?= site_url('admin/manage-teaching') ?>">➕ Assign Teacher</a>
        <a class="btn" href="<?= site_url('admin/classes') ?>">⬅ Back to Classes</a>
    </div>
</div>

<h2>Assigned Teachers & Subjects</h2>

<div class="card">
<?php if (empty($assignments)): ?>
    <p><em>No teachers assigned to this class yet.</em></p>
<?php else: ?>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Teacher</th>
                <th>Specialization</th>
                <th>Subject</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($assignments as $a): ?>
                <tr>
                    <td><?= esc($a['id']) ?></td>
                    <td><?= esc($a['teacher_name']) ?></td>
                    <td><?= esc($a['specialization']) ?></td>
                    <td><?= esc($a['subject']) ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
<?php endif; ?>
</div>

<h2>Students in this Class</h2>

<div class="card">
<?php if (empty($students)): ?>
    <p><em>No students in this class yet.</em></p>
<?php else: ?>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Student Number</th>
                <th>Name</th>
                <th>Date of Birth</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($students as $s): ?>
                <tr>
                    <td><?= esc($s['id']) ?></td>
                    <td><?= esc($s['student_number']) ?></td>
                    <td><?= esc($s['name']) ?></td>
                    <td><?= esc($s['date_of_birth']) ?></td>
                    <td>
                        <a class="btn" href="<?= site_url('admin/edit-student/'.$s['id']) ?>">✏ Edit</a>
                        <a class="btn btn-danger" href="<?= site_url('admin/delete-student/'.$s['id']) ?>">🗑 Delete</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
<?php endif; ?>
</div>

<?= $this->endSection() ?>