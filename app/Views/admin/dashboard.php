<?= $this->extend('admin/layout') ?>
<?= $this->section('content') ?>

<style>
/* ===== COLORS ===== */
:root {
    --primary: #1e3a8a;      /* dark blue */
    --secondary: #2563eb;    /* button blue */
    --bg-card: #ffffff;
    --bg-soft: #f8fafc;
}

/* ===== HEADINGS ===== */
h1, h2, h3, h4 {
    color: var(--primary);
    margin-top: 0;
}

/* ===== STATS ===== */
.stats {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
    gap: 20px;
    margin-bottom: 35px;
}

.stat {
    background: var(--bg-card);
    padding: 22px;
    border-radius: 14px;
    text-align: center;
    box-shadow: 0 10px 25px rgba(0,0,0,0.08);
}

.stat span {
    display: block;
    font-size: 14px;
    color: #64748b;
}

.stat strong {
    font-size: 28px;
    color: var(--primary);
}

/* ===== CARDS ===== */
.cards {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
    gap: 24px;
    margin-bottom: 40px;
}

.card {
    background: var(--bg-card);
    padding: 22px;
    border-radius: 16px;
    box-shadow: 0 14px 30px rgba(0,0,0,0.08);
    transition: transform .2s ease, box-shadow .2s ease;
}

.card:hover {
    transform: translateY(-6px);
    box-shadow: 0 18px 40px rgba(0,0,0,0.12);
}

.card p {
    color: #475569;
}

/* ===== BUTTONS ===== */
.btn {
    display: inline-block;
    margin-top: 12px;
    padding: 10px 18px;
    background: var(--secondary);
    color: white;
    border-radius: 10px;
    text-decoration: none;
    font-weight: 600;
    transition: background .2s ease;
}

.btn:hover {
    background: #1d4ed8;
}

/* ===== SECTIONS ===== */
.section {
    margin-bottom: 40px;
}

/* ===== LISTS (NO BULLETS) ===== */
.clean-list {
    list-style: none;
    padding: 0;
    margin: 0;
}

.clean-list li {
    padding: 6px 0;
    color: #475569;
}
</style>

<h1>Admin Dashboard</h1>

<!-- STATS -->
<div class="stats">
    <div class="stat">
        <span>Total Students</span>
        <strong><?= $students_count ?></strong>
    </div>
    <div class="stat">
        <span>Total Parents</span>
        <strong><?= $parents_count ?></strong>
    </div>
    <div class="stat">
        <span>Total Teachers</span>
        <strong><?= $teachers_count ?></strong>
    </div>
    <div class="stat">
        <span>Total Classes</span>
        <strong><?= $classes_count ?></strong>
    </div>
</div>

<!-- CLASSES -->
<div class="section">
    <h2>Classes</h2>
    <div class="cards">
        <?php foreach ($classes as $c): ?>
            <div class="card">
                <h3>Grade <?= $c['grade'] ?> - <?= $c['section'] ?></h3>
                <p>Students: <?= $c['student_count'] ?? 0 ?></p>
                <a class="btn" href="<?= site_url('admin/class-details/'.$c['id']) ?>">
                    View Class
                </a>
            </div>
        <?php endforeach; ?>
    </div>
</div>

<!-- RECENT ACTIVITY -->
<div class="section">
    <h2>Recent Activity</h2>

    <div class="stats">
        <div class="stat">
            <h4>Recently Added Students</h4>
            <ul class="clean-list">
                <?php foreach ($recentStudents as $s): ?>
                    <li><?= $s['name'] ?></li>
                <?php endforeach; ?>
            </ul>
        </div>

        <div class="stat">
            <h4>Recently Added Teachers</h4>
            <ul class="clean-list">
                <?php foreach ($recentTeachers as $t): ?>
                    <li><?= $t['name'] ?> – <?= $t['specialization'] ?></li>
                <?php endforeach; ?>
            </ul>
        </div>

        <div class="stat">
            <h4>Recent Assignments</h4>
            <ul class="clean-list">
                <?php foreach ($recentAssignments as $a): ?>
                    <li>
                        <?= $a['teacher_name'] ?> →
                        Grade <?= $a['grade'] ?> <?= $a['section'] ?>
                    </li>
                <?php endforeach; ?>
            </ul>
        </div>
    </div>
</div>

<!-- SUBJECTS -->
<div class="section">
    <h2>Subjects</h2>
    <div class="card">
        <p><?= $subjects_count ?> total subjects</p>
        <a class="btn" href="<?= site_url('admin/subjects') ?>">
            Manage Subjects
        </a>
    </div>
</div>

<!-- REPORT CARDS -->
<div class="section">
    <h2>Report Cards</h2>
    <a class="btn" href="<?= site_url('admin/report-cards') ?>">
        Generate Report Cards
    </a>
</div>

<?= $this->endSection() ?>