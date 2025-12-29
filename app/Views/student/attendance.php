<?= $this->extend('student/layout') ?>
<?= $this->section('content') ?>

<h2>📅 Attendance History</h2>

<div class="table-card">
<table>
    <tr>
        <th>Date</th>
        <th>Status</th>
    </tr>

    <?php foreach ($attendance as $a): ?>
        <tr>
            <td><?= esc($a['date']) ?></td>
            <td>
                <?php
                    $status = strtolower($a['status']);
                ?>
                <span class="attendance <?= $status ?>">
                    <?= ucfirst($status) ?>
                </span>
            </td>
        </tr>
    <?php endforeach; ?>
</table>
</div>

<br>

<a href="<?= site_url('student/dashboard') ?>" class="btn">
    ← Back to Dashboard
</a>

<?= $this->endSection() ?>