<?php
session_start();

// Определение функции для записи логов
function logAction($username, $action) {
    $logFile = 'log.txt';
    $log = "[" . date('Y-m-d H:i:s') . "] User: $username - Action: $action\n";
    file_put_contents($logFile, $log, FILE_APPEND);
}

// Подключение к базе данных
$servername = "localhost";
$username_db = "root";
$password_db = "";
$dbname = "your_database_name";

$conn = new mysqli($servername, $username_db, $password_db, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';

    $username = mysqli_real_escape_string($conn, $username);
    $hashed_password = md5($password);

    $sql = "SELECT * FROM users WHERE username='$username' AND password='$hashed_password'";
    $result = $conn->query($sql);

    if ($result && $result->num_rows > 0) {
        $user = $result->fetch_assoc();

        $_SESSION['logged_in'] = true;
        $_SESSION['username'] = $user['username'];
        $_SESSION['role'] = $user['role'];

        logAction($username, 'Logged in');

        header('Location: dashboard.php');
        exit();
    } else {
        echo "Invalid username or password";
    }
}

$conn->close();

// Проверка на существование $_SESSION['username'] перед логированием
$username = isset($_SESSION['username']) ? $_SESSION['username'] : '';
// Примеры действий пользователя
logAction($username, 'Performed action XYZ');
logAction($username, 'Logged out');
?>


<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Flower Shop</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <header>
        <h1>Добро пожаловать в наш цветочный магазин</h1>
        <nav>
            <ul>
                <li><a href="index.php">Главная</a></li>
                <li><a href="shop.php">Товары </a></li>
                <li><a href="cart.php">Корзина</a></li>
                <li><a href="otziv.php">Отзывы</a></li>
                <li><a href="login.php">Выход</a></li>
                
            
            </ul>
        </nav>
    </header>

    <main>
        <section class="hero">
            <h2>Красивые цветы на любой случай</h2>
            <p>Ознакомьтесь с нашим широким выбором свежих и ярких цветов!</p>
            <a href="shop.php" class="btn">Купить сейчас</a>
        </section>

        <section class="featured-products">
        <h2>Рекомендуемые продукты</h2>
            <div class="product">
                <img src="img/flower1.jpg" alt="Flower 1">
                <h3>Красные розы</h3>
                <p>$20.99</p>
                <a href="shop.php" class="btn">Подробнее</a>
            </div>
            <div class="product">
                <img src="img/flower2.jpg" alt="Flower 2">
                <h3>Тюльпаны</h3>
                <p>$15.99</p>
                <a href="shop.php" class="btn">Подробнее</a>
            </div>
            <div class="product">
                <img src="img/flower3.jpg" alt="Flower 3">
                <h3>Фиалки</h3>
                <p>$10.99</p>
                <a href="shop.php" class="btn">Подробнее</a>
            </div>
           
        </section>
    </main>

    <footer>
        <p>&copy; 2023 Flower Shop. All rights reserved.</p>
    </footer>
</body>
</html>
