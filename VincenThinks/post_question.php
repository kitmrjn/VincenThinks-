<?php
// post_question.php

include('db_config.php'); // Include database connection

// Handle form submission for posting questions
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['question'])) {
    $questionText = $_POST['question'];
    $userId = $_SESSION['user_id']; // Use the logged-in user's ID

    // Insert the question into the database
    $stmt = $pdo->prepare("INSERT INTO questions (user_id, title, preview) VALUES (:user_id, :title, :preview)");
    $stmt->execute([
        ':user_id' => $userId,
        ':title' => substr($questionText, 0, 255), // Limit title length
        ':preview' => $questionText
    ]);

    // Redirect to avoid form resubmission
    header('Location: ' . $_SERVER['PHP_SELF']);
    exit;
}
?>