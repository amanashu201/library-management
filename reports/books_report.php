<?php
include('../includes/db.php');
session_start();

$_SESSION['role'] = $_SESSION['role'] ?? 'user';
$homePage = ($_SESSION['role'] === 'admin') ? '../admin_homepage.php' : '../user_homepage.php';

$sql = "SELECT id, book_name, date_of_procurement, quantity FROM books";
$result = mysqli_query($conn, $sql);

if (!$result) {
    die("Query failed: " . mysqli_error($conn));
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Master List of Books</title>
    <style>
        body {
            height: 100vh;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            margin: 0;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th, td {
            border: 1px solid black;
            padding: 10px;
            text-align: left;
        }
    </style>
</head>

<body>

    <div style="width: 100%; text-align: left; padding: 10px;">
        <a href="<?= $homePage ?>">Home</a> | 
        <a href="/logout.php">Log Out</a>
    </div>

    <h2>Master List of Books</h2>

    <table>
        <thead>
            <tr>
                <th>Serial No</th>
                <th>Name of Book</th>
                <th>Date of Procurement</th>
                <th>Quantity</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if (mysqli_num_rows($result) > 0) {
                $serial_no = 1;
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<tr>
                        <td>{$serial_no}</td>
                        <td>" . htmlspecialchars($row['book_name']) . "</td>
                        <td>" . htmlspecialchars($row['date_of_procurement']) . "</td>
                        <td>" . htmlspecialchars($row['quantity']) . "</td>
                    </tr>";
                    $serial_no++;
                }
            } else {
                echo "<tr><td colspan='4' style='text-align:center;'>No records found</td></tr>";
            }
            ?>
        </tbody>
    </table>

    <br>
    <a href="reports.php">Back</a>

</body>
</html>
