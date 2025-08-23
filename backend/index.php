<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <header>
        <h1>Online Exam Registration System</h1>
    </header>
    <div class="container">
        <?php if (isset($_SESSION['user_id'])): ?>
            <p>Welcome back! You are logged in.</p>
            <a href="dashboard.php"><button class="btn">Go to Dashboard</button></a>
            <form method="POST" action="logout.php" style="display: inline;">
                <button type="submit" name="logout" class="btn logout">Logout</button>
            </form>
        <?php else: ?>
            <p>Choose one:</p>
            <a href="register.php"><button class="btn">Register</button></a>
            <a href="login.php"><button class="btn">Login</button></a>
        <?php endif; ?>
    </div>

    <script src="script.js"></script>
</body>
</html>
