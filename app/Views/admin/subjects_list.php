<?= $this->extend('admin/layout') ?>
<?= $this->section('content') ?>

<style>
:root {
    --primary: #1e3a8a;
    --secondary: #2563eb;
    --danger: #dc2626;
    --bg-card: #ffffff;
    --bg-soft: #f8fafc;
    --text-muted: #64748b;
}

/* ===== PAGE HEADER ===== */
.page-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 26px;
}

.page-header h2 {
    margin: 0;
    color: var(--primary);
}

.page-header p {
    margin-top: 6px;
    color: var(--text-muted);
    font-size: 14px;
}

/* ===== BUTTON ===== */
.btn {
    padding: 10px 18px;
    background: var(--secondary);
    color: white;
    border-radius: 10px;
    text-decoration: none;
    font-weight: 600;
    transition: background .2s ease, transform .1s ease;
}

.btn:hover {
    background: #1d4ed8;
    transform: translateY(-1px);
}

/* ===== FILTER BAR ===== */
.filter-bar {
    display: flex;
    gap: 12px;
    flex-wrap: wrap;
    margin-bottom: 20px;
}

.filter-chip {
    padding: 8px 16px;
    border-radius: 999px;
    background: var(--bg-soft);
    color: #475569;
    font-weight: 600;
    cursor: pointer;
    font-size: 14px;
    transition: all .2s ease;
}

.filter-chip:hover {
    background: #e0e7ff;
}

.filter-chip.active {
    background: var(--secondary);
    color: white;
}

/* ===== CARD ===== */
.card {
    background: var(--bg-card);
    padding: 26px;
    border-radius: 18px;
    box-shadow: 0 18px 40px rgba(0,0,0,0.08);
}

/* ===== TABLE ===== */
.modern-table {
    width: 100%;
    border-collapse: collapse;
}

.modern-table th {
    background: #f1f5f9;
    color: var(--primary);
    font-weight: 700;
    padding: 14px;
    text-align: left;
    font-size: 14px;
}

.modern-table td {
    padding: 14px;
    border-bottom: 1px solid #e5e7eb;
    font-size: 14px;
}

.modern-table tr:hover {
    background: #f8fafc;
}

tr.hidden {
    display: none;
}

/* ===== ACTIONS ===== */
.action-btn {
    padding: 6px 14px;
    border-radius: 999px;
    font-size: 13px;
    font-weight: 600;
    text-decoration: none;
    background: #fee2e2;
    color: #991b1b;
}

.action-btn:hover {
    background: #fecaca;
}

/* ===== EMPTY STATE ===== */
.empty {
    text-align: center;
    padding: 36px;
    color: var(--text-muted);
    font-size: 14px;
}
</style>

<!-- ===== HEADER ===== -->
<div class="page-header">
    <div>
        <h2>Subjects</h2>
        <p>Manage and organize school subjects</p>
    </div>

    <a class="btn" href="<?= site_url('admin/add-subject') ?>">
        ➕ Add Subject
    </a>
</div>

<!-- ===== FILTERS (UI ONLY) ===== -->
<div class="filter-bar">
    <span class="filter-chip active" data-field="all">All</span>
    <span class="filter-chip" data-field="stem">STEM</span>
    <span class="filter-chip" data-field="languages">Languages</span>
    <span class="filter-chip" data-field="humanities">Humanities</span>
    <span class="filter-chip" data-field="arts">Arts</span>
</div>

<!-- ===== TABLE CARD ===== -->
<div class="card">
    <table class="modern-table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Subject</th>
                <th>Code</th>
                <th>Actions</th>
            </tr>
        </thead>

        <tbody id="subjectsTable">
        <?php foreach ($subjects as $s): ?>
            <tr data-subject="<?= strtolower($s['name']) ?>">
                <td><?= esc($s['id']) ?></td>
                <td><?= esc($s['name']) ?></td>
                <td><?= esc($s['code']) ?></td>
                <td>
                    <a class="action-btn"
                       href="<?= site_url('admin/delete-subject/'.$s['id']) ?>"
                       onclick="return confirm('Delete this subject?')">
                        Delete
                    </a>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>

    <div class="empty" id="noResults" style="display:none;">
        No subjects found in this category.
    </div>
</div>

<!-- ===== UI-ONLY FILTER SCRIPT ===== -->
<script>
const FIELD_MAP = {
    stem: ['mathematics','physics','chemistry','biology','computer science','information technology'],
    languages: ['english','arabic','english language','arabic language'],
    humanities: ['history','geography','islamic studies','civics','social studies'],
    arts: ['art','music','physical education']
};

const chips = document.querySelectorAll('.filter-chip');
const rows  = document.querySelectorAll('#subjectsTable tr');
const empty = document.getElementById('noResults');

chips.forEach(chip => {
    chip.addEventListener('click', () => {

        chips.forEach(c => c.classList.remove('active'));
        chip.classList.add('active');

        const field = chip.dataset.field;
        let visibleCount = 0;

        rows.forEach(row => {
            const subject = row.dataset.subject;

            if (field === 'all') {
                row.classList.remove('hidden');
                visibleCount++;
                return;
            }

            if (FIELD_MAP[field]?.includes(subject)) {
                row.classList.remove('hidden');
                visibleCount++;
            } else {
                row.classList.add('hidden');
            }
        });

        empty.style.display = visibleCount === 0 ? 'block' : 'none';
    });
});
</script>

<?= $this->endSection() ?>