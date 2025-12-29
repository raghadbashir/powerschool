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

/* ===== BACK LINK ===== */
.back-link {
    display: inline-block;
    margin-top: 18px;
    color: var(--secondary);
    font-weight: 600;
    text-decoration: none;
}

.back-link:hover {
    text-decoration: underline;
}
</style>

<h1>Edit Teacher</h1>

<div class="card">
    <form action="<?= site_url('admin/update-teacher/'.$teacher['id']) ?>" method="post">

        <div class="form-group">
            <label>Name</label>
            <input type="text" name="name"
                   value="<?= esc($teacher['name']) ?>" required>
        </div>

        <div class="form-group">
            <label>Email</label>
            <input type="email" name="email"
                   value="<?= esc($teacher['email']) ?>" required>
        </div>

        <div class="form-group">
            <label>Phone</label>
            <input type="text" name="phone"
                   value="<?= esc($teacher['phone']) ?>">
        </div>

        <div class="form-group">
            <label>Specialization</label>
            <input type="text" name="specialization"
                   value="<?= esc($teacher['specialization']) ?>">
        </div>

        <div class="form-group">
            <label>Gender</label>
            <select name="gender">
                <option value="Male"   <?= ($teacher['gender']=='Male') ? 'selected' : '' ?>>Male</option>
                <option value="Female" <?= ($teacher['gender']=='Female') ? 'selected' : '' ?>>Female</option>
            </select>
        </div>

        <div class="form-group">
            <label>Hire Date</label>
            <input type="date" name="hire_date"
                   value="<?= esc($teacher['hire_date']) ?>">
        </div>

        <button class="btn" type="submit">Save Changes</button>

    </form>
</div>

<a class="back-link" href="<?= site_url('admin/teachers') ?>">⬅ Back to Teachers List</a>

<?= $this->endSection() ?>