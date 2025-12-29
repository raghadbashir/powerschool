<?= $this->extend('teacher/layout') ?>
<?= $this->section('content') ?>

<h1>Attendance Details</h1>

<p style="color:#475569; margin-bottom:20px;">
    Date: <strong><?= esc($date) ?></strong><br>
    Class: <strong><?= esc($class['grade']) ?> - <?= esc($class['section']) ?></strong>
</p>

<div class="card">

<form method="post"
      action="<?= site_url('teacher/update-attendance/' . $class['id'] . '/' . $date) ?>">
   <table class="history-table">
    <thead>
        <tr>
            <th>Student</th>
            <th>Status</th>
        </tr>
    </thead>

    <tbody>
    <?php foreach ($records as $r): ?>
        <tr>
            <td class="student-name"><?= esc($r['student_name']) ?></td>
            <td>
                <select name="status[<?= $r['student_id'] ?>]"
                        class="status-select <?= esc($r['status']) ?>">
                    <option value="present"
                        <?= $r['status'] === 'present' ? 'selected' : '' ?>>
                        Present
                    </option>
                    <option value="absent"
                        <?= $r['status'] === 'absent' ? 'selected' : '' ?>>
                        Absent
                    </option>
                    <option value="late"
                        <?= $r['status'] === 'late' ? 'selected' : '' ?>>
                        Late
                    </option>
                </select>
            </td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>
    <div style="margin-top:20px;">
        

        <a href="<?= site_url('teacher/export-attendance/' . $class['id'] . '/' . $date) ?>"
           class="btn"
           style="background:#64748b;">
            Download CSV
        </a>
    </div>

</form>

</div>

<div style="margin-top:20px;">
    <a href="<?= site_url('teacher/attendance-history/' . $class['id']) ?>"
       class="btn"
       style="background:#64748b;">
        Back to Attendance History
    </a>
</div>

<?= $this->endSection() ?>
<script>
document.addEventListener('change', function (e) {
    if (e.target.classList.contains('status-select')) {
        e.target.classList.remove('present', 'absent', 'late');
        e.target.classList.add(e.target.value);
    }
});
</script>