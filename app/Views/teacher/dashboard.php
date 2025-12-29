<?= $this->extend('teacher/layout') ?>
<?= $this->section('content') ?>

<h1>Teacher Dashboard</h1>
<h3>Welcome, <?= esc($teacher['name']) ?></h3>

<hr>

<h2>Your Classes & Subjects</h2>

<?php if (empty($assignments)): ?>
    <p>You have no assigned classes yet.</p>
<?php else: ?>

<div style="display:grid; grid-template-columns: repeat(auto-fit,minmax(260px,1fr)); gap:20px;">

<?php foreach ($assignments as $a): ?>

<?php
$isActive =
    session('teacher_current_class_id') == $a['class_id']
    && session('teacher_current_subject') == $a['subject_name'];
?>

<a href="<?= site_url('teacher/set-current?class_id=' . $a['class_id'] . '&subject=' . urlencode($a['subject_name'])) ?>"
   style="text-decoration:none; color:inherit;">

    <div class="card"
         style="
            cursor:pointer;
            border: <?= $isActive ? '2px solid #2563eb' : '2px solid transparent' ?>;
            background: <?= $isActive ? '#f0f6ff' : 'white' ?>;
         ">

        <h3 style="margin-top:0;">
Grade <?= esc($a['grade']) ?> - <?= esc($a['section']) ?>        </h3>

        <p style="margin:8px 0;">
            <strong>Subject:</strong> <?= esc($a['subject_name']) ?>
        </p>

        <?php if ($isActive): ?>
            <span style="
                display:inline-block;
                margin-top:10px;
                padding:4px 10px;
                background:#2563eb;
                color:white;
                border-radius:12px;
                font-size:13px;
                font-weight:600;
            ">
                Selected
            </span>
        <?php else: ?>
            <p style="margin-top:10px; color:#64748b;">
                Click to activate this class
            </p>
        <?php endif; ?>

    </div>

</a>

<?php endforeach; ?>

</div>

<?php endif; ?>

<hr>

<h2>Your Timetable</h2>

<?php if (empty($timetable)): ?>
    <p>No timetable assigned yet.</p>
<?php else: ?>

<table>
    <tr>
        <th>Day</th>
        <th>Period</th>
        <th>Time</th>
        <th>Class</th>
        <th>Subject</th>
    </tr>

    <?php foreach ($timetable as $t): ?>
        <?php
        $period = array_values(array_filter(
            $periods,
            fn($p) => $p['id'] == $t['period_id']
        ))[0];

        $classRow = db_connect()
            ->table('classes')
            ->where('id', $t['class_id'])
            ->get()
            ->getRowArray();
        ?>

        <tr>
            <td><?= esc($t['day']) ?></td>
            <td>Period <?= esc($period['period_number']) ?></td>
            <td><?= esc($period['start_time']) ?> - <?= esc($period['end_time']) ?></td>
            <td><?= esc($classRow['grade'] . ' - ' . $classRow['section']) ?></td>
            <td><?= esc($t['subject']) ?></td>
        </tr>
    <?php endforeach; ?>
</table>

<?php endif; ?>

<?= $this->endSection() ?>