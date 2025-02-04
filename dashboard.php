<?php
session_start();
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("Location: login.php");
    exit;
}

$host = 'localhost';
$db_name = 'db6kkyglj5qwgi';
$username = 'ul8rz3mz2i4mp';
$password = 'eayo5amdaudv';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$db_name", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    echo "Database connection successful!<br>";

    // Fetch articles
    $stmt = $pdo->query("SELECT id, title, content FROM articles");
    $articles = $stmt->fetchAll(PDO::FETCH_ASSOC);

    if ($articles) {
        foreach ($articles as $article) {
            echo "<h2>" . htmlspecialchars($article['title']) . "</h2>";
            echo "<p>" . htmlspecialchars($article['content']) . "</p>";
        }
    } else {
        echo "No articles found!";
    }
} catch (PDOException $e) {
    die("Error fetching data: " . $e->getMessage());
}
?>
