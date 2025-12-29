<?= $this->extend('teacher/layout') ?>
<?= $this->section('content') ?>

<h1 class="page-title">
    Students — Grade <?= $class['grade'] ?> - Section <?= $class['section'] ?>
</h1>
<p class="page-subtitle">
    Class student list and parent contact details
</p>

<?php if (session()->getFlashdata('success')): ?>
    <div class="card" style="border-left:4px solid #22c55e;">
        <strong style="color:#16a34a;">
            <?= session()->getFlashdata('success') ?>
        </strong>
    </div>
<?php endif; ?>

<div class="card">
<?php if (empty($students)): ?>
    <p>No students found in this class.</p>
<?php else: ?>

    <table class="table">
        <thead>
            <tr>
                <th>Student Name</th>
                <th>Student Number</th>
                <th>Parent Name</th>
                <th>Parent Phone</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($students as $s): ?>
            <tr>
                <td><?= esc($s['name']) ?></td>
                <td><?= esc($s['student_number']) ?></td>
                <td><?= esc($s['parent_name']) ?></td>
                <td><?= esc($s['parent_phone']) ?></td>
                <td>
                    <a href="<?= site_url('teacher/message-parent/' . $s['id']) ?>"
                       class="btn btn-primary">
                        Message Parent
                    </a>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

<?php endif; ?>
</div>



<?= $this->endSection() ?>