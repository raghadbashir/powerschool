<?= $this->extend('teacher/layout') ?>
<?= $this->section('content') ?>

<h1>Homework</h1>
<p style="color:#64748b; margin-top:-10px;">
    Manage and review assigned homework
</p>

<div style="margin-bottom:20px;">
    <a href="<?= site_url('teacher/homework/create') ?>" class="btn">
        + Create Homework
    </a>

    <a href="<?= site_url('teacher/dashboard') ?>"
       class="btn"
       style="background:#64748b;">
        ← Back
    </a>
</div>

<div class="card">

<?php if (empty($homeworks)): ?>
    <p style="color:#64748b;">No homework created yet.</p>
<?php else: ?>

<table>
    <thead>
        <tr>
            <th>Class</th>
            <th>Title</th>
            <th>Due Date</th>
            <th>Submissions</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($homeworks as $h): ?>
            <tr>
                <td>
                    Grade <?= esc($h['grade']) ?> - <?= esc($h['section']) ?>
                </td>
                <td><?= esc($h['title']) ?></td>
                <td><?= esc($h['due_datetime']) ?></td>
                <td>
                    <a href="<?= site_url('teacher/homework/submissions/' . $h['id']) ?>"
                       class="btn"
                       style="padding:6px 12px; font-size:13px;">
                        View
                    </a>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<?php endif; ?>

</div>

<?= $this->endSection() ?>