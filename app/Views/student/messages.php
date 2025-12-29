
<?= $this->extend('student/layout') ?>
<?= $this->section('content') ?>
<h2>📢 Class Messages</h2>
<p style="color:#666;">
    Grade <?= esc($class['grade']) ?> - Section <?= esc($class['section']) ?>
</p>

<?php if (empty($messages)): ?>
    <div class="card">
        <p>No messages from teachers yet.</p>
    </div>
<?php else: ?>
    <?php foreach ($messages as $m): ?>
        <div class="card" style="margin-bottom:15px;">
            <strong><?= esc($m['teacher_name']) ?></strong>
            <span style="color:#777; font-size:12px;">
                — <?= date('d M Y H:i', strtotime($m['created_at'])) ?>
            </span>
            <hr>
            <p><?= nl2br(esc($m['message'])) ?></p>
        </div>
    <?php endforeach; ?>
<?php endif; ?>

<a href="<?= site_url('student/dashboard') ?>" class="btn">
    ← Back to Dashboard
</a>

<?= $this->endSection() ?>