<?= $this->extend('teacher/layout') ?>
<?= $this->section('content') ?>

<h1>Lesson Materials</h1>

<p style="color:#64748b; margin-top:-10px;">
    Class: <strong>Grade <?= $class['grade'] ?> - Section <?= $class['section'] ?></strong>
</p>

<!-- ================= UPLOAD MATERIAL ================= -->
<div class="card">

<h3 style="margin-top:0;">Upload New Material</h3>

<form method="post"
      enctype="multipart/form-data"
      action="<?= site_url('teacher/materials/upload/' . $class['id']) ?>">

    <!-- TITLE -->
    <label style="font-weight:600;">Title</label>
    <input type="text"
           name="title"
           required
           style="
             width:100%;
             padding:12px;
             border-radius:10px;
             border:1px solid #e5e7eb;
             margin-top:8px;
             margin-bottom:16px;
           ">

    <!-- DESCRIPTION -->
    <label style="font-weight:600;">Description</label>
    <textarea name="description"
              rows="3"
              style="
                width:100%;
                padding:12px;
                border-radius:10px;
                border:1px solid #e5e7eb;
                margin-top:8px;
                margin-bottom:16px;
                resize:vertical;
              "></textarea>

    <!-- FILE -->
    <label style="font-weight:600;">File</label>
    <input type="file"
           name="file"
           style="margin-top:8px; margin-bottom:16px;">

    <button type="submit" class="btn">
        Upload Material
    </button>

</form>

</div>

<!-- ================= MATERIALS LIST ================= -->
<div class="card">

<h3 style="margin-top:0;">Uploaded Materials</h3>

<?php if (empty($materials)): ?>
    <p style="color:#64748b;">No materials uploaded yet.</p>
<?php else: ?>

    <?php foreach ($materials as $m): ?>
        <div style="
            padding:14px;
            border-radius:12px;
            background:#f8fafc;
            margin-bottom:12px;
            border:1px solid #e5e7eb;
        ">
            <strong style="color:#2563eb;">
                <?= esc($m['title']) ?>
            </strong>

            <span style="color:#64748b; font-size:13px;">
                — <?= esc($m['created_at']) ?>
            </span>

            <?php if (!empty($m['description'])): ?>
                <p style="margin:8px 0; color:#1e293b;">
                    <?= esc($m['description']) ?>
                </p>
            <?php endif; ?>

            <?php if ($m['file_path']): ?>
                <a href="<?= base_url($m['file_path']) ?>"
                   target="_blank"
                   class="btn"
                   style="padding:6px 12px; font-size:13px;">
                    Download File
                </a>
            <?php endif; ?>
        </div>
    <?php endforeach; ?>

<?php endif; ?>

</div>

<!-- ================= ACTION ================= -->
<div style="margin-top:20px;">
    <a href="<?= site_url('teacher/dashboard') ?>"
       class="btn"
       style="background:#64748b;">
        ← Back to Dashboard
    </a>
</div>

<?= $this->endSection() ?>