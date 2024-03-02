<?php
session_start();

// Проверка авторизации пользователя и его роли
if (!isset($_SESSION['logged_in']) || $_SESSION['role'] !== 'администратор') {
    header("Location: login.php"); // Если не администратор, перенаправить на страницу входа
    exit();
}

// Функция для чтения содержимого файла лога
function readLogFile($logFile) {
    if (file_exists($logFile)) {
        return file_get_contents($logFile);
    } else {
        return "Log file not found!";
    }
}

$logFile = 'error_log.txt';
$logContent = readLogFile($logFile);


try {
    $servername = "localhost";
    $username = "root"; 
    $password = ".."; 
    $dbname = "ste";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        throw new Exception("Ошибка подключения: " . $conn->connect_error);
    }

  
} catch (Exception $e) {
    $errorMessage = 'Ошибка: ' . $e->getMessage();
    file_put_contents('error_log.txt', $errorMessage, FILE_APPEND);
}

?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Log File - Управление доступом</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <header>
        <h1>Log File - Управление доступом</h1>
        <nav>
            <ul>
                <li><a href="index.php">Главная</a></li>
                <li><a href="shop.php">Товары</a></li>
                <li><a href="cart.php">Корзина</a></li>
                <li><a href="otziv.php">Отзывы</a></li>
                <li><a href="login.php">Выход</a></li>
                <li><a href="manage_access.php">Управление доступом</a></li>
            </ul>
        </nav>
    </header>

    <div class="log-container">
        <h2>Содержимое лога</h2>
        <pre><?php echo $logContent; ?></pre>
    </div>
</body>
</html>
