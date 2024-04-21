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
} catch (\PDOException $e) {
    throw new \PDOException($e->getMessage(), (int)$e->getCode());
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = $_POST['book_title'];
    $publisher = $_POST['book_publish'];
    $published_year = $_POST['year_publish'];
    $author = $_POST['book_author'];
    $ISBN = $_POST['ISBN'];
    $price = $_POST['price'];

    $stmt = $pdo->prepare("INSERT INTO books (book_name, book_publisher, year_of_publish, author, price, isbn) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->execute([$title, $publisher, $published_year, $author, $price, $ISBN]);

}
?>

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
} catch (\PDOException $e) {
    throw new \PDOException($e->getMessage(), (int)$e->getCode());
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = $_POST['book_title'];
    $publisher = $_POST['book_publish'];
    $published_year = $_POST['year_publish'];
    $author = $_POST['book_author'];
    $ISBN = $_POST['ISBN'];
    $price = $_POST['price'];
    $cover_image = file_get_contents($_FILES['cover_image']['tmp_name']);

    $stmt = $pdo->prepare("INSERT INTO books (book_name, book_publisher, year_of_publish, author, price, isbn, cover_image) VALUES (?, ?, ?, ?, ?, ?, ?)");
    $stmt->execute([$title, $publisher, $published_year, $author, $price, $ISBN, $cover_image]);

}
?>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_FILES['cover_image']) && $_FILES['cover_image']['error'] === 0) {
    $tmp_name = $_FILES['cover_image']['tmp_name'];

    // Check if a file was uploaded
    if (is_uploaded_file($tmp_name)) {
        $cover_image = file_get_contents($tmp_name);

        $host = 'localhost';
        $db   = 'bookstorage';
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

            $title = $_POST['book_title'];
            $publisher = $_POST['book_publish'];
            $published_year = $_POST['year_publish'];
            $author = $_POST['book_author'];
            $ISBN = $_POST['ISBN'];
            $price = $_POST['price'];

            $stmt = $pdo->prepare("INSERT INTO books (book_name, book_publisher, year_of_publish, author, price, isbn, cover_image) VALUES (?, ?, ?, ?, ?, ?, ?)");
            $stmt->execute([$title, $publisher, $published_year, $author, $price, $ISBN, $cover_image]);

            echo "Book details with image inserted successfully!";
        } catch (\PDOException $e) {
            throw new \PDOException($e->getMessage(), (int)$e->getCode());
        }
    } else {
        echo "Error uploading file!";
    }
} else {
    echo "No file uploaded!";
}
?>
