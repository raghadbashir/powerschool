<?= $this->extend('admin/layout') ?>
<?= $this->section('content') ?>

<style>
.page-title{
    font-size:28px;
    font-weight:800;
    margin-bottom:10px;
    display:flex;
    align-items:center;
    gap:10px;
}
.small{ font-size:13px; color:#475569; margin-bottom:18px; }

.card{
    background:#fff;
    border-radius:16px;
    padding:16px;
    box-shadow:0 10px 25px rgba(0,0,0,.06);
    overflow:hidden;
}

.table{
    width:100%;
    border-collapse:collapse;
}
.table th{
    background:#f1f5f9;
    text-align:left;
    padding:12px;
    font-weight:800;
}
.table td{
    padding:12px;
    border-top:1px solid #e5e7eb;
}
.badge{
    display:inline-block;
    padding:4px 10px;
    border-radius:999px;
    font-size:12px;
    font-weight:800;
}
.badge-grad{ background:#e0f2fe; color:#075985; }

.notice{
    margin-top:14px;
    padding:12px 14px;
    border-radius:12px;
    background:#fff7ed;
    border:1px solid #fed7aa;
    color:#9a3412;
    font-weight:700;
}
</style>

<div class="page-title">🎓 Graduated Students</div>
<p class="small">These students are marked as <b>graduated</b> in the students table.</p>

<?php if (empty($graduates)): ?>
    <div class="notice">No graduated students found.</div>
<?php else: ?>
    <div class="card">
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Student Number</th>
                    <th>Name</th>
                    <th>Date of Birth</th>
                    <th>Parent</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($graduates as $g): ?>
                    <tr>
                        <td><?= esc($g['id']) ?></td>
                        <td><?= esc($g['student_number']) ?></td>
                        <td><?= esc($g['name']) ?></td>
                        <td><?= esc($g['date_of_birth']) ?></td>
                        <td><?= esc($g['parent_name'] ?? '-') ?></td>
                        <td><span class="badge badge-grad"><?= esc($g['status'] ?? 'graduated') ?></span></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
<?php endif; ?>

<?= $this->endSection() ?>