<?php

include "../config/database.php";

$code_barre = $_POST["code_barre"];
$designation = $_POST["designation"];
$quantite = $_POST["quantite"];

$sql = "INSERT INTO articles (code_barre, designation, quantite_stock) VALUES (?,?,?)";

$stmt = $conn->prepare($sql);
$stmt->execute([$code_barre, $designation, $quantite]);

header("Location: ../pages/articles.php?success=1");
exit();

?>