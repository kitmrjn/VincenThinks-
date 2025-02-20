<?php
include('db_config.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['register'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];
    $gender = $_POST['gender']; // Get gender from form input

    // Check if passwords match
    if ($password !== $confirm_password) {
        $error = "Passwords do not match!";
    } else {
        // Hash the password
        $password = password_hash($password, PASSWORD_DEFAULT);

        // Assign profile picture based on gender
        $avatar = ($gender === 'male') ? 'male-avatar.png' : 'female-avatar.png';

        // Insert user into the database
        $stmt = $pdo->prepare("INSERT INTO users (username, password, gender, avatar) VALUES (:username, :password, :gender, :avatar)");
        $stmt->execute([
            ':username' => $username,
            ':password' => $password,
            ':gender' => $gender,
            ':avatar' => $avatar
        ]);

        // Redirect to login page
        header('Location: login.php');
        exit;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - VincenThinks</title>
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
        <h2>Register</h2>

        <?php if (isset($error)): ?>
            <p style="color: red;"><?php echo $error; ?></p>
        <?php endif; ?>

        <form action="register.php" method="POST">
            <input type="text" name="username" placeholder="Username" required>
            <input type="password" name="password" placeholder="Password" required>
            <input type="password" name="confirm_password" placeholder="Confirm Password" required>

            <label for="gender">Gender:</label>
            <select name="gender" required>
                <option value="male">Male</option>
                <option value="female">Female</option>
            </select>

            <button type="submit" name="register">Register</button>
        </form>

        <p>Already have an account? <a href="login.php">Login here</a></p>
    </section>

    <footer>
        <p>&copy; <?php echo date('Y'); ?> VincenThinks. All rights reserved.</p>
    </footer>
</body>
</html>