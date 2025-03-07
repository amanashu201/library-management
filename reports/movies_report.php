<?php
include('../includes/db.php'); 
$_SESSION['role'] = $_SESSION['role'] ?? 'user'; 

$homePage = ($_SESSION['role'] === 'admin') ? '../admin_homepage.php' : '../user_homepage.php';
// $sql = "SELECT * FROM movies";
// $result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Master List of Movies</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .container { margin-top: 30px; }
        .table { margin-top: 20px; }
        .btn-logout { margin-top: 20px; }
    </style>
</head>
<body>
<div class="d-flex justify-content-between mb-3">
        <a href="<?= $homePage ?>" class="btn btn-primary">Home</a>
        <a href="/logout.php" class="btn btn-danger">Log Out</a>
    </div>

<div class="container">
    <h2 class="text-center">Master List of Movies</h2>
    <table class="table table-bordered">
        <thead class="table-dark">
            <tr>
                <th>Serial No</th>
                <th>Name of Movie</th>
                <th>Author Name</th>
                <th>Category</th>
                <th>Status</th>
                <th>Cost</th>
                <th>Procurement Date</th>
            </tr>
        </thead>
        <!-- <tbody>
            <?php
            if ($result && mysqli_num_rows($result) > 0) {
                $serial = 1;
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<tr>
                        <td>{$serial}</td>
                        <td>{$row['movie_name']}</td>
                        <td>{$row['author_name']}</td>
                        <td>{$row['category']}</td>
                        <td>{$row['status']}</td>
                        <td>{$row['cost']}</td>
                        <td>{$row['procurement_date']}</td>
                    </tr>";
                    $serial++;
                }
            } else {
                echo "<tr><td colspan='7' class='text-center'>No movies found</td></tr>";
            }
            ?>
        </tbody> -->
    </table>
    <a href="reports.php" class="btn btn-secondary back-btn">Back</a>
    <!-- Back and Logout Buttons -->
</div>

</body>
</html>

<?php mysqli_close($conn); ?>  <!-- Close DB connection -->
