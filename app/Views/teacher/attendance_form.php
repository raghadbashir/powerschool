<?= $this->extend('teacher/layout') ?>
<?= $this->section('content') ?>

<h1>Attendance</h1>

<p style="color:#475569; margin-bottom:16px;">
    Class: <strong><?= $class['grade'] ?> - <?= $class['section'] ?></strong>
</p>

<div class="card">

    <form method="post" action="<?= site_url('teacher/attendance/submit/' . $class['id']) ?>">

        <!-- Date -->
        <div style="margin-bottom:16px;">
            <label style="font-weight:600;">Date</label><br>
            <input type="date"
                   name="date"
                   value="<?= $date ?>"
                   style="padding:8px 12px; border-radius:8px; border:1px solid #d1d5db;">
        </div>

       <table class="attendance-table">
    <thead>
        <tr>
            <th>Student</th>
            <th>Present</th>
            <th>Absent</th>
            <th>Late</th>
        </tr>
    </thead>

    <tbody>
    <?php foreach ($students as $s): ?>
        <tr>
            <td class="student-name"><?= esc($s['name']) ?></td>

            <td>
                <label>
                    <input type="radio"
                           name="status[<?= $s['id'] ?>]"
                           value="present"
                           checked>
                    <span class="status-label status-present">Present</span>
                </label>
            </td>

            <td>
                <label>
                    <input type="radio"
                           name="status[<?= $s['id'] ?>]"
                           value="absent">
                    <span class="status-label status-absent">Absent</span>
                </label>
            </td>

            <td>
                <label>
                    <input type="radio"
                           name="status[<?= $s['id'] ?>]"
                           value="late">
                    <span class="status-label status-late">Late</span>
                </label>
            </td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>

        <!-- Actions -->
        <div style="margin-top:20px;">
            <button type="submit" class="btn">
                Save Attendance
            </button>

            <a href="<?= site_url('teacher/dashboard') ?>"
               class="btn"
               style="background:#64748b;">
               Back
            </a>
        </div>

    </form>

</div>

<?= $this->endSection() ?>