<?php
session_start();
$host = 'localhost';
$db_name = 'db6kkyglj5qwgi';
$username = 'ul8rz3mz2i4mp';
$password = 'eayo5amdaudv';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$db_name", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $user = $_POST['username'];
        $pass = $_POST['password'];

        $stmt = $pdo->prepare("SELECT * FROM users WHERE username = :username AND password = :password");
        $stmt->execute(['username' => $user, 'password' => $pass]);
        $user = $stmt->fetch();

        if ($user) {
            $_SESSION['loggedin'] = true;
            header("Location: dashboard.php");
            exit;
        } else {
            echo "Invalid credentials!";
        }
    }
} catch (PDOException $e) {
    die("Database connection failed: " . $e->getMessage());
}
?>

<form method="post">
    Username: <input type="text" name="username" required><br>
    Password: <input type="password" name="password" required><br>
    <button type="submit">Login</button>
</form>
