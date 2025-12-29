<?= $this->extend('teacher/layout') ?>
<?= $this->section('content') ?>

<h1>Create Homework</h1>
<p style="color:#64748b; margin-top:-8px; margin-bottom:24px;">
    Assign a new homework task to your class
</p>

<div class="card">

<form method="post"
      action="<?= site_url('teacher/homework/save') ?>"
      enctype="multipart/form-data">

    <!-- CLASS -->
    <div class="form-group">
        <label>Select Class</label>
        <select name="class_id" required>
            <?php foreach ($classes as $c): ?>
                <option value="<?= $c['id'] ?>">
                    Grade <?= esc($c['grade']) ?> - <?= esc($c['section']) ?>
                    (<?= esc($c['subject']) ?>)
                </option>
            <?php endforeach; ?>
        </select>
    </div>

    <!-- SUBJECT + MAX GRADE -->
    <div class="form-row">
        <div class="form-group">
            <label>Subject</label>
            <input type="text" name="subject" required>
        </div>

        <div class="form-group">
            <label>Maximum Grade</label>
            <input type="number" name="max_grade" required min="1">
        </div>
    </div>

    <!-- TITLE -->
    <div class="form-group">
        <label>Homework Title</label>
        <input type="text" name="title" required>
    </div>

    <!-- DESCRIPTION -->
    <div class="form-group">
        <label>Description</label>
        <textarea name="description"
                  rows="4"
                  placeholder="Explain the homework requirements..."></textarea>
    </div>

    <!-- DUE DATE -->
    <div class="form-group">
        <label>Due Date & Time</label>
        <input type="datetime-local" name="due_datetime" required>
    </div>

    <!-- ATTACHMENT -->
    <div class="form-group">
        <label>Attachment (optional)</label>
        <input type="file" name="attachment">
        <small style="color:#64748b;">
            PDF, Word, or image files
        </small>
    </div>

    <!-- ACTIONS -->
    <div style="margin-top:28px;">
        <button type="submit" class="btn">
            Create Homework
        </button>

        <a href="<?= site_url('teacher/homework') ?>"
           class="btn"
           style="background:#64748b; margin-left:10px;">
            Cancel
        </a>
    </div>

</form>

</div>

<?= $this->endSection() ?>