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
    max-width: 450px;
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

input {
    width: 100%;
    padding: 10px 12px;
    border-radius: 8px;
    border: 1px solid #cbd5f5;
    font-size: 14px;
}

input:focus {
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

<h2>Add Subject</h2>

<div class="card">
    <form method="post" action="<?= site_url('admin/save-subject') ?>">

        <div class="form-group">
            <label>Subject Name</label>
            <input type="text" name="name" required>
        </div>

        <div class="form-group">
            <label>Subject Code</label>
            <input type="text" name="code" required>
        </div>

        <button class="btn" type="submit">Save Subject</button>

    </form>
</div>

<a class="back-link" href="<?= site_url('admin/subjects') ?>">⬅ Back</a>

<?= $this->endSection() ?>