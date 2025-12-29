<?= $this->extend('admin/layout') ?>
<?= $this->section('content') ?>

<div class="card" style="max-width:600px;">

    <h1>Add Student</h1>
    <p style="color:#64748b; margin-top:-10px;">
        Create a new student record
    </p>

    <form action="<?= site_url('admin/save-student') ?>" method="post">

        <label style="font-weight:600;">Student Number</label>
        <input type="text"
               name="student_number"
               required
               class="form-input">

        <label style="font-weight:600;">Student Name</label>
        <input type="text"
               name="name"
               required
               class="form-input">

        <label style="font-weight:600;">Date of Birth</label>
        <input type="date"
               name="date_of_birth"
               class="form-input">

        <label style="font-weight:600;">Parent</label>
        <select name="parent_id" class="form-input">
            <option value="">Select Parent</option>
            <?php foreach ($parents as $p): ?>
                <option value="<?= $p['id'] ?>">
                    <?= esc($p['parent_name']) ?> (<?= esc($p['email']) ?>)
                </option>
            <?php endforeach; ?>
        </select>

        <label style="font-weight:600;">Class</label>
        <select name="class_id" class="form-input">
            <option value="">No Class Assigned</option>
            <?php foreach ($classes as $c): ?>
                <option value="<?= $c['id'] ?>">
                    Grade <?= esc($c['grade']) ?> - Section <?= esc($c['section']) ?>
                </option>
            <?php endforeach; ?>
        </select>

        <div style="margin-top:25px;">
            <button class="btn" type="submit">
                Save Student
            </button>

           
        </div>

    </form>
</div>

<?= $this->endSection() ?>