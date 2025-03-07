<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION['username']) || $_SESSION['role'] !== "user") {
    header("Location: login.php");
    exit();
}

// Store username safely
$username = isset($_SESSION['username']) ? htmlspecialchars($_SESSION['username']) : "Guest";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Homepage</title>
    <style>
        body {
            text-align: center;
            margin-top: 100px;
        }
        a {
            display: block;
            margin: 10px auto;
            padding: 10px;
            text-decoration: none;
            border: 1px solid black;
            width: 200px;
            text-align: center;
        }
    </style>
</head>

<body>

    <h2>Welcome, <?php echo $username; ?></h2>

    <a href="./reports/reports.php">View Reports</a>
    <a href="./transaction/transaction.php">Manage Transactions</a>
    <a href="logout.php">Logout</a>

</body>

</html>
