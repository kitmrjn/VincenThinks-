<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['login'])) {
        $username = $_POST['username'];
        $password = $_POST['password'];

        // Include database connection
        include('db_config.php');

        // Prepare query to check if the username exists
        $stmt = $pdo->prepare("SELECT * FROM users WHERE username = :username");
        $stmt->execute([':username' => $username]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        // Check if user exists
        if ($user) {
            // Verify password
            if (password_verify($password, $user['password'])) {
                // Password is correct, log the user in
                $_SESSION['user_id'] = $user['id']; // or use whatever column represents the unique user ID
                $_SESSION['username'] = $user['username'];

                // Redirect to the main page (index.php)
                header("Location: index.php"); 
                exit;
            } else {
                // Invalid password
                $error = "Invalid username or password.";
            }
        } else {
            // Invalid username
            $error = "Invalid username or password.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - VincenThinks</title>
    <link rel="stylesheet" href="styles/user-interface.css">
</head>
<body>
    <header>
        <a href="index.php" class="logo-link">
            <div class="logo">
                <img src="images/svcc.jpg" alt="VincentThinks Logo" class="nav-logo">
                <h1>VincenThinks</h1>
            </div>
        </a>
        <nav>
            <a href="login.php">Login</a>
            <a href="register.php">Register</a>
        </nav>
    </header>

    <!-- Login Form -->
    <section class="auth-form">
        <h2>Login</h2>

        <!-- Show error message -->
        <?php if (isset($error)): ?>
            <p style="color: red;"><?php echo $error; ?></p>
        <?php endif; ?>

        <form action="login.php" method="POST">
            <div>
                <label for="username">Username</label>
                <input type="text" id="username" name="username" required>
            </div>
            <div>
                <label for="password">Password</label>
                <input type="password" id="password" name="password" required>
            </div>
            <button type="submit" name="login">Login</button>
        </form>

        <p>Don't have an account? <a href="register.php">Register here</a></p>
    </section>

    <footer>
        <p>&copy; <?php echo date('Y'); ?> VincenThinks. All rights reserved.</p>
    </footer>
</body>
</html>
