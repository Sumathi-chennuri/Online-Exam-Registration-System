<?php
session_start();
include 'db.php';

// Handle logout
if (isset($_POST['logout'])) {
    session_destroy();
    header("Location: login.php");
    exit();
}

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

// Check if payment details exist
if (!isset($_POST['paymentMethod'], $_SESSION['exam_details'])) {
    header("Location: examlist.php");
    exit();
}

$user_id = $_SESSION['user_id'];
$exam_id = $_SESSION['exam_details']['exam_id'];
$cost = $_SESSION['exam_details']['cost'];
$payment_method = $_POST['paymentMethod'];
$payment_status = 'Completed';

// Insert payment record
$sql = "INSERT INTO payments (user_id, exam_id, cost, payment_method, payment_status) VALUES (?, ?, ?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("iidss", $user_id, $exam_id, $cost, $payment_method, $payment_status);

if ($stmt->execute()) {
    unset($_SESSION['exam_details']); // Clear session data after successful payment
} else {
    die("Error in payment processing: " . $stmt->error);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Confirmation</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <header>
        <h1>Confirmation</h1>
    </header>

    <div class="container">
        <h2>Payment Successful!</h2>
        <p><strong>Selected Exam:</strong> <?php echo htmlspecialchars($_POST['subject']); ?></p>
        <p><strong>Cost:</strong> $<?php echo htmlspecialchars($_POST['cost']); ?></p>
        <p><strong>Payment Method:</strong> <?php echo htmlspecialchars($payment_method); ?></p>

        <!-- Correct Logout Button -->
        <form method="POST" action="">
            <button type="submit" name="logout" class="btn">Logout</button>
        </form>
        
        <form method="GET" action="index.php">
            <button type="submit" class="btn">Go to Home</button>
        </form>
    </div>
</body>
</html>
