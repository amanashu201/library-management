<?php
session_start();
include(__DIR__ . '/../../includes/db.php'); // Database connection

$_SESSION['role'] = $_SESSION['role'] ?? 'user';
$homePage = ($_SESSION['role'] == 'admin') ? "/admin_homepage.php" : "/user_homepage.php";

$error = "";

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = trim($_POST['name']);
    $user_type = $_POST['user_type'];
    $status = isset($_POST['status']) ? 'active' : 'inactive';
    $is_admin = isset($_POST['admin']) ? 1 : 0;

    // Validate required fields
    if (empty($name) || empty($user_type)) {
        $error = "Name and User Type are required!";
    } else {
        $query = "INSERT INTO add_user (name, user_type, status, is_admin) VALUES (?, ?, ?, ?)";
        if ($stmt = $conn->prepare($query)) {
            $stmt->bind_param("sssi", $name, $user_type, $status, $is_admin);
            if ($stmt->execute()) {
                header("Location: ../confirmation.php");
                exit();
            } else {
                $error = "Failed to add user!";
            }
            $stmt->close();
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Management</title>
    <style>
        body {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            height: 100vh;
            margin: 0;
            font-family: Arial, sans-serif;
        }
        .container {
            width: 100%;
            max-width: 400px;
        }
        form {
            display: flex;
            flex-direction: column;
            gap: 10px;
        }
        label {
            display: block;
            margin-bottom: 5px;
        }
        input {
            border: none;
            border-bottom: 1px solid #000;
            background: none;
            outline: none;
            padding: 5px;
            width: 100%;
        }
        .form-group {
            display: flex;
            flex-direction: column;
            gap: 5px;
        }
        .btn {
            background: none;
            border: none;
            text-decoration: underline;
            cursor: pointer;
            padding: 5px;
        }
        .btn:hover {
            text-decoration: none;
        }
    </style>
</head>

<body>

    <div class="container">
        <h2>User Management</h2>

        <?php if (!empty($error)): ?>
            <p style="color: red;"><?= $error ?></p>
        <?php endif; ?>

        <form method="post">
            <div class="form-group">
                <label>User Type</label>
                <input type="radio" name="user_type" value="new" required> New User
                <input type="radio" name="user_type" value="existing" required> Existing User
            </div>

            <div class="form-group">
                <label>Name</label>
                <input type="text" name="name" required>
            </div>

            <div class="form-group">
                <label>Status</label>
                <input type="checkbox" name="status" value="active"> Active
            </div>

            <div class="form-group">
                <label>Admin</label>
                <input type="checkbox" name="admin" value="1"> Admin
            </div>

            <button type="submit" class="btn">Confirm</button>
            <a href="/transaction_cancelled.php" class="btn">Cancel</a>
        </form>
    </div>

</body>

</html>

<?php $conn->close(); ?>
