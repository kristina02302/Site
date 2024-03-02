<?php
session_start();

// Функция для записи логов ошибок и предупреждений
function logError($error) {
    $logFile = 'error_log.txt';
    $log = "[" . date('Y-m-d H:i:s') . "] Ошибка: $error\n";
    file_put_contents($logFile, $log, FILE_APPEND);
}


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Подключение к базе данных
    $servername = "localhost";
    $username_db = "root";
    $password_db = "";
    $dbname = "site";

    // Создание подключения
    $conn = new mysqli($servername, $username_db, $password_db, $dbname);

    // Проверка подключения
    if ($conn->connect_error) {
        // Записываем ошибку подключения в лог
        logError("Ошибка подключения: " . $conn->connect_error);
        // В случае неудачи выводим сообщение об ошибке
        die("Ошибка подключения: " . $conn->connect_error);
    }

    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';

    // Проверка на пустые значения
    if (empty($username) || empty($password)) {
        // Запись ошибки в лог
        logError("Пустое имя пользователя или пароль");
        // Вывод сообщения об ошибке
        echo "Имя пользователя или пароль не могут быть пустыми";
        exit(); // Остановить выполнение скрипта
    }

    $username = mysqli_real_escape_string($conn, $username);

    $sql = "SELECT * FROM users WHERE username='$username'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();

        $hashed_password = $user['password']; // Получаем хешированный пароль из базы данных
        if (password_verify($password, $hashed_password)) {
            $_SESSION['logged_in'] = true;
            $_SESSION['username'] = $username;
            $_SESSION['role'] = $user['role'];

            // Логирование успешного входа
            logAction($username, 'Вход выполнен');

            header('Location: dashboard.php');
            exit();
        } else {
            // Логирование неудачной попытки входа
            logError("Неверное имя пользователя или пароль");

            echo "Неверное имя пользователя или пароль";
        }
    } else {
        // Логирование неудачной попытки
        logError("Пользователь не найден");

        echo "Пользователь не найден";
    }

    $conn->close();
}

// Функция для записи логов действий пользователей
function logAction($username, $action) {
    $logFile = 'action_log.txt';
    $log = "[" . date('Y-m-d H:i:s') . "] Пользователь: $username - Действие: $action\n";
    file_put_contents($logFile, $log, FILE_APPEND);
}
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Вход</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="login-container">
        <h2>Вход</h2>
        <form action="login.php" method="post">
            <input type="text" name="username" placeholder="Имя пользователя" required><br><br>
            <input type="password" name="password" placeholder="Пароль" required><br><br>
            <input type="submit" value="Войти">
        </form>
        <p>Нет аккаунта? <a href="registr.php">Зарегистрироваться</a></p>
    </div>
</body>
</html>
