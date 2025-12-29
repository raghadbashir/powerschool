<?= $this->extend('admin/layout') ?>
<?= $this->section('content') ?>

<style>
/* ===== COLORS ===== */
:root {
    --primary: #1e3a8a;
    --secondary: #2563eb;
    --bg-card: #ffffff;
    --bg-soft: #f8fafc;
}

/* ===== HEADINGS ===== */
h1, h2, h3, h4 {
    color: var(--primary);
    margin-top: 0;
}

/* ===== CARD ===== */
.card {
    background: var(--bg-card);
    padding: 28px;
    border-radius: 16px;
    box-shadow: 0 14px 30px rgba(0,0,0,0.08);
    max-width: 600px;
}

/* ===== FORM ===== */
.form-group {
    margin-bottom: 18px;
}

label {
    display: block;
    font-weight: 600;
    margin-bottom: 6px;
    color: #334155;
}

input, select {
    width: 100%;
    padding: 10px 12px;
    border-radius: 8px;
    border: 1px solid #cbd5f5;
    font-size: 14px;
}

input:focus, select:focus {
    outline: none;
    border-color: var(--secondary);
}

/* ===== BUTTON ===== */
.btn {
    display: inline-block;
    padding: 12px 22px;
    background: var(--secondary);
    color: white;
    border-radius: 10px;
    border: none;
    font-weight: 600;
    cursor: pointer;
    transition: background .2s ease, transform .2s ease;
}

.btn:hover {
    background: #1d4ed8;
    transform: translateY(-2px);
}
</style>

<h1>Edit Student</h1>

<div class="card">
    <form action="<?= site_url('admin/update-student/'.$student['id']) ?>" method="post">

        <div class="form-group">
            <label>Student Number</label>
            <input type="text" name="student_number"
                   value="<?= esc($student['student_number']) ?>" required>
        </div>

        <div class="form-group">
            <label>Student Name</label>
            <input type="text" name="name"
                   value="<?= esc($student['name']) ?>" required>
        </div>

        <div class="form-group">
            <label>Date of Birth</label>
            <input type="date" name="date_of_birth"
                   value="<?= esc($student['date_of_birth']) ?>" required>
        </div>

        <div class="form-group">
            <label>Parent</label>
            <select name="parent_id">
                <option value="">Select Parent</option>
                <?php foreach ($parents as $p): ?>
                    <option value="<?= $p['id'] ?>"
                        <?= ($student['parent_id'] == $p['id']) ? 'selected' : '' ?>>
                        <?= esc($p['parent_name']) ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="form-group">
            <label>Class</label>
            <select name="class_id">
                <option value="">-- No Class Assigned --</option>
                <?php foreach ($classes as $c): ?>
                    <option value="<?= $c['id'] ?>"
                        <?= ($student['class_id'] == $c['id']) ? 'selected' : '' ?>>
                        Grade <?= $c['grade'] ?> - Section <?= $c['section'] ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>

        <button class="btn" type="submit">Update Student</button>

    </form>
</div>

<?= $this->endSection() ?>