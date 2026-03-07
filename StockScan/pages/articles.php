<?php
include "../includes/auth.php";
include "../includes/header.php";
include "../config/database.php";
?>

<style>
/* BODY STYLE */
body, html {
    height: 100%;
    margin: 0;
    font-family: 'Segoe UI', Arial, Helvetica, sans-serif;
    background: linear-gradient(135deg,#0f172a,#1e3a5f);
    color: #f1f5f9;
}

/* CONTAINER */
.articles-container {
    margin-top: 40px;
    padding: 30px;
    background: rgba(255,255,255,0.05);
    border-radius: 15px;
    box-shadow: 0 15px 30px rgba(0,0,0,0.4);
}

/* TITLE */
.page-title{
    font-size:30px;
    font-weight:700;
    margin-bottom:25px;
    color:#38bdf8;
}

/* BUTTON */
.btn-success{
    background:#0d6efd;
    border:none;
    padding:10px 20px;
    border-radius:8px;
    font-weight:600;
    transition:0.3s;
}
.btn-success:hover{
    background:#084298;
    box-shadow:0 8px 20px rgba(0,0,0,0.3);
}
.btn-danger{
    background:#ff6347;
    border:none;
    padding:5px 10px;
    border-radius:5px;
}
.btn-danger:hover{
    background:#e5533c;
}

/* TABLE STYLE */
.table{
    margin-top:15px;
    border-radius:10px;
    overflow:hidden;
}
.table th{
    background:rgba(0,0,0,0.35);
    color:#38bdf8;
    text-align:center;
}
.table td{
    background:rgba(255,255,255,0.05);
    color:#e0f7fa;
    text-align:center;
}
.table tr:hover{
    background:rgba(255,255,255,0.08);
}

/* FOOTER */
.footer {
    margin-top:40px;
    padding:20px 0;
    text-align:center;
    background:#0a1f2f;
    color:rgba(255,255,255,0.7);
    font-size:14px;
    border-top:1px solid rgba(255,255,255,0.2);
    border-radius:15px 15px 0 0;
}
</style>

<div class="container articles-container">

<h2 class="page-title">Articles</h2>

<a href="ajouter_article.php" class="btn btn-success mb-3">Ajouter Article</a>

<?php if(isset($_GET['success']) && $_GET['success']==1): ?>
<div class="alert alert-success text-center">
Article ajouté avec succès
</div>
<?php endif; ?>

<?php if(isset($_GET['deleted']) && $_GET['deleted']==1): ?>
<div class="alert alert-success text-center">
Article supprimé avec succès
</div>
<?php endif; ?>

<table class="table table-hover">
<thead>
<tr>
<th>ID</th>
<th>Code Barre</th>
<th>Designation</th>
<th>Stock</th>
<th>Action</th>
</tr>
</thead>
<tbody>

<?php
// Récupérer tous les articles
$stmt = $conn->prepare("SELECT * FROM articles ORDER BY id ASC");
$stmt->execute();
$articles = $stmt->fetchAll();

foreach($articles as $article):
?>
<tr>
<td><?= $article['id'] ?></td>
<td><?= $article['code_barre'] ?></td>
<td><?= $article['designation'] ?></td>
<td><?= $article['quantite_stock'] ?></td>
<td>
    <form method="POST" action="../actions/delete_article.php" onsubmit="return confirm('Voulez-vous vraiment supprimer cet article ?');">
        <input type="hidden" name="article_id" value="<?= $article['id'] ?>">
        <button type="submit" class="btn btn-danger btn-sm">Supprimer</button>
    </form>
</td>
</tr>
<?php endforeach; ?>

</tbody>
</table>

</div>

<div class="footer">
© 2026 ResolveTech – Turning Problems into Solutions.
</div>

<script src="../assets/js/main.js"></script>