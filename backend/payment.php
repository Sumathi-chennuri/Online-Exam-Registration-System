<?php
session_start();

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

// Check if exam details are passed from examlist.php
if (!isset($_POST['exam_id'], $_POST['subject'], $_POST['cost'])) {
    header("Location: examlist.php");
    exit();
}

// Store exam details in session
$_SESSION['exam_details'] = [
    'exam_id' => $_POST['exam_id'],
    'subject' => $_POST['subject'],
    'cost' => $_POST['cost']
];

$exam_details = $_SESSION['exam_details'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <header>
        <h1>Payment</h1>
    </header>
    <div class="container">
        <p><strong>Selected Exam:</strong> <?php echo htmlspecialchars($exam_details['subject']); ?></p>
        <p><strong>Cost:</strong> $<?php echo htmlspecialchars($exam_details['cost']); ?></p>

        <form method="POST" action="confirmation.php">
            <label for="paymentMethod">Choose a payment method:</label>
            <select name="paymentMethod" id="paymentMethod" required>
                <option value="Credit Card">Credit Card</option>
                <option value="Debit Card">Debit Card</option>
                <option value="PayPal">PayPal</option>
                <option value="Net Banking">Net Banking</option>
            </select>

            <input type="hidden" name="exam_id" value="<?php echo htmlspecialchars($exam_details['exam_id']); ?>">
            <input type="hidden" name="subject" value="<?php echo htmlspecialchars($exam_details['subject']); ?>">
            <input type="hidden" name="cost" value="<?php echo htmlspecialchars($exam_details['cost']); ?>">
            <button type="submit" class="btn">Proceed to Confirmation</button>
        </form>
        
        <p><a href="examlist.php" class="btn">Back to Exam List</a></p>
    </div>
</body>
</html>
