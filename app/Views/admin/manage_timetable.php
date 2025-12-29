<?= $this->extend('admin/layout') ?>
<?= $this->section('content') ?>

<style>
/* ===== COLORS ===== */
:root {
    --primary: #1e3a8a;
    --secondary: #2563eb;
    --bg-card: #ffffff;
    --bg-soft: #f8fafc;
    --border: #cbd5f5;
}

/* ===== HEADINGS ===== */
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

/* ===== BUTTON ===== */
.btn {
    padding: 10px 16px;
    background: var(--secondary);
    color: white;
    border-radius: 10px;
    text-decoration: none;
    font-weight: 600;
}

.btn:hover {
    background: #1d4ed8;
}

/* ===== SUBJECTS (DRAG ITEMS) ===== */
.subjects {
    display: flex;
    gap: 12px;
    flex-wrap: wrap;
}

.subject {
    padding: 12px 14px;
    background: var(--bg-soft);
    border: 1px solid var(--border);
    border-radius: 10px;
    cursor: grab;
    min-width: 140px;
    text-align: center;
    box-shadow: 0 6px 14px rgba(0,0,0,0.08);
}

.subject strong {
    display: block;
}

.subject:active {
    cursor: grabbing;
}

/* ===== TABLE ===== */
table {
    width: 100%;
    border-collapse: collapse;
}

th, td {
    border: 1px solid var(--border);
    padding: 12px;
    text-align: center;
}

th {
    background: var(--primary);
    color: white;
}

.slot {
    height: 60px;
    background: #f9fafb;
    font-style: italic;
    transition: background .2s ease;
}

.slot:hover {
    background: #eef2ff;
}

.break-cell {
    background: #e5e7eb;
    font-weight: bold;
}
</style>

<h2>Manage Timetable for Class <?= esc($class_id) ?></h2>

<a class="btn" href="<?= site_url('admin/classes') ?>">⬅ Back to Classes</a>

<!-- SUBJECTS -->
<div class="card">
    <h3>Subjects (Drag & Drop)</h3>

    <div class="subjects">
        <?php foreach ($subjects as $s): ?>
            <div draggable="true"
                 class="subject"
                 data-tcs-id="<?= $s['tcs_id'] ?>"
                 data-subject="<?= $s['subject'] ?>"
                 data-teacher-name="<?= $s['teacher_name'] ?>"
                 data-teacher-id="<?= $s['teacher_id'] ?>">

                <strong><?= esc($s['subject']) ?></strong>
                <small><?= esc($s['teacher_name']) ?></small>
            </div>
        <?php endforeach; ?>
    </div>
</div>

<!-- TIMETABLE -->
<div class="card">
    <h3>Weekly Timetable</h3>

    <table>
        <thead>
            <tr>
                <th>Period</th>
                <th>Time</th>
                <th>Monday</th>
                <th>Tuesday</th>
                <th>Wednesday</th>
                <th>Thursday</th>
                <th>Friday</th>
            </tr>
        </thead>

        <tbody>
        <?php foreach ($periods as $p): ?>
            <tr>
                <!-- PERIOD -->
                <?php if ($p['type'] === 'class'): ?>
                    <td>Period <?= $p['period_number'] ?></td>
                <?php else: ?>
                    <td class="break-cell"><?= ucfirst($p['type']) ?></td>
                <?php endif; ?>

                <!-- TIME -->
                <td><?= esc($p['start_time']) ?> - <?= esc($p['end_time']) ?></td>

                <!-- DAYS -->
                <?php if ($p['type'] === 'class'): ?>
                    <?php foreach (['Monday','Tuesday','Wednesday','Thursday','Friday'] as $day): ?>
                        <td class="slot"
                            data-period="<?= $p['id'] ?>"
                            data-day="<?= $day ?>"
                            data-class-id="<?= $class_id ?>">
                            Drop here
                        </td>
                    <?php endforeach; ?>
                <?php else: ?>
                    <td colspan="5" class="break-cell">
                        <?= ucfirst($p['type']) ?>
                    </td>
                <?php endif; ?>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
</div>

<!-- ================= JS (UNCHANGED LOGIC) ================= -->

<script>
let savedEntries = <?= json_encode($entries) ?>;

savedEntries.forEach(entry => {
    let selector = `.slot[data-period="${entry.period_id}"][data-day="${entry.day}"]`;
    let cell = document.querySelector(selector);

    if (cell) {
        cell.innerHTML = `
            <strong>${entry.subject}</strong><br>
            <small>${entry.teacher_name ?? ''}</small>
        `;
    }
});
</script>

<script>
document.querySelectorAll('.subject').forEach(subj => {
    subj.addEventListener('dragstart', e => {
        e.dataTransfer.setData('tcs_id', subj.dataset.tcsId);
        e.dataTransfer.setData('subject', subj.dataset.subject);
        e.dataTransfer.setData('teacher_name', subj.dataset.teacherName);
        e.dataTransfer.setData('teacher_id', subj.dataset.teacherId);
    });
});

document.querySelectorAll('.slot').forEach(slot => {
    slot.addEventListener('dragover', e => e.preventDefault());

    slot.addEventListener('drop', async e => {
        let tcs_id      = e.dataTransfer.getData('tcs_id');
        let subject     = e.dataTransfer.getData('subject');
        let teacher_id  = e.dataTransfer.getData('teacher_id');
        let teacherName = e.dataTransfer.getData('teacher_name');

        let period_id = slot.dataset.period;
        let day       = slot.dataset.day;
        let class_id  = slot.dataset.classId;

        let response = await fetch("<?= site_url('admin/save-timetable-entry') ?>", {
            method: "POST",
            headers: { "Content-Type": "application/json" },
            body: JSON.stringify({
                class_id,
                subject,
                tcs_id,
                teacher_id,
                period_id,
                day
            })
        });

        let result = await response.json();

        if (result.status === "success") {
            slot.innerHTML = `
                <strong>${subject}</strong><br>
                <small>${teacherName}</small>
            `;
        } else {
            alert("Error saving entry: " + (result.message ?? ""));
        }
    });
});
</script>

<?= $this->endSection() ?>