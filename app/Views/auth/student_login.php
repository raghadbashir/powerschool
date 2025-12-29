<?= $this->extend('auth/layout') ?>
<?= $this->section('content') ?>

<<div class="auth-wrapper">
  <div class="auth-card">

    <!-- LEFT -->
    <div class="left-panel"></div>

    <!-- RIGHT -->
    <div class="right-panel">

      <div class="auth-header">
        <span class="role-badge">Student</span>
        <h1>Student Login</h1>
        <p>Access your classes and grades</p>
      </div>

      <form class="auth-form" method="post" action="<?= site_url('student/login') ?>">
        <div class="form-group">
          <label>Student Number</label>
          <input type="number" name="student_number" required>
        </div>

        <div class="form-group">
          <label>Password</label>
          <input type="password" name="password" required>
        </div>

        <button class="auth-btn">Login</button>
      </form>

      <div class="auth-footer">
        Don’t have an account?
        <a href="<?= site_url('signup') ?>">Sign Up</a>
      </div>

    </div>
  </div>
</div>
<?= $this->endSection() ?>