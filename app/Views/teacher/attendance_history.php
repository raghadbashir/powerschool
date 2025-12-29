<?= $this->extend('teacher/layout') ?>
<?= $this->section('content') ?>

<h1>Attendance History</h1>

<p style="color:#475569; margin-bottom:20px;">
    Class:
    <strong><?= esc($class['grade']) ?> - <?= esc($class['section']) ?></strong>
</p>

<div class="card">

<?php if (empty($dates)): ?>

    <div style="text-align:center; padding:30px; color:#64748b;">
        <p>No attendance records found.</p>
    </div>

<?php else: ?>

    <table class="history-table">
        <thead>
            <tr>
                <th>Date</th>
                <th>Action</th>
            </tr>
        </thead>

        <tbody>
        <?php foreach ($dates as $d): ?>
            <tr>
                <td style="font-weight:600; color:#1e293b;">
                    <?= esc(date('d M Y', strtotime($d['date']))) ?>
                </td>
                <td>
                    <a class="btn"
                       href="<?= site_url('teacher/attendance-history/' . $class['id'] . '/' . $d['date']) ?>">
                        View Details
                    </a>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>

<?php endif; ?>

</div>

<div style="margin-top:20px;">
    <a href="<?= site_url('teacher/dashboard') ?>"
       class="btn"
       style="background:#64748b;">
        ← Back to Dashboard
    </a>
</div>

<?= $this->endSection() ?>