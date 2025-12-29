<?= $this->extend('auth/layout') ?>
<?= $this->section('content') ?>

<div class="auth-wrapper">
    <div class="auth-card">

        <!-- LEFT GRADIENT PANEL -->
        <div class="left-panel"></div>

        <!-- RIGHT CONTENT PANEL -->
        <div class="right-panel">

            <div class="auth-header">
                <span class="role-badge">Teacher</span>
                <h1>Teacher Login</h1>
                <p>Access your classes and tools</p>
            </div>

            <?php if (session()->getFlashdata('error')): ?>
                <div style="color:#b91c1c; font-weight:600; text-align:center; margin-bottom:14px;">
                    <?= session()->getFlashdata('error') ?>
                </div>
            <?php endif; ?>

            <form class="auth-form" method="post" action="<?= site_url('teacher/login') ?>">
                <div class="form-group">
                    <label>Email</label>
                    <input type="email" name="email" required>
                </div>

                <div class="form-group">
                    <label>Password</label>
                    <input type="password" name="password" required>
                </div>

                <button class="auth-btn" type="submit">Login</button>
            </form>

            <!-- MATCH STUDENT LOGIN FOOTER -->
            <div class="auth-footer">
                Don’t have an account?
                <a href="<?= site_url('signup') ?>">Sign Up</a>
            </div>

        </div>
    </div>
</div>

<?= $this->endSection() ?>