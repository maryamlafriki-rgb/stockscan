<?php
include "../config/database.php";

if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['article_id'])){
    $id = (int) $_POST['article_id'];
    $stmt = $conn->prepare("DELETE FROM articles WHERE id=?");
    $stmt->execute([$id]);
    header("Location: ../pages/articles.php?deleted=1");
    exit();
}
?>