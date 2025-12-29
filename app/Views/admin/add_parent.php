<?= $this->extend('admin/layout') ?>
<?= $this->section('content') ?>

<style>
/* ===== PAGE CARD ===== */
.form-card {
    background: var(--bg-card);
    padding: 30px;
    border-radius: 16px;
    max-width: 520px;
    box-shadow: 0 14px 30px rgba(0,0,0,0.08);
}

/* ===== FORM ===== */
.form-group {
    margin-bottom: 18px;
}

label {
    display: block;
    font-weight: 600;
    color: var(--primary);
    margin-bottom: 6px;
}

input {
    width: 100%;
    padding: 10px 14px;
    border-radius: 10px;
    border: 1px solid #cbd5e1;
    font-size: 14px;
}

/* ===== ACTIONS ===== */
.actions {
    margin-top: 20px;
}

.back-link {
    display: inline-block;
    margin-top: 18px;
    color: #475569;
    text-decoration: none;
    font-weight: 600;
}
</style>

<h1>Add Parent</h1>

<div class="form-card">
    <form action="<?= site_url('admin/save-parent') ?>" method="post">

        <div class="form-group">
            <label>Parent Name</label>
            <input type="text" name="parent_name" required>
        </div>

        <div class="form-group">
            <label>Email</label>
            <input type="email" name="email">
        </div>

        <div class="form-group">
            <label>Phone</label>
            <input type="text" name="phone">
        </div>

        <div class="actions">
            <button class="btn" type="submit">Save Parent</button>
        </div>
    </form>
</div>

<a class="back-link" href="<?= site_url('admin/parents') ?>">⬅ Back</a>

<?= $this->endSection() ?>