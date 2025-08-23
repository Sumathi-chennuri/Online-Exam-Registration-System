<?php
session_start();

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <header>
        <h1>Dashboard</h1>
    </header>
    <div class="container">
        <p>Welcome, <?php echo htmlspecialchars($_SESSION['user_email']); ?>!</p>
        <form method="GET" action="examlist.php" style="display: inline;">
            <button type="submit" class="btn">Go to Exam List</button>
        </form>
        <a href="logout.php" class="btn logout">Logout</a> <!-- Logout button -->
    </div>
</body>
</html>
