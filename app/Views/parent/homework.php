<?= $this->extend('parent/parent_layout') ?>
<?= $this->section('content') ?>

<h2>Homework</h2>

<p>
    Student: <strong><?= esc($student['name']) ?></strong>
</p>

<hr>

<?php if (empty($homeworks)): ?>
    <p>No homework assigned yet.</p>
<?php else: ?>

<div class="homework-list">
    <?php foreach ($homeworks as $hw): ?>
        <div class="homework-card">

            <h3><?= esc($hw['title']) ?></h3>

            <div class="homework-meta">
                <strong>Subject:</strong> <?= esc($hw['subject']) ?><br>
                <strong>Due:</strong> <?= esc($hw['due_datetime']) ?>
            </div>

            <div class="homework-desc">
                <?= esc($hw['description']) ?>
            </div>

            <div class="homework-footer">
                <?php if ($hw['submitted']): ?>
                    <span class="badge-submitted">Submitted</span>
                    <span>
                        Submitted at:<br>
                        <?= esc($hw['submitted_at']) ?>
                    </span>
                <?php else: ?>
                    <span class="badge-not-submitted">Not Submitted</span>
                <?php endif; ?>
            </div>

        </div>
    <?php endforeach; ?>
</div>

<?php endif; ?>

<a class="back-link" href="<?= site_url('parent/dashboard') ?>">
    ← Back to Dashboard
</a>

<?= $this->endSection() ?>