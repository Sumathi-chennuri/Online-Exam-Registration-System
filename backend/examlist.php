<?php
session_start();
include 'db.php';

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

// Fetch exams from database
$sql = "SELECT id, subject, cost FROM exams";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Exam List</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <header>
        <h1>Select an Exam</h1>
    </header>
    <div class="container">
        <ul id="examList">
            <?php while ($row = $result->fetch_assoc()): ?>
                <li>
                    <form method="POST" action="payment.php">
                        <input type="hidden" name="exam_id" value="<?php echo $row['id']; ?>">
                        <input type="hidden" name="subject" value="<?php echo htmlspecialchars($row['subject']); ?>">
                        <input type="hidden" name="cost" value="<?php echo htmlspecialchars($row['cost']); ?>">
                        <button type="submit" class="exam-btn">
                            <?php echo htmlspecialchars($row['subject']); ?> - $<?php echo htmlspecialchars($row['cost']); ?>
                        </button>
                    </form>
                </li>
            <?php endwhile; ?>
        </ul>
        <p><a href="dashboard.php" class="btn">Back to Dashboard</a></p>
    </div>
</body>
</html>
