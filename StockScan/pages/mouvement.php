<?php
include "../includes/auth.php";
include "../includes/header.php";
?>

<style>

/* BODY FULL HEIGHT */
body, html {
    height: 100%;
    margin: 0;
    font-family: 'Segoe UI', Arial, Helvetica, sans-serif;
    background: linear-gradient(135deg,#0f172a,#1e3a5f);
    color: #f1f5f9;
    display: flex;
    flex-direction: column;
}

/* MAIN CONTENT FLEX */
main {
    flex: 1;
    display: flex;
    justify-content: center;
    align-items: center;
    padding: 40px 20px;
}

/* FORM CONTAINER */
.mouvement-container {
    width: 100%;
    max-width: 500px;
    padding: 35px;
    background: rgba(255,255,255,0.05);
    border-radius: 15px;
    box-shadow: 0 15px 30px rgba(0,0,0,0.4);
    color: #f1f5f9;
}

/* TITLE */
.mouvement-container h2 {
    text-align: center;
    margin-bottom: 30px;
    font-size: 30px;
    font-weight: 700;
    color: #38bdf8;
}

/* INPUTS */
.mouvement-container input,
.mouvement-container select {
    width: 100%;
    padding: 12px 15px;
    margin-bottom: 20px;
    border-radius: 8px;
    border: 1px solid rgba(255,255,255,0.3);
    background: rgba(255,255,255,0.08);
    color: #e0f7fa;
    font-size: 15px;
    transition: 0.3s;
}

.mouvement-container input:focus,
.mouvement-container select:focus {
    border-color: #38bdf8;
    background: rgba(255,255,255,0.15);
    outline: none;
}

/* BUTTON */
.mouvement-container button {
    width: 100%;
    padding: 12px;
    background: #0d6efd;
    border: none;
    border-radius: 8px;
    font-weight: 600;
    font-size: 16px;
    color: #fff;
    cursor: pointer;
    transition: all 0.3s ease;
}

.mouvement-container button:hover {
    background: #084298;
    box-shadow: 0 8px 20px rgba(0,0,0,0.3);
}

/* FOOTER */
.footer {
    padding: 20px 0;
    text-align:center;
    background: #0a1f2f;
    color: rgba(255,255,255,0.7);
    font-size: 14px;
    border-top:1px solid rgba(255,255,255,0.2);
    border-radius:15px 15px 0 0;
}

</style>

<main>

<div class="mouvement-container container">

<h2>Nouveau Mouvement</h2>

<form action="../actions/add_mouvement.php" method="POST">

<input type="text" name="code_barre" placeholder="Scan code barre" autofocus required>

<select name="type">
<option value="ENTREE">ENTREE</option>
<option value="SORTIE">SORTIE</option>
</select>

<input type="number" name="quantite" value="1" min="1">

<button type="submit">Valider</button>

</form>

</div>

</main>

<div class="footer">
© 2026 ResolveTech – Turning Problems into Solutions.
</div>

<?php include "../includes/footer.php"; ?>