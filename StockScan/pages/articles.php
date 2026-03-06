<?php
include "../includes/auth.php";
include "../config/database.php";
include "../includes/header.php";

$articles=$conn->query("SELECT * FROM articles");
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
<?php if(isset($_GET["success"])) { ?>
<div class="alert alert-success text-center">
Article ajouté avec succès
</div>
<?php } ?>

<table class="table table-hover">

<thead>
<tr>
<th>ID</th>
<th>Code Barre</th>
<th>Designation</th>
<th>Stock</th>
</tr>
</thead>

<tbody>

<?php foreach($articles as $a): ?>

<tr>
<td><?= $a["id"] ?></td>
<td><?= $a["code_barre"] ?></td>
<td><?= $a["designation"] ?></td>
<td><?= $a["quantite_stock"] ?></td>
</tr>

<?php endforeach; ?>

</tbody>
</table>

</div>

<div class="footer">
© 2026 ResolveTech – Turning Problems into Solutions.
</div>

<?php include "../includes/footer.php"; ?>