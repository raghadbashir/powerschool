<?= $this->extend('teacher/layout') ?>
<?= $this->section('content') ?>

<style>
/* ===== PAGE HEADER ===== */
.page-header {
    margin-bottom: 24px;
}

.page-header h2 {
    margin: 0;
    color: #1e293b;
}

.page-header p {
    color: #64748b;
    margin-top: 6px;
    font-size: 14px;
}

/* ===== ACTION LINKS ===== */
.page-actions {
    margin-bottom: 24px;
}

.page-actions a {
    color: #2563eb;
    font-weight: 600;
    text-decoration: none;
    margin-right: 14px;
}

.page-actions a:hover {
    text-decoration: underline;
}

/* ===== CARD ===== */
.card {
    background: white;
    padding: 24px;
    border-radius: 16px;
    box-shadow: 0 14px 30px rgba(0,0,0,0.08);
}

/* ===== TABLE ===== */
.modern-table {
    width: 100%;
    border-collapse: collapse;
}

.modern-table th {
    background: linear-gradient(135deg, #2563eb, #1d4ed8);
    color: white;
    padding: 14px;
    text-align: left;
    font-size: 14px;
}

.modern-table td {
    padding: 14px;
    border-bottom: 1px solid #e5e7eb;
    color: #1f2937;
}

.modern-table tr:nth-child(even) {
    background: #f8fafc;
}

.modern-table tr:hover {
    background: #eef2ff;
}

/* ===== STATUS BADGES ===== */
.badge {
    padding: 6px 14px;
    border-radius: 999px;
    font-size: 13px;
    font-weight: 600;
    display: inline-block;
}

.badge.submitted {
    background: #dcfce7;
    color: #166534;
}

.badge.not-submitted {
    background: #fee2e2;
    color: #991b1b;
}

/* ===== DOWNLOAD BUTTON ===== */
.download-btn {
    display: inline-block;
    padding: 6px 12px;
    border-radius: 8px;
    background: #2563eb;
    color: white;
    font-weight: 600;
    font-size: 13px;
    text-decoration: none;
}

.download-btn:hover {
    background: #1d4ed8;
}
</style>

<!-- ===== HEADER ===== -->
<div class="page-header">
    <h2>Homework Submissions</h2>
    <p>
        <strong><?= esc($homework['title']) ?></strong><br>
        Due: <?= esc($homework['due_datetime']) ?>
    </p>
</div>

<!-- ===== ACTIONS ===== -->
<div class="page-actions">
    <a href="<?= site_url('teacher/homework/list') ?>">← Homework List</a>
    <a href="<?= site_url('teacher/dashboard') ?>">← Dashboard</a>
</div>

<!-- ===== TABLE CARD ===== -->
<div class="card">
    <table class="modern-table">
        <thead>
            <tr>
                <th>Student</th>
                <th>Status</th>
                <th>Submission</th>
            </tr>
        </thead>
        <tbody>
        <?php foreach ($students as $s): ?>
            <tr>
                <td><?= esc($s['student_name']) ?></td>

                <td>
                    <?php if ($s['submitted_file']): ?>
                        <span class="badge submitted">Submitted</span>
                    <?php else: ?>
                        <span class="badge not-submitted">Not Submitted</span>
                    <?php endif; ?>
                </td>

                <td>
                    <?php if ($s['submitted_file']): ?>
                        <a class="download-btn"
                           href="/uploads/homework/<?= esc($s['submitted_file']) ?>"
                           target="_blank">
                           Download
                        </a>
                    <?php else: ?>
                        —
                    <?php endif; ?>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
</div>

<?= $this->endSection() ?>