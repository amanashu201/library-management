<?php
session_start();
if (!isset($_SESSION['username']) || $_SESSION['role'] !== "admin") {
    header("Location: index.php");
    exit();
}

include('./includes/db.php');
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Homepage - Library Management System</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>

    <div class="container mt-5">
        <div class="text-center mb-4">
            <h2 class="fw-bold">Welcome, Admin <?php echo htmlspecialchars($_SESSION['username']); ?>!</h2>
        </div>

        <div class="d-flex flex-wrap justify-content-center gap-3 mb-4">
            <a href="./maintenance/maintenance.php" class="btn border">Maintenance</a>
            <a href="./reports/reports.php" class="btn border">View Reports</a>
            <a href="./transaction/transaction.php" class="btn border">Manage Transactions</a>
            <a href="logout.php" class="btn border">Logout</a>
        </div>
    </div>

</body>

</html>
