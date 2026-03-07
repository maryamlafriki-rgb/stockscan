<?php
include(__DIR__ . "/../config/database.php");

$stmt = $conn->query("SELECT designation FROM articles");
$articles = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html>
<head>
<title>StockScan</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

<style>

body{
background: linear-gradient(135deg,#0f172a,#1e3a5f);
color:white;
font-family: Arial;
}

.add-article-container{
max-width:500px;
margin:auto;
margin-top:80px;
padding:30px;
background:rgba(255,255,255,0.05);
border-radius:10px;
}

select,input{
width:100%;
padding:10px;
margin-bottom:15px;
border-radius:6px;
border:none;
}

button{
width:100%;
padding:10px;
background:#0d6efd;
color:white;
border:none;
border-radius:6px;
}

</style>

</head>

<body>

<div class="add-article-container">

<h2 class="text-center mb-4">Ajouter Article</h2>

<form action="../actions/add_article.php" method="POST">

<select name="designation" id="designation" onchange="checkArticle()" required>

<option value="">-- Choisir un article --</option>

<option value="new">➕ Ajouter un nouvel article</option>

<?php foreach($articles as $article): ?>

<option value="<?= $article['designation']; ?>">
<?= $article['designation']; ?>
</option>

<?php endforeach; ?>

</select>


<div id="newArticleFields" style="display:none;">

<input type="text" name="new_designation" placeholder="Designation">

<input type="text" name="code_barre" placeholder="Code Barre">

</div>


<input type="number" name="quantite" placeholder="Quantité" required min="1">

<button type="submit">Ajouter</button>

</form>

</div>

<script>

function checkArticle(){

let select = document.getElementById("designation");
let fields = document.getElementById("newArticleFields");

if(select.value === "new"){
fields.style.display = "block";
}else{
fields.style.display = "none";
}

}

</script>

</body>
</html>