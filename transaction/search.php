<?php
session_start();
include('../includes/db.php');

$_SESSION['role'] = $_SESSION['role'] ?? 'user';
$homePage = ($_SESSION['role'] === 'admin') ? '../admin_homepage.php' : '../user_homepage.php';

$book_name = $_GET['book_name'] ?? '';

$query = "SELECT id, book_name, quantity FROM books WHERE 1=1";
$params = [];

if (!empty($book_name)) {
    $query .= " AND book_name = ?";
    $params[] = $book_name;
}

$stmt = $conn->prepare($query);

if ($params) {
    $stmt->bind_param(str_repeat("s", count($params)), ...$params);
}

$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book Availability</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid black; padding: 10px; text-align: center; }
        th { background-color: #f0f0f0; }
    </style>
</head>
<body>

<div>
    <a href="<?= htmlspecialchars($homePage) ?>">Home</a> | 
    <a href="../logout.php">Log Out</a>
</div>

<h2>Book Availability</h2>

<form action="./issue_book.php" method="POST">
    <table>
        <thead>
            <tr>
                <th>Book Name</th>
                <th>Quantity</th>
                <th>Select</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = $result->fetch_assoc()) { ?>
                <tr>
                    <td><?= htmlspecialchars($row['book_name']) ?></td>
                    <td><?= htmlspecialchars($row['quantity']) ?></td>
                    <td>
                        <?php if ($row['quantity'] > 0) { ?>
                            <input type="radio" name="selected_book" value="<?= $row['id'] ?>" required>
                        <?php } else { ?>
                            <span>Not Available</span>
                        <?php } ?>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>

    <div style="margin-top: 20px;">
        <button type="submit">Issue</button>
        <a href="../transaction_cancelled.php">Cancel</a>
    </div>
</form>

</body>
</html>

<?php 
$stmt->close();
?>
