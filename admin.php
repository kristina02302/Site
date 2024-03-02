<?php
session_start();

// Функция для записи логов действий пользователей
function logAction($username, $action) {
    $logFile = 'log.txt';
    $log = "[" . date('Y-m-d H:i:s') . "] User: $username - Action: $action\n";
    file_put_contents($logFile, $log, FILE_APPEND);
}

// Проверка авторизации пользователя
if (!isset($_SESSION['logged_in']) || $_SESSION['role'] !== 'администратор') {
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

// Запрос к базе данных для получения информации о пользователях
$query = "SELECT * FROM users"; 
$result = $conn->query($query);

// Проверка результата запроса
if (!$result) {
    die("Ошибка запроса: " . $conn->error);
}
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
                <li><a href="admin.php">Управление пользователями</a></li>
              
            </ul>
        </nav>
    </header>
<h1>Управление пользователями</h1>
    <ul class="admin-menu">
        <li><a href="view_users.php">Просмотр пользователей</a></li>
        <li><a href="edit_users.php">Редактирование пользователей</a></li>
        <li><a href="manage_access.php">Управление доступом</a></li>
        <li><a href="error_log.php">Управление oшибками </a></li>
    </ul>
</body>
</html>
