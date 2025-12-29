<?= $this->extend('student/layout') ?>
<?= $this->section('content') ?>

<h1>Upload Homework</h1>

<div class="card">

    <h2><?= esc($homework['title']) ?></h2>

    <?php if (!empty($homework['description'])): ?>
        <p style="color:#475569; margin-top:8px;">
            <?= esc($homework['description']) ?>
        </p>
    <?php endif; ?>

    <p style="margin-top:12px;">
        <strong>Due:</strong>
        <?= date('d M Y H:i', strtotime($homework['due_datetime'])) ?>
    </p>

    <hr style="margin:20px 0; border:none; border-top:1px solid #e5e7eb;">

    <?php if ($existing): ?>
        <div style="
            background:#ecfdf5;
            border-left:4px solid #22c55e;
            padding:12px;
            border-radius:8px;
            margin-bottom:20px;
        ">
            <strong>✔ Homework already submitted</strong><br>
            <small>
                Submitted on <?= date('d M Y H:i', strtotime($existing['submitted_at'])) ?>
            </small>

            <div style="margin-top:10px;">
                <a class="btn" target="_blank" href="/<?= esc($existing['submitted_file']) ?>">
                    View Submitted File
                </a>
            </div>
        </div>

        <p style="color:#64748b; font-size:14px;">
            You may re-upload if allowed:
        </p>
    <?php endif; ?>

    <form method="post"
          enctype="multipart/form-data"
          action="<?= site_url('student/homework/upload/' . $homework['id']) ?>">

        <label style="font-weight:600;">Select file</label><br><br>

        <input type="file" name="submission" required><br><br>

        <button type="submit" class="btn">
            Submit Homework
        </button>
    </form>

</div>

<a class="btn" style="background:#64748b; margin-top:10px;"
   href="<?= site_url('student/homework') ?>">
    ← Back to Homework
</a>

<?= $this->endSection() ?>