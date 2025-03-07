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
    <title>Maintenance</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            height: 100vh;
            margin: 0;
        }
        .container {
            max-width: 400px;
            text-align: center;
        }
        .section {
            margin-top: 20px;
            padding: 15px;
            border: 1px solid #000;
            border-radius: 10px;
        }
        .btn-group {
            display: flex;
            justify-content: center;
            gap: 10px;
        }
    </style>
</head>

<body>

    <div class="container">
        <h2>Maintenance</h2>

        <div class="section">
            <h4>Membership</h4>
            <div class="btn-group">
                <a href="./membership/membership_add.php" class="btn border">Add</a>
                <a href="./membership/membership_update.php"></a>
            </div>
        </div>

        <div class="section">
            <h4>Books/Movies</h4>
            <div class="btn-group">
                <a href="./books/movies/add.php" class="btn border">Add</a>
                <a href="./books/movies/update.php" ></a>
            </div>
        </div>

        <div class="section">
            <h4>User Management</h4>
            <div class="btn-group">
                <a href="./user_mgmt/add.php" class="btn border">Add</a>
                <a href="./user_mgmt/update.php"></a>
            </div>
        </div>
            <div class="section">
            <h4>Issue Books</h4>
            <div class="btn-group">
                <a href="./issue/issuebook.php" class="btn border">Add</a>
                <a href="./issue/issuebook.php"></a>
            </div>
        </div>

        <div class="mt-3">
            <a href="<?= $homePage ?>" class="btn border">Home</a>
            <a href="../logout.php" class="btn border">Log Out</a>
        </div>
    </div>

</body>

</html>
