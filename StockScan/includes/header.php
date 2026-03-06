<!DOCTYPE html>
<html>
<head>
    <title>StockScan</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <style>
        /* Change navbar background and text */
        .navbar {
            background-color: #0a1f2f !important; /* Dodger Blue */
        }
        .navbar-brand {
            font-weight: bold;
            color: #fff !important;
            
        }
        /* Change Logout button color */
        .btn-danger {
            background-color: #ff6347; /* Tomato red */
            border: none;
        }
        .btn-danger:hover {
            background-color: #e5533c;
        }
        /* Optional: Add some padding to container */
        .container.mt-4 {
            padding: 20px;
            background-color: #f8f9fa; /* light grey background */
            border-radius: 8px;
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-dark">
        <div class="container">
            <a class="navbar-brand">StockScan</a>
            <a href="login.php" class="btn btn-danger">Logout</a>
        </div>
    </nav>

    
</body>
</html>
 