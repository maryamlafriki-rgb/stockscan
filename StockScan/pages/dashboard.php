<?php
include "../includes/auth.php";
include "../includes/header.php";
?>

<style>

/* BODY */
body{
    background: linear-gradient(135deg,#0f172a,#1e3a5f);
    color:white;
    font-family: Arial, Helvetica, sans-serif;
    min-height:100vh;
    display:flex;
    flex-direction:column;
}

/* MAIN */
.main-content{
    flex:1;
    padding:20px 30px 40px 30px;
}

/* BIENVENUE */
.dashboard-hero{
    background: linear-gradient(135deg,rgba(255,255,255,0.05), rgba(255,255,255,0.15));
    padding:35px;
    border-radius:15px;
    text-align:center;
    margin-bottom:25px;
    box-shadow:0 10px 25px rgba(0,0,0,0.3);
}

.dashboard-hero h2{
    font-size:32px;
    font-weight:bold;
    margin-bottom:12px;
    color:#e0f7fa;
}

.dashboard-hero p{
    font-size:16px;
    color:#cfd8dc;
}

/* Cards */
.card{
    border:none;
    border-radius:12px;
    transition:0.3s;
    background: linear-gradient(135deg,#ffffff,#e6f2ff);
}

.card:hover{
    transform: translateY(-8px);
    box-shadow:0 15px 30px rgba(0,0,0,0.3);
}

.card i{
    margin-bottom:15px;
}

/* Titles & Text in Cards */
.card h4{
    color:#0d3c91;
}

.card p{
    color:#555;
}

/* FOOTER */
.footer {
    position: fixed;   /* يخلي footer ثابت لتحت الشاشة */
    bottom: 0;         /* من القاع */
    left: 0;
    width: 100%;       /* يغطي كامل العرض */
    padding: 20px 0;
    text-align: center;
    background: #0a1f2f;
    color: rgba(255,255,255,0.7);
    border-top: 1px solid rgba(255,255,255,0.2);
    font-size: 14px;
    border-radius: 15px 15px 0 0;
    z-index: 999;      /* باش يبقى فوق باقي العناصر */
}

</style>

<!-- MAIN CONTENT -->
<div class="main-content">

<!-- BIENVENUE -->
<div class="dashboard-hero">
<h2>Bienvenue dans StockScan 📦</h2>
<p>Système de gestion de stock par code-barres. Utilisez le menu ci-dessous pour gérer les articles, les mouvements et l'historique.</p>
</div>

<!-- CARDS -->
<div class="row text-center">

<div class="col-md-4 mb-4">
<a href="articles.php" style="text-decoration:none;">
<div class="card shadow-sm h-100">
<div class="card-body">
<i class="fa-solid fa-box fa-3x text-primary"></i>
<h4 class="mt-2">Articles</h4>
<p>Gestion des articles</p>
</div>
</div>
</a>
</div>

<div class="col-md-4 mb-4">
<a href="mouvement.php" style="text-decoration:none;">
<div class="card shadow-sm h-100">
<div class="card-body">
<i class="fa-solid fa-right-left fa-3x text-success"></i>
<h4 class="mt-2">Mouvement</h4>
<p>Entrée et sortie du stock</p>
</div>
</div>
</a>
</div>

<div class="col-md-4 mb-4">
<a href="historique.php" style="text-decoration:none;">
<div class="card shadow-sm h-100">
<div class="card-body">
<i class="fa-solid fa-clock-rotate-left fa-3x text-info"></i>
<h4 class="mt-2">Historique</h4>
<p>Voir les mouvements</p>
</div>
</div>
</a>
</div>

</div> <!-- row -->

</div> <!-- main-content -->

<!-- FOOTER -->
<div class="footer">
© 2026 ResolveTech – Turning Problems into Solutions.
</div>

<?php
include "../includes/footer.php";
?>
