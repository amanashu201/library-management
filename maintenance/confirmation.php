<?php
session_start();

$_SESSION['role'] = $_SESSION['role'] ?? 'user'; 

$homePage = ($_SESSION['role'] === 'admin') ? '../admin_homepage.php' : '../user_homepage.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Transaction Confirmation</title>
    <style>
        body {
            text-align: center;
            margin-top: 100px;
            font-family: Arial, sans-serif;
        }
        .container {
            width: 300px;
            margin: auto;
            padding: 20px;
            border: 1px solid black;
        }
        a, button {
            display: block;
            width: 100%;
            margin: 5px 0;
            padding: 8px;
            text-decoration: none;
            text-align: center;
            border: 1px solid black;
        }
    </style>
</head>
<body>

    <a href="<?= $homePage ?>">Home</a>

    <div class="container">
        <h4>Transaction completed successfully.</h4>
        <a href="../logout.php">Log Out</a>
    </div>

</body>
</html>
