<?php
include "../includes/auth.php";
include "../config/database.php";
include "../includes/header.php";

$mouvements=$conn->query("SELECT * FROM mouvements");
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
.historique-container {
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

<div class="container historique-container">

<h2 class="page-title">Historique des Mouvements</h2>

<table class="table table-hover">

<thead>
<tr>
<th>Article</th>
<th>Type</th>
<th>Quantité</th>
<th>Date</th>
</tr>
</thead>

<tbody>

<?php foreach($mouvements as $m): ?>

<tr>
<td><?= $m["article_id"] ?></td>
<td><?= $m["type"] ?></td>
<td><?= $m["quantite"] ?></td>
<td><?= $m["date_mouvement"] ?></td>
</tr>

<?php endforeach; ?>

</tbody>

</table>

</div>

<div class="footer">
© 2026 ResolveTech – Turning Problems into Solutions.
</div>

<?php include "../includes/footer.php"; ?>