<?php
include('../includes/db.php'); 
session_start();

$_SESSION['role'] = $_SESSION['role'] ?? 'user';
$homePage = ($_SESSION['role'] === 'admin') ? '../admin_homepage.php' : '../user_homepage.php';

$query = "SELECT id AS membership_id, 
                 CONCAT(first_name, ' ', last_name) AS member_name, 
                 contact_number, 
                 contact_address, 
                 aadhar_card_no, 
                 start_date, 
                 end_date, 
                 membership_type
          FROM memberships";

$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Active Memberships</title>
</head>
<body>

    <a href="<?= $homePage ?>">Home</a> | 
    <a href="/logout.php">Log Out</a>

    <h2>List of Active Memberships</h2>

    <table border="1" width="100%" cellspacing="0" cellpadding="5">
        <thead>
            <tr>
                <th>Membership ID</th>
                <th>Name</th>
                <th>Contact</th>
                <th>Address</th>
                <th>Aadhar No</th>
                <th>Start Date</th>
                <th>End Date</th>
                <th>Membership Type</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if ($result && mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<tr>
                        <td>{$row['membership_id']}</td>
                        <td>{$row['member_name']}</td>
                        <td>{$row['contact_number']}</td>
                        <td>{$row['contact_address']}</td>
                        <td>{$row['aadhar_card_no']}</td>
                        <td>{$row['start_date']}</td>
                        <td>{$row['end_date']}</td>
                        <td>{$row['membership_type']}</td>
                    </tr>";
                }
            } else {
                echo "<tr><td colspan='8' align='center'>No active memberships found</td></tr>";
            }
            ?>
        </tbody>
    </table>

    <br>
    <a href="reports.php">Back</a>

</body>
</html>

<?php mysqli_close($conn); ?>
