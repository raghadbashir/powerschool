<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Power School</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- CSS -->
    <link rel="stylesheet" href="<?= base_url('assets/css/landing.css') ?>">

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
</head>
<body>

<!-- ================= NAVBAR ================= -->
<header class="navbar">
    <div class="logo">
        <img src="<?= base_url('assets/images/logo.png') ?>" alt="School Logo">
        <h2>Power School</h2>
    </div>

    <nav>
        <ul class="nav-links">
            <li><a href="#about">About</a></li>
            <li><a href="#features">Features</a></li>
            <li><a href="#access">Access</a></li>
        </ul>
    </nav>

</header>

<!-- ================= HERO ================= -->
<section class="hero">
    <h1>The Best School For Your Children</h1>
    <p>Inspire. Learn. Grow — where education meets innovation.</p>

    <div class="hero-buttons">
        <a href="#access" class="btn primary">Get Started</a>
    </div>
</section>

 <!-- 📚 About Section -->
  <section class="about" id="about">
    <div class="about-container">
      <div class="about-image">
        <img src="assets/images/about_main.jpg" alt="Teacher with Students" class="main-img" />
      </div>

      <div class="about-content">
        <h3>About Us</h3>
        <h2>Top Choice For Children</h2>
        <p>
          Our school provides a nurturing and inspiring learning environment that encourages creativity, curiosity,
          and confidence in every student. We combine expert teaching with engaging activities to make learning enjoyable and effective.
        </p>

        <div class="about-features">
          <div class="feature"><span></span> Smart Training</div>
          <div class="feature"><span></span> Expert Teachers</div>
          <div class="feature"><span></span> Easy To Learn</div>
          <div class="feature"><span></span> Clean & Caring</div>
        </div>

        <div class="about-buttons">
          <a href="#features" class="btn learn-more">Learn More</a>
          <div class="contact-info">
            <span>📞 Call us now:</span>
            <p>+218-91-234-5678</p>
          </div>
        </div>
      </div>
    </div>
  </section>
</body>



<!-- 🧩 Programs Section -->
<section class="programs" id="features">
  <h2>Our Programs & Activities</h2>
  <p class="section-subtitle">A quick look at what our school offers</p>

  <div class="programs-scroll">
    <div class="program-card">
      <img src="assets/icons/books.png" alt="Academics" />
      <h3>Academic Excellence</h3>
      <p>High-quality education in all major subjects.</p>
    </div>

    <div class="program-card">
      <img src="assets/icons/paint.png" alt="Arts" />
      <h3>Arts & Creativity</h3>
      <p>Encouraging imagination through art and crafts.</p>
    </div>

    <div class="program-card">
      <img src="assets/icons/sports.png" alt="Sports" />
      <h3>Sports & Health</h3>
      <p>Developing teamwork and physical well-being.</p>
    </div>

    <div class="program-card">
      <img src="assets/icons/science.png" alt="Science" />
      <h3>STEM Learning</h3>
      <p>Hands-on experiments in science and technology.</p>
    </div>

    <div class="program-card">
      <img src="assets/icons/computer.png" alt="Technology" />
      <h3>Computer Skills</h3>
      <p>Building digital literacy through coding and design.</p>
    </div>

    <div class="program-card">
      <img src="assets/icons/earth.png" alt="Environment" />
      <h3>Environmental Awareness</h3>
      <p>Teaching sustainability and love for nature.</p>
    </div>

    <div class="program-card">
      <img src="assets/icons/language.png" alt="Language" />
      <h3>Language & Communication</h3>
      <p>Improving writing, speaking, and comprehension skills.</p>
    </div>

    <div class="program-card">
      <img src="assets/icons/character.png" alt="Character" />
      <h3>Character Development</h3>
      <p>Promoting kindness, respect, and responsibility.</p>
    </div>
  </div>

  <a href="#" class="view-all">View All Programs →</a>

</section>



<section class="checklist-section">
  <h2>How to Access the Platform</h2>
  <p class="subtitle">Follow these easy steps to get started</p>

  <div class="steps-container">
    
    <!-- Step 1 -->
    <div class="step step-right">
      <div class="step-number">1</div>
      <div class="step-content">
        <div class="step-icon"></div>
        <h3>Receive Login Details</h3>
        <p>Parents and students receive their unique login credentials via email from the school.</p>
      </div>
    </div>

    <!-- Step 2 -->
    <div class="step step-left">
      <div class="step-number">2</div>
      <div class="step-content">
        <div class="step-icon"></div>
        <h3>Access the Portal</h3>
        <p>Go to the school website and log in with your provided username and password.</p>
      </div>
    </div>

    <!-- Step 3 -->
    <div class="step step-right">
      <div class="step-number">3</div>
      <div class="step-content">
        <div class="step-icon"></div>
        <h3>Explore Dashboard</h3>
        <p>View your schedule, classes, assignments, and grades all in one dashboard.</p>
      </div>
    </div>

    <!-- Step 4 -->
    <div class="step step-left">
      <div class="step-number">4</div>
      <div class="step-content">
        <div class="step-icon"></div>
        <h3>Connect with Teachers</h3>
        <p>Message your teachers and receive feedback or updates about your courses.</p>
      </div>
    </div>

    <!-- Step 5 -->
    <div class="step step-right">
      <div class="step-number">5</div>
      <div class="step-content">
        <div class="step-icon"></div>
        <h3>Stay Updated</h3>
        <p>Keep track of upcoming exams, school events, and new announcements.</p>
      </div>
    </div>

  </div>
</section>




<script>
  document.addEventListener("DOMContentLoaded", () => {
    const steps = document.querySelectorAll(".step");

    // Assign left/right classes alternately
    steps.forEach((step, index) => {
      if (index % 2 === 0) {
        step.classList.add("step-left");
      } else {
        step.classList.add("step-right");
      }
    });

    const revealOnScroll = () => {
      const triggerBottom = window.innerHeight * 0.85;

      steps.forEach((step) => {
        const stepTop = step.getBoundingClientRect().top;

        if (stepTop < triggerBottom) {
          step.classList.add("show");
        }
      });
    };

    window.addEventListener("scroll", revealOnScroll);
    revealOnScroll(); // Run once on load
  });
</script>


</html>




<!-- ================= ROLE CHOOSE ================= -->
<section id="access" class="roles">
    <h2>Access the Platform</h2>
    <p>Select how you want to continue</p>

    <div class="role-grid">

        <!-- SIGN UP -->
        <div class="role-card">
            <h3>New User?</h3>
            <p>Create an account as a student or teacher</p>
            <a href="<?= site_url('signup') ?>" class="btn primary">Sign Up</a>
        </div>

        <!-- STUDENT -->
        <div class="role-card">
            <h3>Student</h3>
            <p>Access classes, homework, grades</p>
            <a href="<?= site_url('student/login') ?>" class="btn dark">Student Login</a>
        </div>

        <!-- PARENT -->
        <div class="role-card">
            <h3>Parent</h3>
            <p>Track children progress & messages</p>
            <a href="<?= site_url('parent/login') ?>" class="btn dark">Parent Login</a>
        </div>

        <!-- TEACHER -->
        <div class="role-card">
            <h3>Teacher</h3>
            <p>Manage classes & grades</p>
            <a href="<?= site_url('teacher/login') ?>" class="btn dark">Teacher Login</a>
        </div>

    </div>
</section>


<!-- ================= FOOTER ================= -->
<footer class="footer">
    <p>© <?= date('Y') ?> Power School — All Rights Reserved</p>
</footer>

</body>
</html>