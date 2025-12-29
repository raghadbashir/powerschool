<?= $this->extend('teacher/layout') ?>
<?= $this->section('content') ?>

<h1>View Grades</h1>

<p style="color:#64748b; margin-top:-8px; margin-bottom:20px;">
    Subject: <strong><?= esc($subject) ?></strong> &nbsp;|&nbsp;
    Class: <strong><?= esc($classId) ?></strong>
</p>

<div class="card">

<?php if (empty($grades)): ?>

    <p style="color:#64748b;">No grades available for this class.</p>

<?php else: ?>

    <div class="table-wrapper">
        <table class="modern-table">
            <thead>
                <tr>
                    <th>Student</th>
                    <th>Midterm (40)</th>
                    <th>Final (60)</th>
                    <th>Total</th>
                    <th>Comment</th>
                </tr>
            </thead>

            <tbody>
                <?php foreach ($grades as $g): ?>
                    <tr>
                        <td class="student-name">
                            <?= esc($g['student_name']) ?>
                        </td>

                        <td><?= esc($g['midterm']) ?></td>

                        <td><?= esc($g['final']) ?></td>

                        <td class="total-score">
                            <?= esc($g['total']) ?>
                        </td>

                        <td class="comment-cell">
                            <?= esc($g['comment'] ?: '-') ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

<?php endif; ?>

<div style="margin-top:25px;">
    <a href="<?= site_url('teacher/dashboard') ?>"
       class="btn"
       style="background:#64748b;">
        ← Back to Dashboard
    </a>
</div>

</div>

<?= $this->endSection() ?>