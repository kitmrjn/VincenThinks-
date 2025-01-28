<?php
// Include the authentication logic or any necessary PHP file
// You can include your auth.php here for handling registration logic
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Registration logic will go here (handle form submission)
    if (isset($_POST['register'])) {
        // Assuming you have a function to handle registration
        // Use this block for your registration logic (validate, insert into database)
        $username = $_POST['username'];
        $password = $_POST['password'];
        $confirm_password = $_POST['confirm_password'];

        // You can add password validation or check if passwords match
        if ($password === $confirm_password) {
            // Proceed with saving the user to the database
            // For example, include your database connection and registration logic
            include('auth.php');  // Or you can directly handle it here

            // Redirect after successful registration (optional)
            header("Location: login.php");
            exit;
        } else {
            // Display an error message if passwords don't match
            $error = "Passwords do not match!";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - VincenThinks</title>
    <link rel="stylesheet" href="styles/user-interface.css"> <!-- Path to your CSS file -->
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

    <!-- Registration Form -->
    <section class="auth-form">
        <h2>Register</h2>

        <!-- Show error message if passwords don't match -->
        <?php if (isset($error)): ?>
            <p style="color: red;"><?php echo $error; ?></p>
        <?php endif; ?>

        <form action="register.php" method="POST">
            <div>
                <label for="username">Username</label>
                <input type="text" id="username" name="username" required>
            </div>
            <div>
                <label for="password">Password</label>
                <input type="password" id="password" name="password" required>
            </div>
            <div>
                <label for="confirm_password">Confirm Password</label>
                <input type="password" id="confirm_password" name="confirm_password" required>
            </div>
            <button type="submit" name="register">Register</button>
        </form>

        <p>Already have an account? <a href="login.php">Login here</a></p>
    </section>

    <footer>
        <p>&copy; <?php echo date('Y'); ?> VincenThinks. All rights reserved.</p>
    </footer>
</body>
</html>
