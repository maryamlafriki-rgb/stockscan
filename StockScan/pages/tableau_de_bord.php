<?php
include "../includes/auth.php";
include "../includes/header.php";
include "../config/database.php";
?>
<?php
// Nombre total d'articles stockés
$stmt1 = $conn->prepare("SELECT COUNT(*) as total_articles FROM articles");
$stmt1->execute();
$total_articles = $stmt1->fetch()['total_articles'];

// Nombre d'articles scannés
$stmt2 = $conn->prepare("SELECT SUM(quantite_stock) as total_scannes FROM articles");
$stmt2->execute();
$total_scannes = $stmt2->fetch()['total_scannes'];
?>
<!DOCTYPE html>
<html>
<head>
    <title>Tableau de bord</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <h2>Tableau de bord</h2>
    <div class="row mt-4">
        <div class="col-md-6">
            <div class="card text-center bg-primary text-white p-3">
                <h4>Total Articles</h4>
                <p style="font-size:24px;"><?= $total_articles ?></p>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card text-center bg-success text-white p-3">
                <h4>Articles Scannés</h4>
                <p style="font-size:24px;"><?= $total_scannes ?></p>
            </div>
        </div>
    </div>
</div>
</body>
</html>