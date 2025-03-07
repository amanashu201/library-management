<?php
session_start();

$_SESSION['role'] = $_SESSION['role'] ?? 'user';
$homePage = ($_SESSION['role'] == 'admin') ? "/admin_homepage.php" : "/user_homepage.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Book/Movie</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body class="container mt-5">
<div class="d-flex justify-content-between mb-3">
        <a href="<?= $homePage ?>" class="btn btn-primary">Home</a>
        <a href="/logout.php" class="btn btn-danger">Log Out</a>
    </div>
    <h2 class="text-center">Update Book/Movie</h2>

    <form action="/maintenance/confirmation.php" method="POST" class="p-4 border rounded">
        <div class="mb-3">
            <label>Type</label> <br>
            <input type="radio" name="type" value="book" required> Book
            <input type="radio" name="type" value="movie" required> Movie
        </div>

        <div class="mb-3">
            <label>Book/Movie Name</label>
            <input type="text" name="name" class="form-control" required>
               
            </select>
        </div>

        <div class="mb-3">
            <label>Serial No</label>
            <input type="text" name="serial_no" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Status</label>
            <select name="status" class="form-control" required>
                <option value="Available">Available</option>
                <option value="Issued">Issued</option>
                <option value="Damaged">Damaged</option>
            </select>
        </div>

        <div class="mb-3">
            <label>Date</label>
            <input type="date" name="date" >
        </div>
        <button type="submit">Confirm</button>
        <a href="/transaction_cancelled.php">Cancel</a>
    </form>
</body>