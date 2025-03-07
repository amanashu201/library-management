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
    <title>Transaction Cancelled</title>
    <style>
        body {
            text-align: center;
            margin-top: 100px;
        }
        a {
            display: inline-block;
            margin-top: 20px;
            padding: 10px;
            text-decoration: none;
            border: 1px solid black;
        }
    </style>
</head>

<body>

    <h2>Transaction Cancelled</h2>
    <a href="<?= $homePage ?>">Home</a>
    <a href="logout.php">Log Out</a>

</body>

</html>
