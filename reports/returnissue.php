<?php
// Database connection
include('../includes/db.php');
session_start();
$_SESSION['role'] = $_SESSION['role'] ?? 'user';
$homePage = ($_SESSION['role'] === 'admin') ? '../admin_homepage.php' : '../user_homepage.php';

// Fetch returned books data
$query = "SELECT * FROM returned_books";
$result = $conn->query($query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Returned Books</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background-color: #f8f9fa; }
        .container { max-width: 800px; margin-top: 50px; background: white; padding: 20px; border: 1px solid #ddd; }
        table { width: 100%; margin-top: 20px; }
        th, td { padding: 10px; text-align: left; border-bottom: 1px solid #ddd; }
    </style>
</head>
<body>
    <div class="container">
        <h2 class="text-center">Returned Books</h2>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Book Name</th>
                    <th>Serial No</th>
                    <th>Return Date</th>
                    <th>Returned At</th>
                </tr>
            </thead>
            <tbody>
                <?php if ($result->num_rows > 0): ?>
                    <?php while ($row = $result->fetch_assoc()): ?>
                        <tr>
                            <td><?= htmlspecialchars($row['id']); ?></td>
                            <td><?= htmlspecialchars($row['book_name']); ?></td>
                            <td><?= htmlspecialchars($row['serial_no']); ?></td>
                            <td><?= htmlspecialchars($row['return_date']); ?></td>
                            <td><?= htmlspecialchars($row['returned_at']); ?></td>
                        </tr>
                    <?php endwhile; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="5" class="text-center">No returned books found</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
        <a href="<?= htmlspecialchars($homePage) ?>">Home</a>
        <a href="../logout.php">Log Out</a>
    </div>
</body>
</html>

<?php $conn->close(); ?>
