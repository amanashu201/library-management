<?php
session_start();
include('../includes/db.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['book_name'], $_POST['serial_no'])) {
    $_SESSION['pay_fine_data'] = $_POST;
} elseif (isset($_SESSION['pay_fine_data'])) {
    $_POST = $_SESSION['pay_fine_data'];
} else {
    header("Location: return_book.php?error=unauthorized");
    exit();
}

$book_name = $_POST['book_name'] ?? '';
$author_name = $_POST['author_name'] ?? '';
$serial_no = $_POST['serial_no'] ?? '';
$issue_date = $_POST['issue_date'] ?? '';
$return_date = $_POST['return_date'] ?? '';
$remarks = $_POST['remarks'] ?? '';

$fine_amount = 0;
$due_date = new DateTime($issue_date);
$due_date->modify('+14 days');

$returned_date = new DateTime($return_date);
if ($returned_date > $due_date) {
    $interval = $due_date->diff($returned_date);
    $fine_amount = $interval->days * 10;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pay Fine</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>

<body>

    <div class="container mt-5">
        <h3 class="text-center">Pay Fine</h3>
        
        <form action="../maintenance/confirmation.php" method="POST" class="mt-4">
            <div class="mb-3">
                <label class="form-label">Book Name</label>
                <input type="text" name="book_name" class="form-control" value="<?= htmlspecialchars($book_name) ?>" readonly>
            </div>

            

            <div class="mb-3">
                <label class="form-label">Serial No</label>
                <input type="text" name="serial_no" class="form-control" value="<?= htmlspecialchars($serial_no) ?>" readonly>
            </div>

            <div class="mb-3">
                <label class="form-label">Issue Date</label>
                <input type="date" name="issue_date" class="form-control" value="<?= htmlspecialchars($issue_date) ?>" readonly>
            </div>

            <div class="mb-3">
                <label class="form-label">Return Date</label>
                <input type="date" name="return_date" class="form-control" value="<?= htmlspecialchars($return_date) ?>" readonly>
            </div>

            

            <div class="mb-3">
                <label class="form-label">Fine Amount (Rs.)</label>
                <input type="text" name="fine_amount" class="form-control" value="<?= $fine_amount ?>" readonly>
            </div>

            <div class="d-flex justify-content-between">
                <button type="submit" class="btn btn-secondary">Confirm</button>
                <a href="../transaction_cancelled.php" class="btn btn-secondary">Cancel</a>
                <a href="../logout.php" class="btn btn-secondary">Log Out</a>
            </div>
        </form>
    </div>

</body>

</html>
