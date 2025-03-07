<?php
session_start();
include('./includes/db.php'); 

// Redirect if already logged in
if (isset($_SESSION['role'])) {
    if ($_SESSION['role'] === "admin") {
        header("Location: admin_homepage.php");
        exit();
    } elseif ($_SESSION['role'] === "user") {
        header("Location: user_homepage.php");
        exit();
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);
    $role = trim($_POST['role']);

    // Choose the correct table
    $table = ($role === "admin") ? "admin" : "users";

    $sql = "SELECT id, password FROM $table WHERE username = ?";
    if ($stmt = mysqli_prepare($conn, $sql)) {
        mysqli_stmt_bind_param($stmt, "s", $username);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_store_result($stmt);

        // Check if user exists
        if (mysqli_stmt_num_rows($stmt) > 0) {
            mysqli_stmt_bind_result($stmt, $id, $hashed_password);
            mysqli_stmt_fetch($stmt);

            // Verify hashed password
            if (password_verify($password, $hashed_password)) {
                // Store session details
                $_SESSION['user_id'] = $id;
                $_SESSION['username'] = $username;
                $_SESSION['role'] = $role;

                // Redirect based on role
                if ($role === "admin") {
                    header("Location: admin_homepage.php");
                } else {
                    header("Location: user_homepage.php");
                }
                exit();
            } else {
                echo "<script>alert('Invalid password!'); window.location.href='login.php';</script>";
            }
        } else {
            echo "<script>alert('User not found!'); window.location.href='login.php';</script>";
        }
        mysqli_stmt_close($stmt);
    } else {
        echo "Database error: " . mysqli_error($conn);
    }

    mysqli_close($conn);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <style>
        body {
            text-align: center;
            margin-top: 100px;
            font-family: Arial, sans-serif;
        }
        .container {
            width: 300px;
            margin: auto;
            padding: 20px;
            border: 1px solid black;
        }
        input, button {
            width: 100%;
            margin: 5px 0;
            padding: 8px;
        }
        .role-options {
            display: flex;
            justify-content: space-between;
        }
        .role-options label {
            flex: 1;
            text-align: center;
            cursor: pointer;
        }
    </style>
</head>

<body>
    <div class="container">
        <h2>Login</h2>
        <form method="POST" action="login.php">
            <input type="text" name="username" placeholder="Username" required>
            <input type="password" name="password" placeholder="Password" required>

            <div class="role-options">
                <input type="radio" id="user" name="role" value="user" required>
                <label for="user">User</label>

                <input type="radio" id="admin" name="role" value="admin">
                <label for="admin">Admin</label>
            </div>

            <button type="submit">Login</button>
        </form>

        <p>Don't have an account? <a href="register.php">Register</a></p>
    </div>
</body>
</html>
