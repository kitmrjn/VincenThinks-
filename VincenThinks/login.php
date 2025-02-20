<?php
include('auth.php');
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

    <section class="auth-form">
        <h2>Login</h2>

        <?php if (isset($loginError)): ?>
            <p style="color: red;"><?php echo $loginError; ?></p>
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
