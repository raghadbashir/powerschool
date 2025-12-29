<?= $this->extend('auth/layout') ?>
<?= $this->section('content') ?>

<div class="auth-wrapper">
    <div class="auth-card">

        <!-- LEFT GRADIENT PANEL -->
        <div class="left-panel"></div>

        <!-- RIGHT CONTENT PANEL -->
        <div class="right-panel">

            <div class="auth-header">
                <span class="role-badge">Parent</span>
                <h1>Parent Login</h1>
                <p>Track your children’s progress</p>
            </div>

            <?php if (session()->getFlashdata('error')): ?>
                <div style="color:#b91c1c; font-weight:600; text-align:center; margin-bottom:14px;">
                    <?= session()->getFlashdata('error') ?>
                </div>
            <?php endif; ?>

            <form class="auth-form" method="post" action="<?= site_url('parent/login') ?>">
                <div class="form-group">
                    <label>Username</label>
                    <input type="text" name="username" required>
                </div>

                <div class="form-group">
                    <label>Password</label>
                    <input type="password" name="password" required>
                </div>

                <button class="auth-btn" type="submit">Login</button>
            </form>

            <div class="auth-footer">
                Back to
                <a href="<?= site_url('choose-role') ?>">Role Selection</a>
            </div>

        </div>
    </div>
</div>

<?= $this->endSection() ?>