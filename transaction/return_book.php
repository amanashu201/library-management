<?php
// Database connection
include('../includes/db.php');
session_start();
$_SESSION['role'] = $_SESSION['role'] ?? 'user';
$homePage = ($_SESSION['role'] === 'admin') ? '../admin_homepage.php' : '../user_homepage.php';

// Fetch books for dropdown
$book_query = "SELECT DISTINCT book_name FROM books";
$book_result = $conn->query($book_query);

// Fetch serial numbers
$serial_query = "SELECT id FROM books";
$serial_result = $conn->query($serial_query);

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $book_name = trim($_POST['book_name'] ?? '');
    $serial_no = intval($_POST['serial_no'] ?? 0);
    $return_date = $_POST['return_date'] ?? '';

    // Validation: Ensure all required fields are filled
    if (empty($book_name) || empty($serial_no) || empty($return_date)) {
        $_SESSION['error'] = "All fields are required!";
    } else {
        // Insert return book data
        $query = "INSERT INTO returned_books (book_name, serial_no, return_date) VALUES (?, ?, ?)";
        if ($stmt = $conn->prepare($query)) {
            $stmt->bind_param("sis", $book_name, $serial_no, $return_date);
            
            if ($stmt->execute()) {
                $_SESSION['success'] = "Book returned successfully!";
            } else {
                $_SESSION['error'] = "Failed to return book!";
            }
            $stmt->close();
        } else {
            $_SESSION['error'] = "Database error: " . $conn->error;
        }
    }
    header("Location: return_book.php"); // Redirect back
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Return Book</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background-color: #f8f9fa; }
        .container { max-width: 500px; margin-top: 50px; background: white; padding: 20px; border: 1px solid #ddd; }
        select, input, button, a { width: 100%; margin-top: 10px; padding: 8px; border: 1px solid #ccc; }
    </style>
</head>
<body>
    <div class="container">
        <h2 class="text-center">Return Book</h2>

        <!-- Display success or error messages -->
        <?php if (isset($_SESSION['success'])): ?>
            <p style="color: green;"> <?php echo $_SESSION['success']; unset($_SESSION['success']); ?> </p>
        <?php endif; ?>
        <?php if (isset($_SESSION['error'])): ?>
            <p style="color: red;"> <?php echo $_SESSION['error']; unset($_SESSION['error']); ?> </p>
        <?php endif; ?>

        <form action="" method="POST">
            <label>Enter Book Name:</label>
            <select name="book_name" required>
                <option value="">Select a Book</option>
                <?php while ($row = $book_result->fetch_assoc()): ?>
                    <option value="<?= htmlspecialchars($row['book_name']); ?>"> <?= htmlspecialchars($row['book_name']); ?> </option>
                <?php endwhile; ?>
            </select>

            <label>Serial No:</label>
            <select name="serial_no" required>
                <option value="">Select Serial No</option>
                <?php while ($row = $serial_result->fetch_assoc()): ?>
                    <option value="<?= htmlspecialchars($row['id']); ?>"> <?= htmlspecialchars($row['id']); ?> </option>
                <?php endwhile; ?>
            </select>

            <label>Return Date:</label>
            <input type="date" name="return_date" required>

            <button type="submit">Confirm</button>
            <a href="../transaction_cancelled.php">Cancel</a>
            <a href="<?= htmlspecialchars($homePage) ?>">Home</a>
            <a href="../logout.php">Log Out</a>
        </form>
    </div>
</body>
</html>

<?php $conn->close(); ?>