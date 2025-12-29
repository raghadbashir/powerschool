<?= $this->extend('auth/layout') ?>
<?= $this->section('content') ?>

<div class="auth-wrapper">
    <div class="auth-card">

        <div class="auth-header">
            <span class="role-badge">Admin</span>
            <h1>Login</h1>
            <p>Access the administration panel</p>
        </div>

        <?php if (session()->getFlashdata('error')): ?>
            <div style="color:#b91c1c; font-weight:600; text-align:center; margin-bottom:10px;">
                <?= session()->getFlashdata('error') ?>
            </div>
        <?php endif; ?>

        <form class="auth-form" method="post" action="<?= site_url('login') ?>">

            <div class="form-group">
                <label>Username</label>
                <input
                    type="text"
                    name="username"
                    placeholder="Enter your username"
                    required
                >
            </div>

            <div class="form-group">
                <label>Password</label>
                <input
                    type="password"
                    name="password"
                    placeholder="Enter your password"
                    required
                >
            </div>

            <button class="auth-btn" type="submit">Login</button>
        </form>

        <div class="auth-footer">
            Don’t have an account?
            <a href="<?= site_url('signup') ?>">Create one</a>
        </div>

    </div>
</div>

<?= $this->endSection() ?>