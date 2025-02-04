<?php
require 'db_connect.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Validate input fields
    if (!isset($_POST['title'], $_POST['content'], $_POST['category_id']) || 
        empty($_POST['title']) || 
        empty($_POST['content']) || 
        empty($_POST['category_id'])) {
        echo "All fields are required!";
        exit;
    }

    // Sanitize inputs
    $title = htmlspecialchars($_POST['title']);
    $content = htmlspecialchars($_POST['content']);
    $category_id = intval($_POST['category_id']);

    // Insert into database
    $stmt = $pdo->prepare("INSERT INTO articles (title, content, category_id, created_at) VALUES (?, ?, ?, NOW())");
    if ($stmt->execute([$title, $content, $category_id])) {
        header('Location: index.php?success=1');
        exit;
    } else {
        echo "Failed to add the article!";
        exit;
    }
} else {
    // Show a friendly message for direct GET access
    echo "This page is for submitting articles. Please use the <a href='form_page.php'>submission form</a>.";
    exit;
}
