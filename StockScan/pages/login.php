<?php
include "../config/database.php";
session_start();

$email_error = false;
$password_error = false;
$signup_error = "";

if($_SERVER["REQUEST_METHOD"]=="POST"){

    if(isset($_POST['login'])){
        $email = $_POST["email"];
        $password = $_POST["password"];

        $stmt = $conn->prepare("SELECT * FROM users WHERE email=?");
        $stmt->execute([$email]);
        $user = $stmt->fetch();

        if(!$user){
            $email_error = true;
        } else if($user['password'] != $password){
            $password_error = true;
        } else {
            $_SESSION["user_id"] = $user["id"];
            header("Location: dashboard.php");
            exit();
        }
    }

    if(isset($_POST['signup'])){
        $email = $_POST["signup_email"];
        $password = $_POST["signup_password"];
        $confirm = $_POST["signup_confirm"];

        if($password !== $confirm){
            $signup_error = "Les mots de passe ne correspondent pas";
        } else {

            $stmt = $conn->prepare("SELECT * FROM users WHERE email=?");
            $stmt->execute([$email]);

            if($stmt->fetch()){
                $signup_error = "Email déjà utilisé";
            } else {

                $stmt = $conn->prepare("INSERT INTO users (email,password) VALUES (?,?)");
                $stmt->execute([$email,$password]);

                $_SESSION["user_id"] = $conn->lastInsertId();
                header("Location: dashboard.php");
                exit();
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>StockScan</title>

  <link href="https://fonts.googleapis.com/css2?family=DM+Serif+Display:ital@0;1&family=DM+Sans:wght@300;400;500;600&display=swap" rel="stylesheet"/>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

  <style>
    *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

    :root {
      --ink: #0f1117;
      --ink-2: #3a3f52;
      --ink-3: #8890a8;
      --bg: #f5f4f0;
      --bg-card: #ffffff;
      --accent: #2563eb;
      --accent-light: #dbeafe;
      --border: #e2e0d8;
      --shadow-md: 0 4px 20px rgba(0,0,0,0.08), 0 1px 4px rgba(0,0,0,0.05);
      --radius: 12px;
      --radius-sm: 8px;
    }

    html, body {
      height: 100%;
      font-family: 'DM Sans', sans-serif;
      color: var(--ink);
    }

    body {
      display: flex;
      flex-direction: column;
      min-height: 100vh;
      background:
        linear-gradient(rgba(15,23,42,0.6), rgba(30,58,95,0.6)),
        url("BACKGROUNDCMC.png");
      background-size: cover;
      background-position: center;
    }

    /* ── LOGIN PAGE ── */
    #login-page {
      flex: 1;
      display: flex;
      align-items: center;
      justify-content: center;
      position: relative;
      overflow: hidden;
      padding: 40px 20px 80px;
    }

    #login-page::before {
      content: '';
      position: absolute;
      top: -200px; right: -200px;
      width: 600px; height: 600px;
      border-radius: 50%;
      background: radial-gradient(circle, rgba(37,99,235,0.12) 0%, transparent 70%);
      pointer-events: none;
    }

    .login-container {
      width: 100%;
      max-width: 440px;
      z-index: 1;
      animation: fadeUp 0.6s ease both;
    }

    @keyframes fadeUp {
      from { opacity: 0; transform: translateY(24px); }
      to   { opacity: 1; transform: translateY(0); }
    }

    /* Brand */
    .login-brand {
      text-align: center;
      margin-bottom: 28px;
    }

    .login-brand .logo-mark {
      display: inline-flex;
      align-items: center;
      justify-content: center;
      width: 52px; height: 52px;
      background: white;
      border-radius: 14px;
      margin-bottom: 14px;
    }

    .login-brand .logo-mark svg {
      width: 28px; height: 28px;
      fill: var(--ink);
    }

    .login-brand h1 {
      font-family: 'DM Serif Display', serif;
      font-size: 2rem;
      color: white;
      letter-spacing: -0.02em;
    }

    .login-brand p {
      color: rgba(255,255,255,0.65);
      font-size: 0.875rem;
      margin-top: 6px;
    }

    /* Card */
    .card {
      background: var(--bg-card);
      border: 1px solid var(--border);
      border-radius: var(--radius);
      box-shadow: var(--shadow-md);
      padding: 36px;
    }

    /* Tabs */
    .auth-tabs {
      display: flex;
      border-bottom: 1px solid var(--border);
      margin-bottom: 24px;
    }

    .auth-tab-btn {
      flex: 1;
      padding: 10px;
      background: none;
      border: none;
      border-bottom: 2px solid transparent;
      font-family: 'DM Sans', sans-serif;
      font-size: 0.9rem;
      font-weight: 500;
      color: var(--ink-3);
      cursor: pointer;
      transition: all 0.2s;
      margin-bottom: -1px;
    }

    .auth-tab-btn.active {
      color: var(--accent);
      border-bottom-color: var(--accent);
    }

    /* Forms */
    .tab-panel { display: none; }
    .tab-panel.active { display: block; }

    .form-group {
      margin-bottom: 16px;
    }

    .form-group label {
      display: block;
      font-size: 0.8rem;
      font-weight: 600;
      letter-spacing: 0.04em;
      text-transform: uppercase;
      color: var(--ink-2);
      margin-bottom: 7px;
    }

    .form-group input {
      width: 100%;
      padding: 11px 14px;
      border: 1.5px solid var(--border);
      border-radius: var(--radius-sm);
      font-family: 'DM Sans', sans-serif;
      font-size: 0.9rem;
      color: var(--ink);
      background: var(--bg);
      transition: border-color 0.2s, box-shadow 0.2s;
      outline: none;
    }

    .form-group input:focus {
      border-color: var(--accent);
      box-shadow: 0 0 0 3px rgba(37,99,235,0.12);
      background: white;
    }

    .form-group input::placeholder { color: var(--ink-3); }

    .pw-toggle-wrap { position: relative; }
    .pw-toggle-wrap input { padding-right: 44px; }
    .pw-toggle {
      position: absolute;
      right: 12px; top: 50%;
      transform: translateY(-50%);
      background: none; border: none;
      cursor: pointer;
      color: var(--ink-3);
      display: flex; align-items: center;
      padding: 4px;
      transition: color 0.2s;
    }
    .pw-toggle:hover { color: var(--ink); }

    /* Buttons */
    .btn-submit {
      width: 100%;
      padding: 11px 20px;
      border-radius: var(--radius-sm);
      font-family: 'DM Sans', sans-serif;
      font-size: 0.9rem;
      font-weight: 600;
      cursor: pointer;
      border: none;
      background: var(--ink);
      color: white;
      display: flex;
      align-items: center;
      justify-content: center;
      gap: 8px;
      transition: background 0.18s;
      margin-top: 8px;
    }

    .btn-submit:hover { background: var(--ink-2); }

    /* Alerts */
    .alert-edu {
      padding: 10px 14px;
      border-radius: var(--radius-sm);
      font-size: 0.85rem;
      margin-bottom: 16px;
      background: #fee2e2;
      color: #dc2626;
      border: 1px solid #fca5a5;
    }

    /* Footer */
    .footer {
      position: fixed;
      bottom: 0;
      width: 100%;
      text-align: center;
      padding: 14px;
      background: rgba(10,31,47,0.95);
      color: rgba(255,255,255,0.55);
      font-size: 0.8rem;
    }
  </style>
</head>

<body>

<div id="login-page">
  <div class="login-container">

    <div class="login-brand">
      <div class="logo-mark">
        <svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
          <path d="M12 3L1 9l11 6 9-4.91V17h2V9L12 3zm0 12.39L5.25 11.5 3 12.72 12 18l9-5.28-2.25-1.22L12 15.39z"/>
        </svg>
      </div>
      <h1>StockScan</h1>
      <p>Votre plateforme de gestion intelligente</p>
    </div>

    <div class="card">

      <!-- TABS -->
      <div class="auth-tabs">
        <button class="auth-tab-btn active" onclick="switchTab('login', this)">Connexion</button>
        <button class="auth-tab-btn" onclick="switchTab('signup', this)">Créer un compte</button>
      </div>

      <!-- LOGIN PANEL -->
      <div id="tab-login" class="tab-panel active">

        <?php if($email_error){ ?>
          <div class="alert-edu">❌ Adresse e-mail introuvable</div>
        <?php } ?>
        <?php if($password_error){ ?>
          <div class="alert-edu">❌ Mot de passe incorrect</div>
        <?php } ?>

        <form method="POST">
          <div class="form-group">
            <label>Adresse e-mail</label>
            <input type="email" name="email" placeholder="votre@email.com" required autocomplete="email"/>
          </div>
          <div class="form-group">
            <label>Mot de passe</label>
            <div class="pw-toggle-wrap">
              <input type="password" id="pw-login" name="password" placeholder="••••••••" required autocomplete="current-password"/>
              <button type="button" class="pw-toggle" onclick="togglePw('pw-login', this)" title="Afficher/Masquer">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                  <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/>
                </svg>
              </button>
            </div>
          </div>
          <button type="submit" name="login" class="btn-submit">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
              <path d="M15 3h4a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2h-4"/>
              <polyline points="10 17 15 12 10 7"/>
              <line x1="15" y1="12" x2="3" y2="12"/>
            </svg>
            Se connecter
          </button>
        </form>

      </div>

      <!-- SIGNUP PANEL -->
      <div id="tab-signup" class="tab-panel">

        <?php if($signup_error){ ?>
          <div class="alert-edu">❌ <?= htmlspecialchars($signup_error) ?></div>
        <?php } ?>

        <form method="POST">
          <div class="form-group">
            <label>Adresse e-mail</label>
            <input type="email" name="signup_email" placeholder="votre@email.com" required/>
          </div>
          <div class="form-group">
            <label>Mot de passe</label>
            <div class="pw-toggle-wrap">
              <input type="password" id="pw-signup" name="signup_password" placeholder="Minimum 6 caractères" required/>
              <button type="button" class="pw-toggle" onclick="togglePw('pw-signup', this)" title="Afficher/Masquer">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                  <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/>
                </svg>
              </button>
            </div>
          </div>
          <div class="form-group">
            <label>Confirmer le mot de passe</label>
            <div class="pw-toggle-wrap">
              <input type="password" id="pw-confirm" name="signup_confirm" placeholder="Répétez le mot de passe" required/>
              <button type="button" class="pw-toggle" onclick="togglePw('pw-confirm', this)" title="Afficher/Masquer">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                  <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/>
                </svg>
              </button>
            </div>
          </div>
          <button type="submit" name="signup" class="btn-submit">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
              <path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"/>
              <circle cx="9" cy="7" r="4"/>
              <line x1="19" y1="8" x2="19" y2="14"/>
              <line x1="22" y1="11" x2="16" y2="11"/>
            </svg>
            Créer le compte
          </button>
        </form>

      </div>

    </div>
  </div>
</div>

<div class="footer">
  © 2026 ResolveTech – Turning Problems into Solutions.
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

<script>
  // Switch tabs
  function switchTab(tab, btn) {
    document.querySelectorAll('.tab-panel').forEach(p => p.classList.remove('active'));
    document.querySelectorAll('.auth-tab-btn').forEach(b => b.classList.remove('active'));
    document.getElementById('tab-' + tab).classList.add('active');
    btn.classList.add('active');
  }

  // Toggle password visibility
  function togglePw(inputId, btn) {
    const input = document.getElementById(inputId);
    const show  = input.type === 'password';
    input.type  = show ? 'text' : 'password';
    btn.innerHTML = show
      ? `<svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
           <path d="M17.94 17.94A10.07 10.07 0 0 1 12 20c-7 0-11-8-11-8a18.45 18.45 0 0 1 5.06-5.94"/>
           <path d="M9.9 4.24A9.12 9.12 0 0 1 12 4c7 0 11 8 11 8a18.5 18.5 0 0 1-2.16 3.19"/>
           <line x1="1" y1="1" x2="23" y2="23"/>
         </svg>`
      : `<svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
           <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/>
         </svg>`;
  }

  // Auto-open signup tab if there's a signup error from PHP
  <?php if($signup_error): ?>
  document.addEventListener('DOMContentLoaded', function() {
    switchTab('signup', document.querySelectorAll('.auth-tab-btn')[1]);
  });
  <?php endif; ?>
  
</script>

</body>
</html>