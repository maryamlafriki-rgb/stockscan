<?php
include(__DIR__ . "/../config/database.php");

$designation = $_POST['designation'];
$quantite = $_POST['quantite'];

if($designation == "new") {
    $new_designation = $_POST['new_designation'];
    $code_barre = $_POST['code_barre'];

    // Vérifier si l'article existe déjà
    $stmt = $conn->prepare("SELECT * FROM articles WHERE designation = ?");
    $stmt->execute([$new_designation]);

    if($stmt->rowCount() > 0){
        // Article existe → mise à jour quantité
        $update = $conn->prepare("UPDATE articles SET quantite_stock = quantite_stock + ? WHERE designation = ?");
        $update->execute([$quantite,$new_designation]);
    } else {
        // Article n'existe pas → insérer
        $insert = $conn->prepare("INSERT INTO articles (designation, code_barre, quantite_stock) VALUES (?,?,?)");
        $insert->execute([$new_designation,$code_barre,$quantite]);
    }

} else {
    // Article existant → mettre à jour la quantité
    $update = $conn->prepare("UPDATE articles SET quantite_stock = quantite_stock + ? WHERE designation = ?");
    $update->execute([$quantite,$designation]);
}

header("Location: ../pages/articles.php");
exit;
?>