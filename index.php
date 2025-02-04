<?php
// Include the database connection file
include 'db.php';

try {
    // Fetch articles from the database
    $query = $conn->query("SELECT id, title, content, published_date FROM articles ORDER BY published_date DESC");
    $articles = $query->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    // Handle errors during query execution
    die("Error fetching articles: " . $e->getMessage());
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My News</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }
        header {
            background-color: #333;
            color: #fff;
            padding: 10px 20px;
        }
        header h1 {
            margin: 0;
        }
        .article {
            border-bottom: 1px solid #ccc;
            padding: 10px;
        }
        .article h2 {
            margin: 0;
        }
        .article p {
            margin: 5px 0;
        }
        .article a {
            color: #007BFF;
            text-decoration: none;
        }
    </style>
</head>
<body>
    <header>
        <h1>My News</h1>
    </header>
    <div class="articles">
        <?php if (!empty($articles)): ?>
            <?php foreach ($articles as $article): ?>
                <div class="article">
                    <h2><?= htmlspecialchars($article['title']); ?></h2>
                    <p><?= htmlspecialchars($article['content']); ?></p>
                    <small>Published on: <?= htmlspecialchars($article['published_date']); ?></small>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p>No articles found.</p>
        <?php endif; ?>
    </div>
</body>
</html>
