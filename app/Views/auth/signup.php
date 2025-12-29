<?= $this->extend('auth/layout') ?>
<?= $this->section('content') ?>

<div class="auth-wrapper">
    <div class="auth-card">

        <!-- LEFT GRADIENT PANEL -->
        <div class="left-panel"></div>

        <!-- RIGHT CONTENT PANEL -->
        <div class="right-panel">

            <div class="auth-header">
                <span class="role-badge">Sign Up</span>
                <h1>Create Account</h1>
                <p>Register as a student, parent, or teacher</p>
            </div>

            <?php if (session()->getFlashdata('error')): ?>
                <div style="color:#b91c1c; font-weight:600; text-align:center; margin-bottom:14px;">
                    <?= session()->getFlashdata('error') ?>
                </div>
            <?php endif; ?>

            <form class="auth-form" method="post" action="<?= site_url('signup/submit') ?>">

                <div class="form-group">
                    <label>User Type</label>
                    <select name="role" required>
                        <option value="">Select role</option>
                        <option value="student">Student</option>
                        <option value="parent">Parent</option>
                        <option value="teacher">Teacher</option>
                    </select>
                </div>

                <div class="form-group">
                    <label>Identifier</label>
                    <input
                        type="text"
                        name="identifier"
                        placeholder="Student number or email"
                        required
                    >
                </div>

                <div class="form-group">
                    <label>Create Password</label>
                    <input type="password" name="password" required>
                </div>

                <button class="auth-btn" type="submit">Create Account</button>
            </form>

            <div class="auth-footer">
                Already have an account?
                <a href="<?= site_url('choose-role') ?>">Login</a>
            </div>

        </div>
    </div>
</div>

<?= $this->endSection() ?>