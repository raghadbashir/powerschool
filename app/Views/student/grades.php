<?= $this->extend('student/layout') ?>
<?= $this->section('content') ?>

<h2>📊 Recent Grades (Midterms)</h2>

<p style="color:#64748b; margin-bottom:18px;">
    Only midterm results are shown here.  
    Final exam results will be available in the official report card.
</p>

<?php if (empty($grades)): ?>
    <div class="card">
        <p>No grades have been published yet.</p>
    </div>
<?php else: ?>
    <div class="grades-card">
        <table>
            <thead>
                <tr>
                    <th>Subject</th>
                    <th>Midterm (40)</th>
                    <th>Term</th>
                    <th>Teacher</th>
                    <th>Comment</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($grades as $g): ?>
                    <?php
                        $score = (int)$g['midterm'];

                        if ($score >= 30) {
                            $gradeClass = 'grade-good';
                        } elseif ($score >= 20) {
                            $gradeClass = 'grade-average';
                        } else {
                            $gradeClass = 'grade-poor';
                        }
                    ?>
                    <tr>
                        <td><?= esc($g['subject']) ?></td>
                        <td>
                            <span class="grade-badge <?= $gradeClass ?>">
                                <?= esc($g['midterm']) ?>/40
                            </span>
                        </td>
                        <td><?= esc($g['term']) ?></td>
                        <td><?= esc($g['teacher_name']) ?></td>
                        <td class="grade-comment">
                            <?= esc($g['comment'] ?: '-') ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
<?php endif; ?>

<a href="<?= site_url('student/dashboard') ?>" class="btn" style="margin-top:18px;">
    ← Back to Dashboard
</a>

<?= $this->endSection() ?>