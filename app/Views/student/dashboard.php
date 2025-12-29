<?= $this->extend('student/layout') ?>
<?= $this->section('content') ?>

<h1>Welcome, <?= esc($student['name']) ?> 👋</h1>

<div class="dashboard-top">
    <div class="card student-info-card">
        <h2>Student Information</h2>

        <div class="info-list">
            <div class="info-item">
                <span>Student Number</span>
                <strong><?= esc($student['student_number']) ?></strong>
            </div>

            <div class="info-item">
                <span>Class</span>
                <strong><?= esc($student['grade']) ?> - <?= esc($student['section']) ?></strong>
            </div>

            <div class="info-item">
                <span>Gender</span>
                <strong><?= ucfirst(esc($student['gender'] ?? 'Not specified')) ?></strong>
            </div>

            <div class="info-item">
                <span>Date of Birth</span>
                <strong><?= esc($student['date_of_birth']) ?></strong>
            </div>
        </div>
    </div>

    <div class="card notifications-card">
        <h2>Notifications</h2>

        <?php if (empty($notifications)): ?>
            <p>No new notifications.</p>
        <?php else: ?>
            <?php foreach ($notifications as $n): ?>
                <div class="notification-item">
                    <strong><?= esc($n['message']) ?></strong><br>
                    <small><?= date('d M Y H:i', strtotime($n['created_at'])) ?></small>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>
</div>

<div class="card">
    <div class="timetable-card">
        <h2>Weekly Timetable</h2>

        <div class="timetable-wrapper">
            <table class="timetable">
                <thead>
                    <tr>
                        <th>Period</th>
                        <th>Mon</th>
                        <th>Tue</th>
                        <th>Wed</th>
                        <th>Thu</th>
                        <th>Fri</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($periods as $p): ?>
                        <tr>
                            <td class="period-cell">
                                <?= esc($p['start_time']) ?> – <?= esc($p['end_time']) ?>
                            </td>

                            <?php foreach (['Monday','Tuesday','Wednesday','Thursday','Friday'] as $day): ?>
                                <?php $cell = $timetableGrid[$p['id']][$day] ?? ''; ?>
                                <td class="<?= empty($cell) ? 'empty' : '' ?>">
                                    <?= $cell ?: '—' ?>
                                </td>
                            <?php endforeach; ?>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>

            <?php if (!empty($lastResult)): ?>
                <div class="info-note">
                    Last Year Result:
                    <b><?= esc($lastResult['status']) ?></b>
                    (Grade <?= esc($lastResult['grade']) ?> - <?= esc($lastResult['section']) ?>)
                </div>
            <?php endif; ?>

            <?php if (!empty($currentEnroll)): ?>
                <div class="info-note current">
                    Current Class:
                    <b>Grade <?= esc($currentEnroll['grade']) ?> - <?= esc($currentEnroll['section']) ?></b>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>

<?= $this->endSection() ?>