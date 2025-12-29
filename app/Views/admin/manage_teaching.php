<?= $this->extend('admin/layout') ?>
<?= $this->section('content') ?>

<style>
:root {
    --primary: #1e3a8a;
    --secondary: #2563eb;
    --bg-card: #ffffff;
    --bg-soft: #f8fafc;
}

h1, h2, h3 {
    color: var(--primary);
    margin-top: 0;
}

/* ===== CARD ===== */
.card {
    background: var(--bg-card);
    padding: 24px;
    border-radius: 16px;
    box-shadow: 0 14px 30px rgba(0,0,0,0.08);
    margin-bottom: 30px;
}

/* ===== FORM ===== */
form {
    display: grid;
    gap: 16px;
}

select, input {
    padding: 10px;
    border-radius: 8px;
    border: 1px solid #ccc;
}

/* ===== BUTTON ===== */
.btn {
    width: fit-content;
    padding: 10px 18px;
    background: var(--secondary);
    color: white;
    border-radius: 10px;
    border: none;
    cursor: pointer;
}

.btn:hover {
    background: #1d4ed8;
}

/* ===== FILTER BAR ===== */
.filters {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
    gap: 20px;
    margin-bottom: 20px;
}

/* ===== TABLE ===== */
table {
    width: 100%;
    border-collapse: collapse;
}

th, td {
    padding: 12px;
    text-align: left;
}

th {
    background: var(--primary);
    color: white;
}

tr:nth-child(even) {
    background: var(--bg-soft);
}

tr.hidden {
    display: none;
}

.delete-link {
    color: red;
    text-decoration: none;
}

.delete-link:hover {
    text-decoration: underline;
}
</style>

<h1>Assign Teacher to Class</h1>

<!-- ================= ASSIGN FORM ================= -->
<div class="card">
    <h2>Assign Teacher</h2>

    <form action="<?= site_url('admin/save-teaching') ?>" method="post">
        <select name="teacher_id" required>
            <option value="">Select Teacher</option>
            <?php foreach ($teachers as $t): ?>
                <option value="<?= $t['id'] ?>">
                    <?= $t['name'] ?> (<?= $t['specialization'] ?>)
                </option>
            <?php endforeach; ?>
        </select>

        <select name="class_id" required>
            <option value="">Select Class</option>
            <?php foreach ($classes as $c): ?>
                <option value="<?= $c['id'] ?>">
                    Grade <?= $c['grade'] ?> - Section <?= $c['section'] ?>
                </option>
            <?php endforeach; ?>
        </select>

        <input type="text" name="subject" placeholder="Subject" required>

        <button class="btn">Assign</button>
    </form>
</div>

<!-- ================= FILTERS ================= -->
<div class="card">
    <h2>Filter Assignments</h2>

    <div class="filters">
        <select id="filterClass">
            <option value="">All Classes</option>
            <?php foreach ($classes as $c): ?>
                <option value="<?= $c['id'] ?>">
                    Grade <?= $c['grade'] ?> - <?= $c['section'] ?>
                </option>
            <?php endforeach; ?>
        </select>

        <select id="filterSubject">
            <option value="">All Subjects</option>
            <?php foreach (array_unique(array_column($assignments, 'subject')) as $sub): ?>
                <option value="<?= $sub ?>"><?= $sub ?></option>
            <?php endforeach; ?>
        </select>
    </div>
</div>

<!-- ================= ASSIGNMENTS TABLE ================= -->
<div class="card">
    <h2>Current Assignments</h2>

    <table id="assignmentsTable">
        <thead>
            <tr>
                <th>ID</th>
                <th>Teacher</th>
                <th>Class</th>
                <th>Subject</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
        <?php foreach ($assignments as $a): ?>
            <?php
                $teacher = $teachers[array_search($a['teacher_id'], array_column($teachers, 'id'))];
                $class = $classes[array_search($a['class_id'], array_column($classes, 'id'))];
            ?>
            <tr 
                data-class="<?= $a['class_id'] ?>"
                data-subject="<?= $a['subject'] ?>"
            >
                <td><?= $a['id'] ?></td>
                <td><?= $teacher['name'] ?></td>
                <td>Grade <?= $class['grade'] ?> - <?= $class['section'] ?></td>
                <td><?= $a['subject'] ?></td>
                <td>
                    <a class="delete-link"
                       href="<?= site_url('admin/delete-teaching/'.$a['id']) ?>">
                        🗑 Delete
                    </a>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
</div>

<script>
const classFilter = document.getElementById('filterClass');
const subjectFilter = document.getElementById('filterSubject');
const rows = document.querySelectorAll('#assignmentsTable tbody tr');

function applyFilters() {
    const classVal = classFilter.value;
    const subjectVal = subjectFilter.value;

    rows.forEach(row => {
        const matchClass = !classVal || row.dataset.class === classVal;
        const matchSubject = !subjectVal || row.dataset.subject === subjectVal;

        row.classList.toggle('hidden', !(matchClass && matchSubject));
    });
}

classFilter.addEventListener('change', applyFilters);
subjectFilter.addEventListener('change', applyFilters);
</script>

<?= $this->endSection() ?>