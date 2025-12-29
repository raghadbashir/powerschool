<?= $this->extend('admin/layout') ?>
<?= $this->section('content') ?>

<style>
:root {
    --primary: #1e3a8a;
    --secondary: #2563eb;
    --bg-card: #ffffff;
    --bg-soft: #f8fafc;
}

/* ===== HEADINGS ===== */
h2, h3 {
    color: var(--primary);
    margin-top: 0;
}

/* ===== GRID LAYOUT ===== */
.reportcard-grid {
    display: grid;
    grid-template-columns: 1.6fr 1fr;
    gap: 30px;
    align-items: start;
}

/* ===== CARDS ===== */
.card {
    background: var(--bg-card);
    padding: 24px;
    border-radius: 16px;
    box-shadow: 0 14px 30px rgba(0,0,0,0.08);
}

/* ===== CLASS LIST ===== */
.class-list {
    max-height: 520px;
    overflow-y: auto;
}

table {
    width: 100%;
    border-collapse: collapse;
}

td {
    padding: 14px;
}

tr:nth-child(even) {
    background: var(--bg-soft);
}

tr:hover {
    background: #eef2ff;
    cursor: pointer;
}

.selected-row {
    outline: 2px solid var(--secondary);
    background: #eff6ff !important;
}

/* ===== TERM PANEL ===== */
.term-panel {
    position: sticky;
    top: 90px;
}

.term-buttons {
    display: flex;
    gap: 16px;
    margin-top: 20px;
    flex-wrap: wrap;
}

/* ===== BUTTONS ===== */
.btn {
    padding: 12px 20px;
    background: var(--secondary);
    color: white;
    border-radius: 10px;
    border: none;
    font-weight: 600;
    cursor: pointer;
    transition: all 0.2s ease;
}

.btn:hover {
    background: #1d4ed8;
    transform: translateY(-2px);
}
</style>

<h2>Select Class & Term for Report Cards</h2>

<div class="reportcard-grid">

    <!-- ================= LEFT: CLASSES ================= -->
    <div class="card class-list">
        <h3>1️⃣ Choose a Class</h3>

        <table>
            <tbody>
            <?php foreach ($classes as $c): ?>
                <tr class="class-row"
                    data-class-id="<?= $c['id'] ?>"
                    data-class-name="<?= $c['grade'] ?> - <?= $c['section'] ?>">
                    <td><?= $c['grade'] ?> - <?= $c['section'] ?></td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <!-- ================= RIGHT: TERMS ================= -->
    <div class="card term-panel">
        <h3>
            2️⃣ Select Term<br>
            <small id="selectedClassName" style="color:#2563eb;">
                Select a class first
            </small>
        </h3>

        <div class="term-buttons">
            <button class="btn term-btn" data-term="Term 1">Term 1</button>
            <button class="btn term-btn" data-term="Term 2">Term 2</button>
            <button class="btn term-btn" data-term="Final">Final</button>
        </div>
    </div>

</div>

<script>
let selectedClassId = null;

// Class selection
document.querySelectorAll('.class-row').forEach(row => {
    row.addEventListener('click', () => {

        document.querySelectorAll('.class-row')
            .forEach(r => r.classList.remove('selected-row'));

        row.classList.add('selected-row');

        selectedClassId = row.dataset.classId;
        document.getElementById('selectedClassName').innerText =
            row.dataset.className;
    });
});

// Term selection
document.querySelectorAll('.term-btn').forEach(btn => {
    btn.addEventListener('click', () => {
        if (!selectedClassId) return;

        window.location.href =
            `<?= site_url('admin/report-cards/generate') ?>/${selectedClassId}/${btn.dataset.term}`;
    });
});
</script>

<?= $this->endSection() ?>