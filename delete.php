<?php
$host = 'localhost';
$db   = 'bookstore';
$user = 'root';
$pass = '';
$charset = 'utf8mb4';

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];

try {
    $pdo = new PDO($dsn, $user, $pass, $options);

    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['id'])) {
        $id = $_POST['id'];

        $stmt = $pdo->prepare("DELETE FROM books WHERE book_id = ?");
        $stmt->execute([$id]);

        header('Location: index.php');
        exit();
    } else {
        echo "Invalid request!";
    }
} catch (\PDOException $e) {
    throw new \PDOException($e->getMessage(), (int)$e->getCode());
}
?>
