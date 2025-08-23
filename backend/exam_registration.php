<?php
session_start();
include 'db.php'; // Ensure database connection

// Check if exam details are received
if (!isset($_POST['exam_id'], $_POST['subject'], $_POST['fee'])) {
    header("Location: examlist.php");
    exit();
}

// Store exam details in session
$_SESSION['exam_details'] = [
    'id' => $_POST['exam_id'],
    'subject' => $_POST['subject'],
    'fee' => $_POST['fee']
];

// Redirect to payment page
header("Location: payment.php");
exit();
?>
