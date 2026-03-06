<?php
include "../includes/auth.php";
include "../includes/header.php";
?>

<style>
body, html {
    height: 100%;
    margin: 0;
    font-family: 'Segoe UI', Arial, Helvetica, sans-serif;
    background: linear-gradient(135deg,#0f172a,#1e3a5f);
    color: #f1f5f9;
    display: flex;
    flex-direction: column;
}

main {
    flex: 1;
    display: flex;
    justify-content: center;
    align-items: center;
    padding: 40px 20px;
}

.add-article-container {
    width: 100%;
    max-width: 500px;
    padding: 35px;
    background: rgba(255,255,255,0.05);
    border-radius: 15px;
    box-shadow: 0 15px 30px rgba(0,0,0,0.4);
}

.add-article-container h2 {
    text-align: center;
    margin-bottom: 30px;
    font-size: 30px;
    color: #38bdf8;
}

.add-article-container input {
    width: 100%;
    padding: 12px;
    margin-bottom: 20px;
    border-radius: 8px;
    border: 1px solid rgba(255,255,255,0.3);
    background: rgba(255,255,255,0.08);
    color: #e0f7fa;
}

.add-article-container button {
    width: 100%;
    padding: 12px;
    background: #0d6efd;
    border: none;
    border-radius: 8px;
    color: white;
    font-weight: bold;
}
</style>

<main>
<div class="add-article-container">

<h2>Ajouter Article</h2>

<form action="../actions/add_article.php" method="POST">

<input type="text" name="code_barre" placeholder="Code Barre" required>

<input type="text" name="designation" placeholder="Designation" required>

<input type="number" name="quantite" placeholder="Quantité" required min="0">

<button type="submit">Ajouter</button>

</form>

</div>
</main>

<?php include "../includes/footer.php"; ?>