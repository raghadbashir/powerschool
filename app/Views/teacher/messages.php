<?= $this->extend('teacher/layout') ?>
<?= $this->section('content') ?>

<h1>Class Messages</h1>

<p style="color:#64748b; margin-top:-10px;">
    Class: <strong>Grade <?= $class['grade'] ?> - Section <?= $class['section'] ?></strong>
</p>

<!-- ================= WRITE MESSAGE ================= -->
<div class="card">

<h3 style="margin-top:0;">Write New Message</h3>

<form action="<?= site_url('teacher/messages/add/' . $class['id']) ?>" method="post">

    <label style="font-weight:600; color:#1e293b;">Message</label>

    <textarea name="message"
              rows="4"
              required
              style="
                width:100%;
                padding:12px;
                border-radius:10px;
                border:1px solid #e5e7eb;
                margin-top:8px;
                resize:vertical;
              "></textarea>

    <div style="margin-top:15px;">
        <button type="submit" class="btn">
            Post Message
        </button>
    </div>

</form>

</div>

<!-- ================= PREVIOUS MESSAGES ================= -->
<div class="card">

<h3 style="margin-top:0;">Previous Messages</h3>

<?php if (empty($messages)): ?>
    <p style="color:#64748b;">No messages yet.</p>
<?php else: ?>

    <?php foreach ($messages as $m): ?>
        <div style="
            padding:14px;
            border-radius:12px;
            background:#f8fafc;
            margin-bottom:12px;
            border:1px solid #e5e7eb;
        ">
            <strong style="color:#2563eb;">
                <?= esc($m['teacher_name']) ?>
            </strong>
            <span style="color:#64748b; font-size:13px;">
                — <?= esc($m['created_at']) ?>
            </span>

            <p style="margin:8px 0 0 0; color:#1e293b;">
                <?= esc($m['message']) ?>
            </p>
        </div>
    <?php endforeach; ?>

<?php endif; ?>

</div>

<!-- ================= ACTIONS ================= -->


<?= $this->endSection() ?>