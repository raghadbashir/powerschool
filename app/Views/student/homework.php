<?= $this->extend('student/layout') ?>
<?= $this->section('content') ?>

<h2>📚 Homework</h2>

<div class="table-card">
<table>
    <tr>
        <th>Subject</th>
        <th>Title</th>
        <th>Due</th>
        <th>Status</th>
        <th>Action</th>
    </tr>

    <?php foreach ($homework as $h): ?>
        <?php
            $isLate = strtotime($h['due_datetime']) < time();
            $submitted = !empty($h['submitted_file']);
        ?>
        <tr>
            <td><?= esc($h['subject']) ?></td>
            <td><?= esc($h['title']) ?></td>
            <td><?= esc($h['due_datetime']) ?></td>

            <td>
                <?php if ($submitted): ?>
                    <span class="status submitted">Submitted</span>
                <?php elseif ($isLate): ?>
                    <span class="status late">Late</span>
                <?php else: ?>
                    <span class="status pending">Pending</span>
                <?php endif; ?>
            </td>

            <td>
                <?php if (!$submitted && !$isLate): ?>
                    <a class="action-link"
                       href="<?= site_url('student/homework/upload/' . $h['id']) ?>">
                        Upload
                    </a>
                <?php elseif ($submitted): ?>
                    <span class="status submitted">✔ Submitted</span>
                <?php else: ?>
                    <span class="status closed">Closed</span>
                <?php endif; ?>
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