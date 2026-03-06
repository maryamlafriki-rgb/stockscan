<?php
include "../config/database.php";
session_start();

$code=$_POST["code_barre"];
$type=$_POST["type"];
$qte=$_POST["quantite"];

$stmt=$conn->prepare("SELECT * FROM articles WHERE code_barre=?");
$stmt->execute([$code]);
$article=$stmt->fetch();

if($article){

$id=$article["id"];

$conn->prepare("INSERT INTO mouvements(article_id,user_id,type,quantite) VALUES(?,?,?,?)")
->execute([$id,$_SESSION["user_id"],$type,$qte]);

if($type=="ENTREE"){
$conn->prepare("UPDATE articles SET quantite_stock=quantite_stock+? WHERE id=?")
->execute([$qte,$id]);
}else{
$conn->prepare("UPDATE articles SET quantite_stock=quantite_stock-? WHERE id=?")
->execute([$qte,$id]);
}

}

header("Location: ../pages/mouvement.php");
?>