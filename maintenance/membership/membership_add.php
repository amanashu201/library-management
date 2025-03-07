<?php
session_start();
include(__DIR__ . '/../../includes/db.php'); // Database connection

$_SESSION['role'] = $_SESSION['role'] ?? 'user';
$homePage = ($_SESSION['role'] == 'admin') ? "/admin_homepage.php" : "/user_homepage.php";

$error = "";

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $first_name = trim($_POST['first_name']);
    $last_name = trim($_POST['last_name']);
    $contact_number = trim($_POST['contact_number']);
    $contact_address = trim($_POST['contact_address']);
    $aadhar_card_no = trim($_POST['aadhar_card_no']);
    $start_date = $_POST['start_date'];
    $end_date = $_POST['end_date'];
    $membership_type = $_POST['membership_type'];

    // Validate required fields
    if (empty($first_name) || empty($last_name) || empty($contact_number) || empty($contact_address) || empty($aadhar_card_no) || empty($start_date) || empty($end_date) || empty($membership_type)) {
        $error = "All fields are required!";
    } else {
        // Insert into database
        $query = "INSERT INTO memberships (first_name, last_name, contact_number, contact_address, aadhar_card_no, start_date, end_date, membership_type) 
                  VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
        if ($stmt = $conn->prepare($query)) {
            $stmt->bind_param("ssssssss", $first_name, $last_name, $contact_number, $contact_address, $aadhar_card_no, $start_date, $end_date, $membership_type);
            if ($stmt->execute()) {
                header("Location: ../confirmation.php");
                exit();
            } else {
                $error = "Failed to add membership!";
            }
            $stmt->close();
        }
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Membership</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
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
            text-align: center;
        }
        .form-control, .form-check-input {
            border: none;
            border-bottom: 1px solid #000;
            border-radius: 0;
            background: none;
            outline: none;
            box-shadow: none;
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
        <h2>Add Membership</h2>

        <?php if (!empty($error)): ?>
            <p><?= $error ?></p>
        <?php endif; ?>

        <form method="post">
            <label>First Name</label>
            <input type="text" class="form-control" name="first_name" required>

            <label>Last Name</label>
            <input type="text" class="form-control" name="last_name" required>

            <label>Contact Number</label>
            <input type="text" class="form-control" name="contact_number" required>

            <label>Contact Address</label>
            <textarea class="form-control" name="contact_address" rows="2" required></textarea>

            <label>Aadhar Card No</label>
            <input type="text" class="form-control" name="aadhar_card_no" required>

            <label>Start Date</label>
            <input type="date" class="form-control" name="start_date" required>

            <label>End Date</label>
            <input type="date" class="form-control" name="end_date" required>

            <label>Membership Duration</label><br>
            <input type="radio" name="membership_type" value="Six Months" required> Six Months
            <input type="radio" name="membership_type" value="One Year" required> One Year
            <input type="radio" name="membership_type" value="Two Years" required> Two Years

            <br><br>
            <button type="submit" class="btn">Confirm</button>
            <a href="/transaction_cancelled.php" class="btn">Cancel</a>
        </form>
    </div>

</body>

</html>

<?php $conn->close(); ?>
