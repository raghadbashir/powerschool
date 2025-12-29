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
    margin-right: 6px;
    display: inline-block;
}

.action-edit {
    background: #e0e7ff;
    color: #1e40af;
}

.action-edit:hover {
    background: #c7d2fe;
}

.action-view {
    background: #e0f2fe;
    color: #075985;
}

.action-view:hover {
    background: #bae6fd;
}

.action-timetable {
    background: #ede9fe;
    color: #5b21b6;
}

.action-timetable:hover {
    background: #ddd6fe;
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
        <h1>Classes</h1>
        <p>Manage grades, sections, and class schedules</p>
    </div>

    <a class="btn" href="<?= site_url('admin/add-class') ?>">
        ➕ Add Class
    </a>
</div>

<!-- ===== TABLE CARD ===== -->
<div class="card">
    <table class="modern-table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Grade</th>
                <th>Section</th>
                <th>Students</th>
                <th>Actions</th>
            </tr>
        </thead>

        <tbody>
        <?php foreach ($classes as $class): ?>
            <tr>
                <td><?= esc($class['id']) ?></td>
                <td><?= esc($class['grade']) ?></td>
                <td><?= esc($class['section']) ?></td>
                <td><?= esc($class['student_count']) ?> Students</td>
                <td>
                    <a class="action-btn action-edit"
                       href="<?= site_url('admin/edit-class/'.$class['id']) ?>">
                        Edit
                    </a>

                    <a class="action-btn action-view"
                       href="<?= site_url('admin/class/'.$class['id']) ?>">
                        View
                    </a>

                    <a class="action-btn action-timetable"
                       href="<?= site_url('admin/manage-timetable?class_id='.$class['id']) ?>">
                        Timetable
                    </a>

                    <a class="action-btn action-delete"
                       href="<?= site_url('admin/delete-class/'.$class['id']) ?>"
                       onclick="return confirm('Delete this class?')">
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