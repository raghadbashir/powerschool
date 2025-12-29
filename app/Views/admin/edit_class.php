<?= $this->extend('admin/layout') ?>

<?= $this->section('content') ?>

<h1>Edit Class</h1>

<form action="<?= site_url('admin/update-class/' . $class['id']) ?>" method="post">

    <label>Grade</label>
    <input
        type="text"
        name="grade"
        value="<?= esc($class['grade']) ?>"
        class="form-input"
        required
    >

    <label>Section</label>
    <input
        type="text"
        name="section"
        value="<?= esc($class['section']) ?>"
        class="form-input"
        required
    >

    <button
        type="submit"
        style="
            background: linear-gradient(135deg, #2563eb, #1d4ed8);
            color: white;
            padding: 12px 22px;
            border: none;
            border-radius: 12px;
            font-size: 15px;
            font-weight: 600;
            cursor: pointer;
            box-shadow: 0 8px 20px rgba(37,99,235,0.35);
        "
    >
        Save Changes
    </button>

</form>

<br><br>

<a href="<?= site_url('admin/classes') ?>"
   style="color:#2563eb; font-weight:600;">
    ← Back to Classes List
</a>

<?= $this->endSection() ?>