<?php
include('../includes/db.php');
session_start();

$_SESSION['role'] = $_SESSION['role'] ?? 'user';

$homePage = ($_SESSION['role'] === 'admin') ? '../admin_homepage.php' : '../user_homepage.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pending Issue Requests</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">
    <div class="d-flex justify-content-between mb-3">
        <a href="<?= $homePage ?>" class="btn btn-primary">Home</a>
        <a href="/logout.php" class="btn btn-danger">Log Out</a>
    </div>
    <div class="container mt-5">
        <h2 class="text-center">Pending Issue Requests</h2>
        <table class="table table-bordered mt-4">
            <thead class="table-dark">
                <tr>
                    <th>Membership ID</th>
                    <th>Name of Book/Movie</th>
                    <th>Request Date</th>
                    <th>Request fulfilled Date</th>
                </tr>
            </thead>
        </table>
        <a href="./reports.php" class="btn btn-secondary back-btn">Back</a>
    </div>

</body>
</html>