<?= $this->extend('admin/layout') ?>
<?= $this->section('content') ?>

<style>
:root {
    --primary: #1e3a8a;
    --secondary: #2563eb;
    --danger: #dc2626;
    --bg-card: #ffffff;
    --text-muted: #64748b;
}

/* ===== PAGE HEADER ===== */
.page-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 28px;
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

/* ===== BUTTONS ===== */
.btn {
    padding: 10px 18px;
    background: var(--secondary);
    color: white;
    border-radius: 10px;
    text-decoration: none;
    font-weight: 600;
    transition: background .2s ease, transform .1s ease;
    display: inline-flex;
    align-items: center;
    gap: 6px;
}

.btn:hover {
    background: #1d4ed8;
    transform: translateY(-1px);
}

.btn-danger {
    background: var(--danger);
}

.btn-danger:hover {
    background: #b91c1c;
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

/* ===== ACTIONS ===== */
.actions {
    display: flex;
    gap: 10px;
}

.action-btn {
    padding: 6px 14px;
    border-radius: 999px;
    font-size: 13px;
    font-weight: 600;
    text-decoration: none;
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

/* ===== FOOTER LINK ===== */
.back-link {
    display: inline-block;
    margin-top: 22px;
    color: var(--secondary);
    font-weight: 600;
    text-decoration: none;
}

.back-link:hover {
    text-decoration: underline;
}
</style>

<!-- ===== PAGE HEADER ===== -->
<div class="page-header">
    <div>
        <h1>Teachers</h1>
        <p>Manage all teachers in the system</p>
    </div>

    <a class="btn" href="<?= site_url('admin/add-teacher') ?>">
        ➕ Add Teacher
    </a>
</div>

<!-- ===== TABLE CARD ===== -->
<div class="card">
    <table class="modern-table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Specialization</th>
                <th>Actions</th>
            </tr>
        </thead>

        <tbody>
        <?php foreach ($teachers as $t): ?>
            <tr>
                <td><?= esc($t['id']) ?></td>
                <td><?= esc($t['name']) ?></td>
                <td><?= esc($t['email']) ?></td>
                <td><?= esc($t['specialization']) ?></td>
                <td>
                    <div class="actions">
                        <a class="action-btn action-edit"
                           href="<?= site_url('admin/edit-teacher/'.$t['id']) ?>">
                            Edit
                        </a>

                        <a class="action-btn action-delete"
                           href="<?= site_url('admin/delete-teacher/'.$t['id']) ?>"
                           onclick="return confirm('Are you sure you want to delete this teacher?')">
                            Delete
                        </a>
                    </div>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
</div>

<a class="back-link" href="<?= site_url('admin/dashboard') ?>">
    ← Back to Dashboard
</a>

<?= $this->endSection() ?>