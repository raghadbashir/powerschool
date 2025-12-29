<?= $this->extend('parent/parent_layout') ?>
<?= $this->section('content') ?>

<h1>Grades</h1>

<p>
    Student: <strong><?= esc($student['name']) ?></strong>
</p>

<hr>

<?php if (empty($grades)): ?>
    <p>No grades available.</p>
<?php else: ?>

<div class="table-card">
    <table class="modern-table">
        <thead>
            <tr>
                <th>Subject</th>
                <th>Term</th>
                <th>Midterm</th>
                <th>Final</th>
                <th>Total</th>
                <th>Comment</th>
            </tr>
        </thead>
        <tbody>
        <?php foreach ($grades as $g): ?>
            <tr>
                <td><strong><?= esc($g['subject']) ?></strong></td>
                <td><?= esc($g['term']) ?></td>
                <td><?= esc($g['midterm']) ?></td>
                <td><?= esc($g['final']) ?></td>
                <td><strong><?= esc($g['total']) ?></strong></td>
                <td><?= esc($g['comment'] ?: '—') ?></td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
</div>

<?php endif; ?>

<a class="back-link" href="<?= site_url('parent/dashboard') ?>">
    ← Back to Dashboard
</a>

<?= $this->endSection() ?>