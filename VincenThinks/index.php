<?php
include('auth.php');         // Handle user authentication
include('post_question.php'); // Handle question posting
include('fetch_questions.php'); // Fetch the questions to display


if (!isset($_SESSION['user_id'])) {
    header("Location: login.php"); // Redirect if user is not logged in
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>VincenThinks</title>
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
        <div class="search-bar">
            <i class="fas fa-search search-icon"></i>
            <input type="text" placeholder="Search questions...">
        </div>
        <nav>
            <a href="#">Home</a>
            <a href="#">Ask a Question</a>
            <a href="#">My Profile</a>
            <a href="?logout=true">Logout</a>
        </nav>
    </header>

    <!-- Post Question Section -->
    <section class="post-question">
        <form method="POST" action="">
            <textarea name="question" placeholder="Ask a question..." rows="4" required></textarea>
            <button type="submit">Post Question</button>
        </form>
    </section>

    <!-- Recent Questions Section -->
    <section class="recent-questions">
        <h2>Recent Questions</h2>
        <?php foreach ($questions as $question): ?>
            <div class="question">
                <div class="question-header">
                    <img src="<?php echo htmlspecialchars($question['avatar']); ?>" alt="<?php echo htmlspecialchars($question['username']); ?>" class="avatar">
                    <div class="question-info">
                        <h3><?php echo htmlspecialchars($question['title']); ?></h3>
                        <p class="timestamp">Asked <?php echo htmlspecialchars($question['created_at']); ?></p>
                    </div>
                </div>
                <p class="answer-preview"><?php echo htmlspecialchars($question['preview']); ?></p>
                <button class="answer-button">Answer</button>
            </div>
        <?php endforeach; ?>
    </section>

    <footer>
        <p>&copy; <?php echo date('Y'); ?> VincenThinks. All rights reserved.</p>
    </footer>
</body>
</html>
