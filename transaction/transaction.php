<?php
session_start();
$_SESSION['role'] = $_SESSION['role'] ?? 'user';
$homePage = ($_SESSION['role'] === 'admin') ? '../admin_homepage.php' : '../user_homepage.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Transactions</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .container {
            max-width: 500px;
            margin-top: 50px;
        }
        .card {
            border: 1px solid #ddd;
            background: white;
        }
        .list-group-item {
            border: none;
        }
    </style>
</head>

<body class="container">

    <div class="mb-3">
        <a href="<?= $homePage ?>" class="btn btn-light border">Home</a>
    </div>

    <div class="card p-3">
        <h2 class="h5">Transactions</h2>
        <ul class="list-group">
            <li class="list-group-item"><a href="check_availability.php" class="text-dark text-decoration-none">Check Availability</a></li>
            <li class="list-group-item"><a href="issue_bbok.php" class="text-dark text-decoration-none">Issue Book</a></li>
            <li class="list-group-item"><a href="return_book.php" class="text-dark text-decoration-none">Return Book</a></li>
            <li class="list-group-item"><a href="pay_fine.php" class="text-dark text-decoration-none">Pay Fine</a></li>
        </ul>
    </div>

    <div class="mt-3 text-end">
        <a href="/logout.php" class="btn btn-light border">Log Out</a>
    </div>

</body>
</html>
