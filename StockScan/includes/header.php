<!DOCTYPE html>
<html>
<head>
    <title>StockScan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-family: 'Segoe UI', Arial, sans-serif;
            background: #f0f2f5;
            margin: 0;
        }

        /* Sidebar */
        .sidebar {
            height: 100vh;
            width: 220px;
            position: fixed;
            top: 0;
            left: -220px; /* caché par défaut */
            background-color: #0a1f2f;
            padding-top: 20px;
            display: flex;
            flex-direction: column;
            transition: left 0.3s;
            z-index: 1000;
        }

        .sidebar a {
            color: #fff;
            padding: 12px 20px;
            text-decoration: none;
            display: block;
            font-weight: 600;
            transition: 0.2s;
        }

        .sidebar a:hover {
            background-color: #084298;
            border-radius: 5px;
        }

        .sidebar .brand {
            font-size: 24px;
            font-weight: bold;
            text-align: center;
            margin-bottom: 20px;
            color: #38bdf8;
        }

        .sidebar .close-btn {
            font-size: 25px;
            color: #fff;
            text-align: right;
            padding: 0 20px;
            cursor: pointer;
            margin-bottom: 10px;
        }

        .btn-logout {
            margin-top: auto;
            margin-bottom: 20px;
            background-color: #ff6347;
            color: #fff;
            border: none;
            font-weight: 600;
        }

        .btn-logout:hover {
            background-color: #e5533c;
        }

        /* Content area */
        .content {
            margin-left: 0;
            padding: 20px;
            transition: margin-left 0.3s;
        }

        /* Hamburger button */
        .hamburger {
            font-size: 30px;
            cursor: pointer;
            color: #38bdf8;
            margin: 10px;
        }

        .hamburger:hover {
            color: #0d6efd;
        }

        /* Quand la sidebar est ouverte */
        .sidebar.show {
            left: 0;
        }

        .content.shift {
            margin-left: 220px;
        }
    </style>
</head>
<body>

<!-- Hamburger -->
<span class="hamburger" onclick="toggleSidebar()">&#9776;</span>

<!-- Sidebar -->
<div class="sidebar" id="sidebar">
    <div class="close-btn" onclick="toggleSidebar()">×</div>
    <div class="brand">StockScan</div>
    <a href="articles.php">Articles</a>
    <a href="tableau_de_bord.php">Tableau de bord</a>
    <a href="ajouter_article.php">Ajouter Article</a>
    <a href="login.php" class="btn btn-logout">Logout</a>
</div>

<!-- Content -->


<script>
    function toggleSidebar() {
        const sidebar = document.getElementById('sidebar');
        const content = document.getElementById('content');
        sidebar.classList.toggle('show');
        content.classList.toggle('shift');
    }
</script>

</body>
</html>