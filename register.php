<?php
include('./includes/db.php'); 

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);
    $role = trim($_POST['role']);

    // Hash the password before storing
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    if ($role == "user") {
        $sql = "INSERT INTO users (username, password) VALUES (?, ?)";
    } else {
        $sql = "INSERT INTO admin (username, password) VALUES (?, ?)";
    }

    if ($stmt = mysqli_prepare($conn, $sql)) {
        mysqli_stmt_bind_param($stmt, "ss", $username, $hashed_password);
        if (mysqli_stmt_execute($stmt)) {
            // Redirect to index.php after successful registration
            echo "<script>alert('Registration successful! Redirecting to homepage...'); window.location.href='index.php';</script>";
            exit();
        } else {
            echo "Error: " . mysqli_error($conn);
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
    <title>Register</title>
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
        <h2>Register</h2>
        <form method="POST" action="register.php">
            <input type="text" name="username" placeholder="Username" required>
            <input type="password" name="password" placeholder="Password" required>

            <div class="role-options">
                <input type="radio" id="user" name="role" value="user" required>
                <label for="user">User</label>

                <input type="radio" id="admin" name="role" value="admin">
                <label for="admin">Admin</label>
            </div>

            <button type="submit">Register</button>
        </form>

        <p>Have an account? <a href="index.php">login</a></p>
    </div>
</body>
</html>
