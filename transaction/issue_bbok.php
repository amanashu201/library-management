<?php
session_start();
include('../includes/db.php');

// Check database connection
if (!$conn) {
    die("Database connection failed: " . mysqli_connect_error());
}

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = trim($_POST['book_name'] ?? '');
    $date_of_procurement = $_POST['date_of_procurement'] ?? '';
    $quantity = $_POST['quantity'] ?? 1;

    // Basic validation
    if (empty($name) || empty($date_of_procurement)) {
        $_SESSION['error'] = "All fields are required.";
        header("Location: /maintenance/conformation.php");
        exit();
    }

    // Insert into database
    $query = "INSERT INTO issuebook (book_name, date_of_procurement, quantity) VALUES (?, ?, ?)";
    
    if ($stmt = $conn->prepare($query)) {
        $stmt->bind_param("ssi", $name, $date_of_procurement, $quantity);
        
        if ($stmt->execute()) {
            $_SESSION['success'] = "Book issued successfully!";
            header("Location: ../../../confirmation.php");
            exit();
        } else {
            $_SESSION['error'] = "Failed to add book!";
        }
        $stmt->close();
    } else {
        $_SESSION['error'] = "Database error: " . $conn->error;
    }

    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Issue Book</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
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
            max-width: 400px;
            width: 100%;
        }
        .form-control {
            border: none;
            border-bottom: 1px solid #000;
            border-radius: 0;
            background: none;
            outline: none;
            box-shadow: none;
        }
        .form-group {
            display: flex;
            align-items: center;
            gap: 10px;
        }
        .form-group label {
            white-space: nowrap;
        }
        .btn {
            border: none;
            background: none;
            padding: 5px 10px;
            cursor: pointer;
            text-decoration: underline;
        }
        .btn:hover {
            text-decoration: none;
        }
    </style>
</head>
<body>

    <div class="container">
        <h2>Issue Book</h2>

        <!-- Display success or error messages -->
        <?php if (isset($_SESSION['success'])): ?>
            <p style="color: green;"><?php echo $_SESSION['success']; unset($_SESSION['success']); ?></p>
        <?php endif; ?>

        <?php if (isset($_SESSION['error'])): ?>
            <p style="color: red;"><?php echo $_SESSION['error']; unset($_SESSION['error']); ?></p>
        <?php endif; ?>

        <form action="" method="POST">
            <div class="form-group">
                <label>Book Name</label>
                <input type="text" name="book_name" class="form-control" required>
            </div>

            <div class="form-group">
                <label>Date of Procurement</label>
                <input type="date" name="date_of_procurement" class="form-control" required>
            </div>

            <div class="form-group">
                <label>Quantity</label>
                <input type="number" name="quantity" class="form-control" value="1" min="1">
            </div>

            <br>
            <button type="submit" class="btn">Confirm</button>
            <a href="/transaction_cancelled.php" class="btn">Cancel</a>
        </form>
    </div>

</body>
</html>














