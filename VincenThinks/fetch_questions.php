<?php
include('db_config.php'); // Include database connection

// Fetch questions from the database
$stmt = $pdo->query("SELECT questions.*, users.username, users.avatar 
    FROM questions 
    JOIN users ON questions.user_id = users.id 
    ORDER BY questions.created_at DESC");
$questions = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
