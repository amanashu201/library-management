<?php
session_start();
session_unset(); // Remove all session variables
session_destroy(); // Destroy the session
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Logout</title>
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

    <h2>You have successfully logged out.</h2>
    <a href="/index.php">Log In</a>

</body>

</html>
