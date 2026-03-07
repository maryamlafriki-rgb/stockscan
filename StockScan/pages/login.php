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
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>StockScan</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

<style>

body{
display:flex;
flex-direction:column;
min-height:100vh;
font-family:Arial;
background:
linear-gradient(rgba(15,23,42,0.6), rgba(30,58,95,0.6)),
url("BACKGROUNDCMC.png");
background-size:cover;
background-position:center;
color:white;
}

.login-container{
flex:1;
display:flex;
justify-content:center;
align-items:center;
}

.card-auth{
background:rgba(255,255,255,0.05);
padding:30px;
border-radius:15px;
width:400px;
box-shadow:0 10px 25px rgba(0,0,0,0.3);
}

/* LABEL */

.card-auth label{
display:block;
margin-bottom:6px;
margin-top:10px;
color:#e2e8f0;
font-weight:500;
transition:0.3s;
}

.card-auth label:hover{
color:#38bdf8;
}

/* INPUT */

.card-auth input{
width:100%;
padding:10px;
margin-bottom:10px;
border-radius:6px;
border:none;
outline:none;
transition:0.3s;
}

.card-auth input:focus{
box-shadow:0 0 5px #38bdf8;
}

/* BUTTON */

.card-auth button{
width:100%;
padding:10px;
background:#0d6efd;
border:none;
border-radius:6px;
color:white;
font-weight:bold;
margin-top:10px;
}

.nav-tabs .nav-link{
color:white;
}

.nav-tabs .nav-link.active{
background:#0d6efd;
color:white;
}

/* AUTH TABS */

.auth-tabs .nav-link{
color:white;
font-size:18px;
margin:0 15px;
background:none;
border:none;
text-decoration:underline;
}

.auth-tabs .nav-link.active{
color:#38bdf8;
font-weight:bold;
}

/* FOOTER */

.footer{
position:fixed;
bottom:0;
width:100%;
text-align:center;
padding:15px;
background:#0a1f2f;
}

</style>
</head>

<body>

<div class="login-container">

<div class="card-auth">

<ul class="nav justify-content-center auth-tabs">

<li class="nav-item">
<a class="nav-link active" data-bs-toggle="tab" href="#login">Login</a>
</li>

<li class="nav-item">
<a class="nav-link" data-bs-toggle="tab" href="#signup">Sign Up</a>
</li>

</ul>
<div class="tab-content">

<!-- LOGIN -->

<div class="tab-pane fade show active" id="login">

<?php if($email_error){ ?>

<div class="alert alert-danger">
Email incorrect
</div>

<?php } ?>

<?php if($password_error){ ?>

<div class="alert alert-danger">
Mot de passe incorrect
</div>

<?php } ?>

<form method="POST">

<label>Email</label>
<input type="email" name="email" required>

<label>Password</label>
<input type="password" name="password" required>

<button type="submit" name="login">
Login
</button>

</form>

</div>

<!-- SIGN UP -->

<div class="tab-pane fade" id="signup">

<?php if($signup_error){ ?>

<div class="alert alert-danger">
<?= $signup_error ?>
</div>

<?php } ?>

<form method="POST">

<input type="email" name="signup_email" placeholder="Email" required>

<input type="password" name="signup_password" placeholder="Password" required>

<input type="password" name="signup_confirm" placeholder="Confirm Password" required>

<button type="submit" name="signup">
Sign Up
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

</body>
</html>