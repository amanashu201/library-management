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
    <title>Update Membership</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>

<body class="container mt-5">
    <div class="d-flex justify-content-between mb-3">
        <a href="<?= $homePage ?>" class="btn btn-primary">Home</a>
        <a href="/logout.php" class="btn btn-danger">Log Out</a>
    </div>
    <h2 class="text-center">Update Membership</h2>

    <form action="../confirmation.php" method="POST" class="p-4 border rounded">
        <div class="mb-3">
            <label>Membership Number</label>
            <input type="number" name="membership_id" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Start Date</label>
            <input type="date" name="start_date" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>End Date</label>
            <input type="date" name="end_date" class="form-control" required>
        </div>

        <label>Membership Extension:</label>
        <div class="mb-3">
            <input type="radio" name="membership_extn" value="six months" required> Six Months
            <input type="radio" name="membership_extn" value="one year" required> One Year
            <input type="radio" name="membership_extn" value="two years" required> Two Years
        </div>

        <div class="mb-3">
            <label>Remove Membership</label>
            <input type="checkbox" name="membership_remove" value="yes">
        </div>

        <button type="submit">Confirm</button>
        <a href="/transaction_cancelled.php">Cancel</a>
    </form>

</body>

</html>