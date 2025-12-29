<?= $this->extend('parent/parent_layout') ?>
<?= $this->section('content') ?>

<h1>Parent Dashboard</h1>

<p>
    Welcome,
    <strong><?= esc($parent['parent_name'] ?? 'Parent') ?></strong>
</p>

<hr>

<h2>Your Children</h2>

<?php
$activeChildId = session('parent_active_child_id');
?>

<?php if (empty($children)): ?>
    <p>No children linked to your account.</p>
<?php else: ?>

<form method="post" action="<?= site_url('parent/select-child') ?>">
    <?= csrf_field() ?>

    <div class="children-grid">
        <?php foreach ($children as $child): ?>
            <?php $isActive = $activeChildId == $child['id']; ?>

            <label class="student-card <?= $isActive ? 'active' : '' ?>">
                <input
                    type="radio"
                    name="child_id"
                    value="<?= $child['id'] ?>"
                    <?= $isActive ? 'checked' : '' ?>
                    onchange="this.form.submit()"
                >

                <h3><?= esc($child['name']) ?></h3>
                <p>Class: <?= esc($child['grade']) ?> - <?= esc($child['section']) ?></p>

                <small>
                    Attendance Rate:
                    <strong><?= $child['attendance']['rate'] ?? '—' ?>%</strong>
                </small>
            </label>
        <?php endforeach; ?>
    </div>
</form>

<?php endif; ?>

<?= $this->endSection() ?>