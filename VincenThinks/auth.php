<?php
session_start();
include('db_config.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $stmt = $pdo->prepare("SELECT * FROM users WHERE username = :username");
    $stmt->execute([':username' => $username]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['username'] = $user['username'];
        $_SESSION['avatar'] = $user['avatar']; // Use pre-assigned avatar

        header('Location: index.php'); // Redirect after login
        exit;
    } else {
        $loginError = "Invalid username or password.";
    }
}

// Logout handling
if (isset($_GET['logout'])) {
    session_destroy();
    header('Location: login.php'); //  Redirect to login after logout
    exit;
}
?>
