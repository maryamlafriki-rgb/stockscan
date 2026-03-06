<?php
include "database.php";
session_start();

$email_error = false;
$password_error = false;
$signup_error = "";

// Login
if($_SERVER["REQUEST_METHOD"]=="POST" && isset($_POST['login'])){
    $email = $_POST["email"];
    $password = $_POST["password"];

    $stmt = $conn->prepare("SELECT * FROM users WHERE email=?");
    $stmt->execute([$email]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if(!$user){
        $email_error = true;
    } else if(!password_verify($password, $user['password'])){
        $password_error = true;
    } else {
        $_SESSION["user_id"] = $user["id"];
        $_SESSION["user_name"] = $user["nom"];
        $_SESSION["user_role"] = $user["role"];
        header("Location: dashboard.php");
        exit();
    }
}

// Sign Up
if($_SERVER["REQUEST_METHOD"]=="POST" && isset($_POST['signup'])){
    $nom = $_POST["signup_nom"];
    $email = $_POST["signup_email"];
    $password = $_POST["signup_password"];
    $confirm = $_POST["signup_confirm"];

    if($password !== $confirm){
        $signup_error = "Les mots de passe ne correspondent pas";
    } else {
        // vérifier si email existe
        $stmt = $conn->prepare("SELECT * FROM users WHERE email=?");
        $stmt->execute([$email]);
        if($stmt->fetch()){
            $signup_error = "Email déjà utilisé";
        } else {
            $hash = password_hash($password, PASSWORD_DEFAULT);
            $stmt = $conn->prepare("INSERT INTO users (nom,email,password,role) VALUES (?,?,?,?)");
            $stmt->execute([$nom, $email, $hash, 'user']);
            $_SESSION["user_id"] = $conn->lastInsertId();
            $_SESSION["user_name"] = $nom;
            $_SESSION["user_role"] = 'user';
            header("Location: dashboard.php");
            exit();
        }
    }
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Login / Sign Up - StockScan</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
<style>
body { display:flex; flex-direction:column; min-height:100vh; font-family:Arial, Helvetica, sans-serif; color:white; margin:0;
background: linear-gradient(rgba(15,23,42,0.6), rgba(30,58,95,0.6)), url("BACKGROUNDCMC.png"); background-size:cover; background-position:center; }
.login-container { flex:1; display:flex; justify-content:center; align-items:center; padding:20px; }
.login-form { background: rgba(255,255,255,0.05); padding:30px; border-radius:15px; box-shadow:0 10px 25px rgba(0,0,0,0.3); width:100%; max-width:400px; text-align:center; }
.login-form h2 { margin-bottom:20px; color:#e0f7fa; }
.login-form input { width:100%; padding:10px 15px; margin-bottom:15px; border-radius:5px; border:2px solid transparent; transition:0.3s; }
.login-form input.error-border { border-color:#dc3545; }
.login-form button { width:100%; padding:10px; background:#0d6efd; border:none; color:white; font-weight:bold; border-radius:5px; transition:0.3s; }
.login-form button:hover { background:#084298; }
.alert-error { display:flex; align-items:center; justify-content:center; background:#dc3545; color:white; padding:10px 15px; border-radius:8px; margin-bottom:15px; animation: fadeIn 0.5s ease; }
.alert-error i { margin-right:8px; }
@keyframes fadeIn { from {opacity:0; transform: translateY(-10px);} to {opacity:1; transform: translateY(0);} }
.footer { position: fixed; bottom:0; left:0; width:100%; padding:15px 0; text-align:center; background:#0a1f2f; color: rgba(255,255,255,0.7); font-size:14px; border-top:1px solid rgba(255,255,255,0.2); border-radius:15px 15px 0 0; z-index:999; }
.toggle-link { color:#0d6efd; cursor:pointer; margin-top:10px; display:block; }
#signup-form { display:none; }
</style>
</head>
<body>

<div class="login-container">

<!-- LOGIN FORM -->
<form method="POST" class="login-form" id="login-form">
<h2>Login</h2>

<?php if($email_error) { ?>
    <div class="alert-error"><i class="fa fa-exclamation-triangle"></i> Email incorrect</div>
<?php } else if($password_error) { ?>
    <div class="alert-error"><i class="fa fa-exclamation-triangle"></i> Mot de passe incorrect</div>
<?php } ?>

<input type="email" name="email" placeholder="Email" required class="<?php if($email_error) echo 'error-border'; ?>">
<div style="position: relative;">
<input type="password" name="password" placeholder="Password" required id="password-field">
<i class="fa fa-eye" id="togglePassword" style="position:absolute; right:15px; top:50%; transform:translateY(-50%); cursor:pointer; color:#0d6efd;"></i>
</div>
<button type="submit" name="login">Login</button>
<span class="toggle-link" id="show-signup">Pas encore de compte ? S'inscrire</span>
</form>

<!-- SIGN UP FORM -->
<form method="POST" class="login-form" id="signup-form">
<h2>Sign Up</h2>
<?php if($signup_error) { ?>
    <div class="alert-error"><i class="fa fa-exclamation-triangle"></i> <?= $signup_error ?></div>
<?php } ?>
<input type="text" name="signup_nom" placeholder="Nom" required>
<input type="email" name="signup_email" placeholder="Email" required>
<input type="password" name="signup_password" placeholder="Password" required>
<input type="password" name="signup_confirm" placeholder="Confirmer Password" required>
<button type="submit" name="signup">S'inscrire</button>
<span class="toggle-link" id="show-login">Déjà un compte ? Login</span>
</form>

</div>

<div class="footer">
© 2026 ResolveTech – Turning Problems into Solutions.
</div>

<script>
const togglePassword = document.querySelector('#togglePassword');
const passwordField = document.querySelector('#password-field');
togglePassword.addEventListener('click', function () {
    const type = passwordField.getAttribute('type') === 'password' ? 'text' : 'password';
    passwordField.setAttribute('type', type);
    this.classList.toggle('fa-eye-slash');
});

const showSignup = document.getElementById('show-signup');
const showLogin = document.getElementById('show-login');
const loginForm = document.getElementById('login-form');
const signupForm = document.getElementById('signup-form');

showSignup.addEventListener('click', ()=>{ loginForm.style.display='none'; signupForm.style.display='block'; });
showLogin.addEventListener('click', ()=>{ signupForm.style.display='none'; loginForm.style.display='block'; });
</script>

</body>
</html>