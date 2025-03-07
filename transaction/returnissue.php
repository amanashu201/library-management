<?php
include('../includes/db.php'); 
session_start();
$_SESSION['role'] = $_SESSION['role'] ?? 'user';
$homePage = ($_SESSION['role'] === 'admin') ? '../admin_homepage.php' : '../user_homepage.php';

// Corrected SQL Query
$sql = "SELECT id, book_name, serial_no, return_date, returned_at FROM returned_books";
$result = mysqli_query($conn, $sql);

// Debugging: Check if query runs successfully
if (!$result) {
    die("SQL Error: " . mysqli_error($conn));
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Issued Books</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid black; padding: 10px; text-align: left; }
    </style>
</head>
<body>

    <a href="<?= $homePage ?>">Home</a> | 
    <a href="/logout.php">Log Out</a>

    <h2>Issued Books Report</h2>

    <table>
        <thead>
            <tr>
                <th>#</th>
                <th>Book Name</th>
                <th>Serial NO</th>
                <th>Return Date</th>
                <th>Returned At</th> <!-- Fixed column name -->
            </tr>
        </thead>
        <tbody>
            <?php
            $serial_no = 1;
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<tr>
                    <td>{$serial_no}</td>
                    <td>" . htmlspecialchars($row['book_name']) . "</td>
                    <td>" . htmlspecialchars($row['serial_no']) . "</td>
                    <td>" . htmlspecialchars($row['return_date']) . "</td>
                    <td>" . htmlspecialchars($row['returned_at']) . "</td>
                </tr>";
                $serial_no++;
            }
            if ($serial_no == 1) {
                echo "<tr><td colspan='5' style='text-align:center;'>No books issued</td></tr>";
            }
            ?>
        </tbody>
    </table>

    <br>
    <a href="reports.php">Back</a>

</body>
</html>

<?php mysqli_close($conn); ?>
