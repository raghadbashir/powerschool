<?= $this->extend('teacher/layout') ?>
<?= $this->section('content') ?>

<h1>Enter Grades</h1>

<p style="color:#64748b; margin-top:-8px; margin-bottom:20px;">
    Subject: <strong><?= esc($subject) ?></strong> &nbsp;|&nbsp;
    Class: <strong><?= esc($classId) ?></strong>
</p>

<div class="card">

<form method="post" action="<?= site_url('teacher/grades/save') ?>">

    <input type="hidden" name="class_id" value="<?= $classId ?>">
    <input type="hidden" name="subject" value="<?= $subject ?>">
    <input type="hidden" name="teacher_id" value="<?= $teacherId ?>">

    <div class="table-wrapper">
        <table class="modern-table">
            <thead>
                <tr>
                    <th>Student</th>
                    <th>Midterm (40)</th>
                    <th>Final (60)</th>
                    <th>Total</th>
                    <th>Teacher Comment</th>
                </tr>
            </thead>

            <tbody>
            <?php foreach ($students as $s): ?>
                <?php
                $existing = $grades[$s['id']] ?? [
                    'midterm' => '',
                    'final'   => '',
                    'total'   => '',
                    'comment' => ''
                ];
                ?>

                <tr>
                    <td class="student-name">
                        <?= esc($s['name']) ?>
                    </td>

                    <!-- MIDTERM -->
                    <td>
                        <input type="number"
                               name="midterm[<?= $s['id'] ?>]"
                               value="<?= esc($existing['midterm']) ?>"
                               min="0"
                               max="40"
                               class="grade-input midterm"
                               data-id="<?= $s['id'] ?>"
                               data-max="40">
                        <small class="warning-text" id="mid_warn_<?= $s['id'] ?>"></small>
                    </td>

                    <!-- FINAL -->
                    <td>
                        <input type="number"
                               name="final[<?= $s['id'] ?>]"
                               value="<?= esc($existing['final']) ?>"
                               min="0"
                               max="60"
                               class="grade-input final"
                               data-id="<?= $s['id'] ?>"
                               data-max="60">
                    </td>

                    <!-- TOTAL -->
                    <td>
                        <input type="text"
                               id="total_<?= $s['id'] ?>"
                               readonly
                               class="total-input"
                               value="<?= esc($existing['total']) ?>">
                    </td>

                    <!-- COMMENT -->
                    <td>
                        <input type="text"
                               name="comment[<?= $s['id'] ?>]"
                               value="<?= esc($existing['comment']) ?>"
                               class="comment-input"
                               placeholder="Optional">
                    </td>
                </tr>

            <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <!-- TERM -->
    <div style="margin-top:25px; display:flex; gap:14px; align-items:center;">
        <label style="font-weight:600;">Term:</label>

        <select name="term" class="term-select">
            <option value="Term 1">Term 1</option>
            <option value="Term 2">Term 2</option>
            <option value="Final">Final</option>
        </select>
    </div>

    <!-- ACTIONS -->
    <div style="margin-top:30px;">
        <button type="submit" class="btn">
            Save Grades
        </button>

        <a href="<?= site_url('teacher/dashboard') ?>"
           class="btn"
           style="background:#64748b; margin-left:10px;">
            Back
        </a>
    </div>

</form>

</div>

<style>
.warning-text {
    display: block;
    color: #dc2626;
    font-size: 12px;
    margin-top: 4px;
}
</style>

<script>
function clampGrade(input) {
    const max = parseInt(input.dataset.max);
    let value = parseInt(input.value) || 0;

    if (value > max) {
        input.value = max;

        if (input.classList.contains('midterm')) {
            document.getElementById('mid_warn_' + input.dataset.id).innerText =
                `Max allowed is ${max}`;
        }
    } else {
        if (input.classList.contains('midterm')) {
            document.getElementById('mid_warn_' + input.dataset.id).innerText = '';
        }
    }
}

function updateTotal(id) {
    const mid = parseInt(document.querySelector(`input[name="midterm[${id}]"]`).value) || 0;
    const fin = parseInt(document.querySelector(`input[name="final[${id}]"]`).value) || 0;
    document.getElementById('total_' + id).value = mid + fin;
}

document.querySelectorAll('.midterm, .final').forEach(input => {
    input.addEventListener('input', function () {
        clampGrade(this);
        updateTotal(this.dataset.id);
    });
});
</script>

<?= $this->endSection() ?>