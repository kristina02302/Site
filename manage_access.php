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

$logFile = 'log.txt';
$logContent = readLogFile($logFile);
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Log File - Управление доступом</title>
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="st.css">
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
