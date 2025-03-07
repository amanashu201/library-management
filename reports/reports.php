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
    <title>Reports Dashboard</title>
    <style>
        body {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            height: 100vh;
            font-family: Arial, sans-serif;
            margin: 0;
        }
        .container {
            width: 100%;
            max-width: 400px;
            text-align: center;
        }
        a {
            display: block;
            margin: 10px 0;
            text-decoration: none;
            font-size: 18px;
        }
        .top-links {
            display: flex;
            justify-content: space-between;
            width: 100%;
            max-width: 400px;
            margin-bottom: 20px;
        }
    </style>
</head>

<body>

    <div class="top-links">
        <a href="<?= htmlspecialchars($homePage) ?>">Home</a>
        <a href="../logout.php">Log Out</a>
    </div>

    <div class="container">
        <h2>Available Reports</h2>
        <a href="books_report.php">Master List of Books</a>
        <a href="./membership_report.php">Master List of Memberships</a>
        <a href="active_issues.php">Active Issues</a>
        <!-- <a href="overdue_returns.php">Overdue Returns</a> -->
        <!-- <a href="./pending_request.php">Pending Issue Requests</a> -->
    </div>

</body>

</html>
