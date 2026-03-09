<?php
include "../includes/auth.php";
include "../includes/header.php";
include "../config/database.php";
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

.add-article-container input,
.add-article-container select {
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
<h2>Ajouter / Mettre à jour Article</h2>

<form action="../actions/update_stock.php" method="POST" id="stockForm">

<select name="article_select" id="articleSelect" required>
    <option value="">-- Sélectionner un article --</option>
    <option value="new">+ Ajouter nouvel article</option>
    <?php
    $stmt = $conn->prepare("SELECT * FROM articles ORDER BY designation ASC");
    $stmt->execute();
    $articles = $stmt->fetchAll(PDO::FETCH_ASSOC);
    foreach($articles as $art) {
        echo '<option value="'.$art['id'].'" data-code="'.$art['code_barre'].'" data-designation="'.htmlspecialchars($art['designation']).'">'
             .htmlspecialchars($art['designation']).' ('.$art['code_barre'].')</option>';
    }
    ?>
</select>

<div id="newArticleFields" style="display:none;">
    <input type="text" name="code_barre" placeholder="Code Barre article">
    <input type="text" name="designation_new" placeholder="Designation article">
</div>

<input type="number" name="quantite" placeholder="Quantité à ajouter" required min="1">

<button type="submit">Ajouter au stock</button>
</form>
</div>
</main>

<script>
const articleSelect = document.getElementById('articleSelect');
const newArticleFields = document.getElementById('newArticleFields');
const stockForm = document.getElementById('stockForm');

articleSelect.addEventListener('change', function() {
    if(this.value === 'new') {
        newArticleFields.style.display = 'block';
        stock<?php
include "../includes/auth.php";
include "../includes/header.php";
include "../config/database.php";
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

.add-article-container input,
.add-article-container select {
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
<h2>Ajouter / Mettre à jour Article</h2>

<form action="../actions/update_stock.php" method="POST" id="stockForm">

<select name="article_select" id="articleSelect" required>
    <option value="">-- Sélectionner un article --</option>
    <option value="new">+ Ajouter nouvel article</option>
    <?php
    $stmt = $conn->prepare("SELECT * FROM articles ORDER BY designation ASC");
    $stmt->execute();
    $articles = $stmt->fetchAll(PDO::FETCH_ASSOC);
    foreach($articles as $art) {
        echo '<option value="'.$art['id'].'" data-code="'.$art['code_barre'].'" data-designation="'.htmlspecialchars($art['designation']).'">'
             .htmlspecialchars($art['designation']).' ('.$art['code_barre'].')</option>';
    }
    ?>
</select>

<div id="newArticleFields" style="display:none;">
    <input type="text" name="code_barre" placeholder="Code Barre article">
    <input type="text" name="designation_new" placeholder="Designation article">
</div>

<input type="number" name="quantite" placeholder="Quantité à ajouter" required min="1">

<button type="submit">Ajouter au stock</button>
</form>
</div>
</main>

<script>
const articleSelect = document.getElementById('articleSelect');
const newArticleFields = document.getElementById('newArticleFields');
const stockForm = document.getElementById('stockForm');

articleSelect.addEventListener('change', function() {
    if(this.value === 'new') {
        newArticleFields.style.display = 'block';
        stockForm.querySelector('input[name="designation_new"]').required = true;
        stockForm.querySelector('input[name="code_barre"]').required = true;
    } else if(this.value !== '') {
        newArticleFields.style.display = 'none';
        stockForm.querySelector('input[name="designation_new"]').required = false;
        stockForm.querySelector('input[name="code_barre"]').required = false;
    } else {
        newArticleFields.style.display = 'none';
        stockForm.querySelector('input[name="designation_new"]').required = false;
        stockForm.querySelector('input[name="code_barre"]').required = false;
    }
});
</script>Form.querySelector('input[name="designation_new"]').required = true;
        stockForm.querySelector('input[name="code_barre"]').required = true;
    } else if(this.value !== '') {
        newArticleFields.style.display = 'none';
        stockForm.querySelector('input[name="designation_new"]').required = false;
        stockForm.querySelector('input[name="code_barre"]').required = false;
    } else {
        newArticleFields.style.display = 'none';
        stockForm.querySelector('input[name="designation_new"]').required = false;
        stockForm.querySelector('input[name="code_barre"]').required = false;
    }
});
</script>