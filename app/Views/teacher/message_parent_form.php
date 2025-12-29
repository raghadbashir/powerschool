<?= $this->extend('teacher/layout') ?>
<?= $this->section('content') ?>

<h1>Message Parent</h1>

<p style="color:#64748b; margin-top:-10px;">
    Student: <strong><?= esc($student['name']) ?></strong>
</p>

<!-- ================= MESSAGE HISTORY ================= -->
<?php if (!empty($messages)): ?>
    <div class="card" style="margin-bottom:25px;">
        <h3 style="margin-bottom:15px;">Conversation</h3>

        <?php foreach ($messages as $msg): ?>
            <div style="
                padding:15px;
                border-radius:10px;
                background:#f8fafc;
                margin-bottom:12px;
                border-left:4px solid <?= $msg['is_read'] ? '#22c55e' : '#f59e0b' ?>;
            ">

                <div style="display:flex; justify-content:space-between; align-items:center;">
                    <strong><?= esc($msg['subject']) ?></strong>

                    <?php if ($msg['is_read']): ?>
                        <span style="
                            background:#dcfce7;
                            color:#166534;
                            padding:4px 10px;
                            border-radius:999px;
                            font-size:12px;
                        ">
                            Read
                        </span>
                    <?php else: ?>
                        <span style="
                            background:#fef3c7;
                            color:#92400e;
                            padding:4px 10px;
                            border-radius:999px;
                            font-size:12px;
                        ">
                            Unread
                        </span>
                    <?php endif; ?>
                </div>

                <p style="margin:10px 0; color:#334155;">
                    <?= nl2br(esc($msg['message'])) ?>
                </p>

                <small style="color:#64748b;">
                    Sent: <?= date('d M Y H:i', strtotime($msg['created_at'])) ?>

                    <?php if ($msg['is_read'] && $msg['read_at']): ?>
                        • Read at <?= date('d M Y H:i', strtotime($msg['read_at'])) ?>
                    <?php endif; ?>
                </small>
            </div>
        <?php endforeach; ?>
    </div>
<?php else: ?>
    <p style="color:#64748b; margin-bottom:20px;">
        No previous messages for this student.
    </p>
<?php endif; ?>

<!-- ================= SEND MESSAGE FORM ================= -->
<div class="card">

<form action="<?= site_url('teacher/send-message-parent') ?>" method="post">

    <input type="hidden" name="parent_id" value="<?= $parent['id'] ?>">
    <input type="hidden" name="student_id" value="<?= $student['id'] ?>">

    <!-- SUBJECT -->
    <label style="font-weight:600; color:#1e293b;">
        Subject
    </label>

    <input type="text"
           name="subject"
           required
           style="
             width:100%;
             padding:12px;
             border-radius:10px;
             border:1px solid #e5e7eb;
             margin-top:8px;
             margin-bottom:16px;
           ">

    <!-- MESSAGE -->
    <label style="font-weight:600; color:#1e293b;">
        Message
    </label>

    <textarea name="message"
              rows="6"
              required
              style="
                width:100%;
                padding:12px;
                border-radius:10px;
                border:1px solid #e5e7eb;
                margin-top:8px;
                resize:vertical;
              "></textarea>

    <!-- ACTIONS -->
    <div style="margin-top:20px;">
        <button type="submit" class="btn">
            Send Message
        </button>

        <a href="<?= site_url('teacher/dashboard') ?>"
           class="btn"
           style="background:#64748b; margin-left:10px;">
            Back
        </a>
    </div>

</form>

</div>

<?= $this->endSection() ?>