<?php
session_start();
include('../includes/db.php');

$_SESSION['role'] = $_SESSION['role'] ?? 'user';
$homePage = ($_SESSION['role'] === 'admin') ? '../admin_homepage.php' : '../user_homepage.php';

// Fetch unique book names
$booksQuery = "SELECT DISTINCT book_name FROM books";
$booksResult = $conn->query($booksQuery);

// Check if 'author_name' exists in 'books' table
$authorColumnExists = $conn->query("SHOW COLUMNS FROM books LIKE 'author_name'")->num_rows > 0;

$authorsResult = null;
if ($authorColumnExists) {
    // Fetch unique authors if column exists
    $authorsQuery = "SELECT DISTINCT author_name FROM books";
    $authorsResult = $conn->query($authorsQuery);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book Availability</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .container {
            max-width: 500px;
            margin-top: 50px;
            background: white;
            padding: 20px;
            border: 1px solid #ddd;
        }
        select, button, a {
            width: 100%;
            margin-top: 10px;
        }
    </style>
</head>
<body>

    <div class="container">
        <h2 class="text-center">Search Books</h2>

        <form action="./search.php" method="GET">
            <label>Select Book:</label>
            <select name="book_name" class="form-select">
                <option value="">Any Book</option>
                <?php while ($row = $booksResult->fetch_assoc()) { ?>
                    <option value="<?= htmlspecialchars($row['book_name']); ?>">
                        <?= htmlspecialchars($row['book_name']); ?>
                    </option>
                <?php } ?>
            </select>

            <?php if ($authorColumnExists && $authorsResult) { ?>
                <label>Select Author:</label>
                <select name="author" class="form-select">
                    <option value="">Any Author</option>
                    <?php while ($row = $authorsResult->fetch_assoc()) { ?>
                        <option value="<?= htmlspecialchars($row['author_name']); ?>">
                            <?= htmlspecialchars($row['author_name']); ?>
                        </option>
                    <?php } ?>
                </select>
            <?php } ?>

            <button type="submit" class="btn btn-light border">Search</button>
            <a href="javascript:history.back()" class="btn btn-light border">Back</a>
            <a href="<?= htmlspecialchars($homePage) ?>" class="btn btn-light border">Home</a>
            <a href="../logout.php" class="btn btn-light border">Log Out</a>
        </form>
    </div>

</body>
</html>

<?php $conn->close(); ?>
