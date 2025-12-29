<?= $this->extend('parent/parent_layout') ?>
<?= $this->section('content') ?>

<h2>Messages from Teachers</h2>
<hr>

<?php if (empty($messages)): ?>
    <p>No messages yet.</p>
<?php else: ?>

<div style="display:grid; grid-template-columns:repeat(auto-fit,minmax(320px,1fr)); gap:20px;">
<?php foreach ($messages as $m): ?>
    <div style="
        background:#fff;
        border-radius:14px;
        padding:20px;
        box-shadow:0 10px 25px rgba(0,0,0,.06);
        border-left:5px solid <?= $m['is_read'] ? '#22c55e' : '#f97316' ?>;
    ">

        <strong>Student:</strong> <?= esc($m['student_name']) ?><br>
        <strong>Subject:</strong> <?= esc($m['subject']) ?><br><br>

        <?= esc($m['message']) ?><br><br>

        <small style="color:#64748b;">
            Sent: <?= date('Y-m-d H:i', strtotime($m['created_at'])) ?><br>
            Status: 
            <?= $m['is_read'] 
                ? '<span style="color:green">Read</span>' 
                : '<span style="color:orange">Unread</span>' ?>
        </small>
    </div>
<?php endforeach; ?>
</div>

<?php endif; ?>

<a href="<?= site_url('parent/dashboard') ?>" style="display:inline-block;margin-top:20px;">
    ← Back to Dashboard
</a>

<?= $this->endSection() ?>