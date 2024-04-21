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
    header('Location: index.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <title>Book Entry</title>
</head>
<body>
    <nav>
        <div class="logo">
            <a href="/bookstorage/"><h1>Book<span style="color: orangered;">H</span>ub</h1></a>
        </div>
        <div>
            <ul>
                <li><a href="/bookstorage/">Home</a></li>
                <li><a href="/bookstorage/input.php">Book Input</a></li>
            </ul>
        </div>
    </nav>
    <div class="display-page">
        <h1 style="border-bottom: 5px solid orangered; width: 50%">Add A Book</h1>

        <div class="book-input-container">
            <form action="input.php" method="post">
                <div class="input-details">
                    <p>Book Name:</p>
                    <input type="text" name="book_title" id="book_title" required>
                </div>
                <div class="input-details">
                    <p>Book Publisher:</p>
                    <input type="text" name="book_publish" id="book_publish" required>
                </div>
                <div class="input-details">
                    <p>Year of Publication:</p>
                    <input type="text" name="year_publish" id="year_publish" required>
                </div>
                <div class="input-details">
                    <p>Author:</p>
                    <input type="text" name="book_author" id="book_author" required>
                </div>
                <div class="input-details">
                    <p>ISBN:</p>
                    <input type="text" name="ISBN" id="ISBN" required>
                </div>
                <div class="input-details">
                    <p>Price:</p>
                    <input type="number" name="price" id="price" required>
                </div>
                <div class="input-details">
                    <button>Submit</button>
                </div>
            </form>
        </div>
    </div>
</body>
</html>