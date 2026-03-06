<?php
include "../config/database.php";
session_start();

$email_error = false;
$password_error = false;

if($_SERVER["REQUEST_METHOD"]=="POST"){

    $email = $_POST["email"];
    $password = $_POST["password"];

    // نشوفوا واش Email موجود
    $stmt = $conn->prepare("SELECT * FROM users WHERE email=?");
    $stmt->execute([$email]);
    $user = $stmt->fetch();

    if(!$user){
        $email_error = true; // Email غير موجود
    } else if($user['password'] != $password){
        $password_error = true; // Password خطأ
    } else {
        $_SESSION["user_id"] = $user["id"];
        header("Location: dashboard.php");
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Login - StockScan</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

<style>
body {
    display: flex;
    flex-direction: column;
    min-height: 100vh;
    font-family: Arial, Helvetica, sans-serif;
    color: white;
    margin:0;

    background:
    linear-gradient(rgba(15,23,42,0.6), rgba(30,58,95,0.6)),
    url("BACKGROUNDCMC.png");

    background-size: cover;
    background-position: center;
    background-repeat: no-repeat;
}
/* FORM CENTERED */
.login-container {
    flex:1;
    display: flex;
    justify-content: center;
    align-items: center;
    padding:20px;
}

.login-form {
    background: rgba(255,255,255,0.05);
    padding:30px;
    border-radius:15px;
    box-shadow:0 10px 25px rgba(0,0,0,0.3);
    width:100%;
    max-width:400px;
    text-align:center;
}

.login-form h2 {
    margin-bottom:20px;
    color:#e0f7fa;
}

/* INPUT FIELDS */
.login-form input {
    width:100%;
    padding:10px 15px;
    margin-bottom:15px;
    border-radius:5px;
    border: 2px solid transparent;
    transition:0.3s;
}

.login-form input.error-border {
    border-color: #dc3545;
}

/* BUTTON */
.login-form button {
    width:100%;
    padding:10px;
    background:#0d6efd;
    border:none;
    color:white;
    font-weight:bold;
    border-radius:5px;
    transition:0.3s;
}

.login-form button:hover {
    background:#084298;
}

/* ERROR ALERT */
.alert-error {
    display:flex;
    align-items:center;
    justify-content:center;
    background: #dc3545;
    color: white;
    padding:10px 15px;
    border-radius:8px;
    margin-bottom:15px;
    animation: fadeIn 0.5s ease;
}

.alert-error i {
    margin-right:8px;
}

@keyframes fadeIn {
    from {opacity:0; transform: translateY(-10px);}
    to {opacity:1; transform: translateY(0);}
}

/* FOOTER FIXED */
.footer {
    position: fixed;
    bottom:0;
    left:0;
    width:100%;
    padding:15px 0;
    text-align:center;
    background: #0a1f2f;
    color: rgba(255,255,255,0.7);
    font-size: 14px;
    border-top:1px solid rgba(255,255,255,0.2);
    border-radius:15px 15px 0 0;
    z-index:999;
}
</style>
</head>
<body>

<div class="login-container">
    <form method="POST" class="login-form">
        <h2>Login</h2>

        <?php if($email_error) { ?>
            <div class="alert-error">
                <i class="fa fa-exclamation-triangle"></i> Email incorrect
            </div>
        <?php } else if($password_error) { ?>
            <div class="alert-error">
                <i class="fa fa-exclamation-triangle"></i> Mot de passe incorrect
            </div>
        <?php } ?>

        <input type="email" name="email" placeholder="Email" required class="<?php if($email_error) echo 'error-border'; ?>">
<!-- PASSWORD FIELD WITH TOGGLE -->
<div style="position: relative;">
    <input type="password" name="password" placeholder="Password" required 
           class="<?php if($password_error) echo 'error-border'; ?>" id="password-field">
    <i class="fa fa-eye" id="togglePassword" 
       style="position:absolute; right:15px; top:50%; transform: translateY(-50%); cursor:pointer; color: #0d6efd;"></i>
</div>        <button type="submit">Login</button>
    </form>
    <script>
const togglePassword = document.querySelector('#togglePassword');
const passwordField = document.querySelector('#password-field');

togglePassword.addEventListener('click', function () {
    const type = passwordField.getAttribute('type') === 'password' ? 'text' : 'password';
    passwordField.setAttribute('type', type);
    this.classList.toggle('fa-eye-slash');
});
</script>
</div>

<div class="footer">
© 2026 ResolveTech – Turning Problems into Solutions.
</div>

</body>
</html>