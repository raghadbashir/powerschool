<?= $this->extend('student/layout') ?>
<?= $this->section('content') ?>

<h2>Report Card</h2>

<?php if (empty($grades)): ?>
    <div class="card">
        <p style="color:#64748b;">
            📭 Your report card has not been issued yet.
        </p>
    </div>
<?php else: ?>

<div class="card">
    <table>
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
                <td><?= esc($g['subject']) ?></td>
                <td><?= esc($g['term']) ?></td>
                <td><?= $g['midterm'] ?></td>
                <td><?= $g['final'] ?></td>
                <td><strong><?= $g['total'] ?></strong></td>
                <td><?= esc($g['comment'] ?: '—') ?></td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<?php endif; ?>

<?= $this->endSection() ?>