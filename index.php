<?php
    include('./connection.php');
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
    $stmt = $pdo->query("SELECT * FROM books");
    $books = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <title>Dashboard</title>
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
        <h1 style="border-bottom: 5px solid orangered; width: 50%">Dashboard</h1>

        <div class="book-display">
            <?php foreach ($books as $book): ?>
                <div class="book">
                        <div class="book-image">
                            <img src="./book-open-solid.svg" alt="Book Cover">
                        </div>
                        <div class="book-details">
                            <div class="details">
                                <span><p>Name:</p></span>
                                <p><?php echo htmlspecialchars($book['book_name']); ?></p>
                            </div>
                            <div class="details">
                                <span><p>Publisher:</p></span>
                                <p><?php echo htmlspecialchars($book['book_publisher']); ?></p>
                            </div>
                            <div class="details">
                                <span><p>Year of Publication:</p></span>
                                <p><?php echo htmlspecialchars($book['year_of_publish']); ?></p>
                            </div>
                            <div class="details">
                                <span><p>Author:</p></span>
                                <p><?php echo htmlspecialchars($book['author']); ?></p>
                            </div>
                            <div class="details">
                                <span><p>ISBN:</p></span>
                                <p><?php echo htmlspecialchars($book['isbn']); ?></p>
                            </div>
                            <div class="details">
                                <span><p>Price</p></span>
                                <p><span style="text-decoration: line-through; color: black;">N</span> <?php echo htmlspecialchars($book['price']); ?></p>
                            </div>
                        </div>
                        <div>
                            <form action="delete.php" method="post">
                                <div>
                                    <input type="hidden" name="id" value="<?php echo htmlspecialchars($book['book_id']); ?> ">
                                </div>
                                <button class="delete"><img src="./trash-can-regular.svg" alt="Delete"></button>
                            </form>
                            <div>
                                <input type="hidden" name="id" value="<?php echo htmlspecialchars($book['book_id']); ?> ">
                                <a class="update" href="update.php?id=<?php echo $book['book_id']; ?>"><img src="./pen-solid.svg" alt="Update"></a>
                            </div>
                        </div>

                    </div>
            <?php endforeach; ?>
        </div>
        <a href="#" class="going-up">&#9650;</a>
    </div>
    <footer> 
        <p>BookHub&copy; Contact: &plus;2349020925936</p>
    </footer>
</body>
</html>