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

/* ===== LAYOUT ===== */
.report-wrapper {
    display: flex;
    gap: 24px;
}

/* ===== STUDENT LIST ===== */
.student-list {
    width: 260px;
}

.student-item {
    padding: 12px 14px;
    border-radius: 10px;
    cursor: pointer;
    margin-bottom: 6px;
    background: #f8fafc;
    transition: all 0.2s ease;
    font-weight: 500;
}

.student-item:hover {
    background: #eef2ff;
}

.student-item.active {
    background: var(--secondary);
    color: white;
    font-weight: 600;
    box-shadow: 0 8px 20px rgba(37,99,235,0.35);
}

/* ===== CARD ===== */
.card {
    background: var(--bg-card);
    padding: 24px;
    border-radius: 16px;
    box-shadow: 0 14px 30px rgba(0,0,0,0.08);
    margin-bottom: 30px;
}

/* ===== TABLE ===== */
table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 15px;
}

th, td {
    padding: 12px 14px;
    text-align: center;
}

th {
    background: var(--primary);
    color: white;
}

tr:nth-child(even) {
    background: var(--bg-soft);
}

tr:hover {
    background: #eef2ff;
}

/* ===== REPORT CARD ===== */
.report-card {
    display: none;
}

.report-card.active {
    display: block;
}
</style>

<h2>Report Cards — <?= esc($term) ?></h2>

<div class="report-wrapper">

    <!-- ===== STUDENT SELECTOR ===== -->
    <div class="student-list">
        <div class="card">
            <h3>Students</h3>

            <?php foreach ($students as $index => $s): ?>
                <div
                    class="student-item <?= $index === 0 ? 'active' : '' ?>"
                    data-student="<?= $s['id'] ?>"
                >
                    <?= esc($s['name']) ?>
                </div>
            <?php endforeach; ?>
        </div>
    </div>

    <!-- ===== REPORT CARD DISPLAY ===== -->
    <div style="flex:1;">

        <?php foreach ($students as $index => $s): ?>
            <div
                class="card report-card <?= $index === 0 ? 'active' : '' ?>"
                data-student="<?= $s['id'] ?>"
            >

                <h3><?= esc($s['name']) ?></h3>

                <form method="post"
      action="<?= site_url('admin/issue-report-card') ?>"
      style="margin-bottom:20px;">

    <input type="hidden" name="class_id" value="<?= $classId ?>">
    <input type="hidden" name="term" value="<?= esc($term) ?>">

    <button class="btn"
            onclick="return confirm('Issue report cards for this class and term?')">
        📢 Issue Report Cards
    </button>
</form>

                <table>
                    <thead>
                        <tr>
                            <th>Subject</th>
                            <th>Midterm (40)</th>
                            <th>Final (60)</th>
                            <th>Total</th>
                            <th>Comment</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($subjects as $sub):
                            $subject = $sub['subject'];
                            $g = $gradeMap[$s['id']][$subject] ?? null;
                        ?>
                        <tr>
                            <td><?= esc($subject) ?></td>
                            <td><?= $g['midterm'] ?? '-' ?></td>
                            <td><?= $g['final'] ?? '-' ?></td>
                            <td><?= $g['total'] ?? '-' ?></td>
                            <td><?= esc($g['comment'] ?? '-') ?></td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>

            </div>
        <?php endforeach; ?>

    </div>
</div>

<script>
document.querySelectorAll('.student-item').forEach(item => {
    item.addEventListener('click', () => {
        const studentId = item.dataset.student;

        // Toggle active student button
        document.querySelectorAll('.student-item')
            .forEach(i => i.classList.remove('active'));
        item.classList.add('active');

        // Toggle report cards
        document.querySelectorAll('.report-card')
            .forEach(card => {
                card.classList.toggle(
                    'active',
                    card.dataset.student === studentId
                );
            });
    });
});
</script>

<?= $this->endSection() ?>