<?= $this->extend('parent/parent_layout') ?>
<?= $this->section('content') ?>

<style>
.filter-bar {
    display: flex;
    gap: 14px;
    margin: 20px 0;
    align-items: center;
}

.filter-bar select {
    padding: 8px 12px;
    border-radius: 8px;
    border: 1px solid #cbd5f5;
    font-weight: 600;
}

.hidden-row {
    display: none;
}
</style>

<h1>Attendance Record</h1>

<p>
    Student: <strong><?= esc($student['name']) ?></strong>
</p>

<!-- ===== FILTER BAR ===== -->
<div class="filter-bar">
    <label><strong>Filter by:</strong></label>

    <select id="monthFilter">
        <option value="all">All Months</option>
        <option value="01">January</option>
        <option value="02">February</option>
        <option value="03">March</option>
        <option value="04">April</option>
        <option value="05">May</option>
        <option value="06">June</option>
        <option value="07">July</option>
        <option value="08">August</option>
        <option value="09">September</option>
        <option value="10">October</option>
        <option value="11">November</option>
        <option value="12">December</option>
    </select>

    <select id="yearFilter">
        <option value="all">All Years</option>
        <?php
        $years = [];
        foreach ($attendance as $row) {
            $y = date('Y', strtotime($row['date']));
            $years[$y] = true;
        }
        foreach (array_keys($years) as $y):
        ?>
            <option value="<?= $y ?>"><?= $y ?></option>
        <?php endforeach; ?>
    </select>
</div>

<hr>

<?php if (empty($attendance)): ?>
    <p>No attendance records found.</p>
<?php else: ?>

<div class="table-card">
    <table class="modern-table" id="attendanceTable">
        <thead>
            <tr>
                <th>Date</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
        <?php foreach ($attendance as $row): ?>
            <?php
                $month = date('m', strtotime($row['date']));
                $year  = date('Y', strtotime($row['date']));
            ?>
            <tr data-month="<?= $month ?>" data-year="<?= $year ?>">
                <td><?= esc($row['date']) ?></td>
                <td>
                    <?php if ($row['status'] === 'present'): ?>
                        <span class="badge-present">Present</span>
                    <?php else: ?>
                        <span class="badge-absent">Absent</span>
                    <?php endif; ?>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
</div>

<?php endif; ?>

<a class="back-link" href="<?= site_url('parent/dashboard') ?>">
    ← Back to Dashboard
</a>

<script>
const monthFilter = document.getElementById('monthFilter');
const yearFilter  = document.getElementById('yearFilter');
const rows        = document.querySelectorAll('#attendanceTable tbody tr');

function applyFilters() {
    const month = monthFilter.value;
    const year  = yearFilter.value;

    rows.forEach(row => {
        const rowMonth = row.dataset.month;
        const rowYear  = row.dataset.year;

        const matchMonth = (month === 'all' || month === rowMonth);
        const matchYear  = (year === 'all'  || year === rowYear);

        row.classList.toggle('hidden-row', !(matchMonth && matchYear));
    });
}

monthFilter.addEventListener('change', applyFilters);
yearFilter.addEventListener('change', applyFilters);
</script>

<?= $this->endSection() ?>