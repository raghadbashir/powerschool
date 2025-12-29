<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?= $title ?? 'Authentication' ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <style>
 
* {
  box-sizing: border-box;
}

body {
  margin: 0;
  min-height: 100vh;
  font-family: "Segoe UI", Arial, sans-serif;
  background: linear-gradient(135deg, #e9efff, #f5f7fb);
  display: flex;
  justify-content: center;
  align-items: center;
}

/* ===== WRAPPER ===== */
.auth-wrapper {
  width: 100%;
  max-width: 980px;
  padding: 20px;
}

/* ===== CARD ===== */
.auth-card {
  position: relative;
  display: grid;
  grid-template-columns: 42% 58%;
  min-height: 540px;
  background: white;
  border-radius: 28px;
  overflow: hidden;
  box-shadow: 0 35px 80px rgba(0,0,0,0.15);
}

/* ===== LEFT PANEL ===== */
.left-panel {
  background: linear-gradient(
    135deg,
    #3b82f6 0%,
    #6366f1 45%,
    #a78bfa 100%
  );
}

/* ===== RIGHT PANEL ===== */
.right-panel {
  padding: 64px 56px;
  display: flex;
  flex-direction: column;
  justify-content: center;   /* vertical centering */
  align-items: center;       /* horizontal centering */
  text-align: center;        /* text centered */
}

/* ===== HEADER ===== */
.auth-header {
  margin-bottom: 32px;
}

.role-badge {
  display: inline-block;
  background: #4f46e5;
  color: white;
  padding: 6px 18px;
  border-radius: 999px;
  font-size: 13px;
  font-weight: 600;
  margin-bottom: 14px;
}

.auth-header h1 {
  margin: 0;
  font-size: 30px;
  color: #111827;
}

.auth-header p {
  margin-top: 6px;
  color: #6b7280;
  font-size: 15px;
}

/* ===== FORM ===== */
.auth-form {
  max-width: 360px;
  display: flex;
  flex-direction: column;
  gap: 18px;
}

.form-group label {
  font-size: 14px;
  margin-bottom: 6px;
  font-weight: 600;
  color: #111827;
}

.form-group input {
  padding: 13px 15px;
  border-radius: 14px;
  border: 1px solid #d1d5db;
  font-size: 14px;
}

.form-group input:focus {
  outline: none;
  border-color: #4f46e5;
  box-shadow: 0 0 0 4px rgba(79,70,229,0.15);
}

/* ===== BUTTON ===== */
.auth-btn {
  margin-top: 14px;
  padding: 15px;
  border-radius: 16px;
  border: none;
  background: #4f46e5;
  color: white;
  font-size: 15px;
  font-weight: 600;
  cursor: pointer;
  box-shadow: 0 14px 30px rgba(79,70,229,0.35);
}

.auth-btn:hover {
  background: #4338ca;
}

/* ===== FOOTER ===== */
.auth-footer {
  margin-top: 28px;
  font-size: 14px;
  color: #6b7280;
}

.auth-footer a {
  color: #4f46e5;
  font-weight: 600;
  text-decoration: none;
}

/* ===== RESPONSIVE ===== */
@media (max-width: 900px) {
  .auth-card {
    grid-template-columns: 1fr;
  }

  .left-panel {
    display: none;
  }

  .right-panel {
    padding: 48px 36px;
  }
}

    </style>
</head>

<body>

<?= $this->renderSection('content') ?>

</body>
</html>