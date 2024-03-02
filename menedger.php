<?php
session_start();

// Функция для записи логов действий пользователей
function logAction($username, $action) {
    $logFile = 'log.txt';
    $log = "[" . date('Y-m-d H:i:s') . "] User: $username - Action: $action\n";
    file_put_contents($logFile, $log, FILE_APPEND);
}

// Проверка на авторизацию менеджера
if (!isset($_SESSION['logged_in']) || $_SESSION['role'] !== 'менеджер') {
    header("Location: login.php");
    exit();
}

// Подключение к базе данных 
$servername = "localhost";
$username_db = "root";
$password_db = "";
$dbname = "site";

$conn = new mysqli($servername, $username_db, $password_db, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Получение данных о пользователе
$username = $_SESSION['username'];
$sql = "SELECT * FROM users WHERE username='$username'";
$result = $conn->query($sql);

if ($result && $result->num_rows > 0) {
    $user = $result->fetch_assoc();

    $_SESSION['logged_in'] = true;
    $_SESSION['username'] = $user['username'];
    $_SESSION['role'] = $user['role']; 

    // Логирование успешного входа пользователя
    logAction($user['username'], 'Logged in');
} else {
    echo "Ошибка получения данных о пользователе";
}

$conn->close();
// Действие пользователя
logAction($username, 'Performed action XYZ');
// Выход пользователя
logAction($_SESSION['username'], 'Logged out');
?>
<!DOCTYPE html>
<html lang="ru">
<head>
<meta charset="UTF-8">
    <title>Магазин - Flower Shop</title>
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="st.css">
</head>
<body>
<header>
        <h1>Магазин цветов</h1>
        <nav>
            <ul>
                <li><a href="index.php">Главная</a></li>
                <li><a href="shop.php">Товары</a></li>
                <li><a href="cart.php">Корзина</a></li>
                <li><a href="otziv.php">Отзывы</a></li>
                <li><a href="login.php">Выход</a></li>
                <li><a href="menedger.php">Редактирования товаров</a></li>
               
            </ul>
        </nav>
    </header>
<h1>Редактирование товаров</h1>
    <ul class="admin-menu">
        <li><a href="edit_products.php">Редактирования товаров</a></li>
        <li><a href="view_users.php">Просмотр пользователей</a></li>
     
    </ul>
</body>
</html>
