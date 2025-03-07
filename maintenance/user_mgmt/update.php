<?php
session_start();
include(__DIR__ . '/../../includes/db.php');

$_SESSION['role'] = $_SESSION['role'] ?? 'user';
$homePage = ($_SESSION['role'] == 'admin') ? "/admin_homepage.php" : "/user_homepage.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update User</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <style>
        table { width: 100%; border-collapse: collapse; }
        td { padding: 8px; border: 1px solid #ccc; text-align: left; }
        .btn-container { display: flex; justify-content: space-between; }
    </style>
</head>
<body class="container mt-5">
<div class="d-flex justify-content-between mb-3">
        <a href="<?= $homePage ?>" class="btn btn-primary">Home</a>
        <a href="/logout.php" class="btn btn-danger">Log Out</a>
    </div>

    <h2 class="text-center">User Management</h2>

    <form action="../confirmation.php" method="POST" class="p-4 border rounded">
        <table>
            <tr>
                <td>New User - <input type="radio" name="user_type" value="new"></td>
                <td>Existing User - <input type="radio" name="user_type" value="existing" checked></td>
            </tr>
            <tr>
                <td>Name -</td>
                <td><input type="text" name="name" required></td>
            </tr>
            <tr>
                <td>Status</td>
                <td><input type="checkbox" name="status" value="active"> Active</td>
            </tr>
            <tr>
                <td>Admin</td>
                <td><input type="checkbox" name="admin" value="admin"> Admin</td>
            </tr>
        </table>
        <div class="btn-container mt-3">
            <button type="submit" class="btn btn-primary">Confirm</button>
            <a href="/transaction_cancelled.php" class="btn btn-secondary">Cancel</a>
        </div>
    </form>
</body>
</html>
