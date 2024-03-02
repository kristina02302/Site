<?php
session_start();

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
        die("Connection failed: " . $conn->connect_error);
    }

    // Получение данных из формы
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';

    // Защита от SQL-инъекций
    $username = mysqli_real_escape_string($conn, $username);

    // Хеширование пароля с использованием password_hash
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Роль пользователя
    $role = 'покупатель'; // Устанавливаем роль "покупатель"

    // Добавление нового пользователя в базу данных
    $sql = "INSERT INTO users (username, password, role) VALUES ('$username', '$hashed_password', '$role')";
    if ($conn->query($sql) === TRUE) {
        echo "Регистрация успешна!";
    } else {
        echo "Ошибка: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
}
?>


<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Registration</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
<div class="registration-container">
    <h2>Регистрация</h2>
    <form action="registr.php" method="post">
        <input type="text" name="username" placeholder="Username" required><br><br>
        <input type="password" name="password" placeholder="Password" required><br><br>
        <input type="submit" value="Зарегистрироваться">
    </form>
    <p>Уже есть аккаунт? <a href="login.php">Войти</a></p>
</div>
</body>
</html>
