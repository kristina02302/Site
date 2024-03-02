<?php
session_start();

// Подключение к базе данных
$servername = "localhost";
$username = "root";
$password = ""; 
$dbname = "site";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Запрос к базе данных для получения информации о пользователях
$query = "SELECT `user_id`, `username`, `password`, `role` FROM `users`"; 
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
    <title>Просмотр пользователей - Flower Shop</title>
    <link rel="stylesheet" href="styles.css"> <!-- Подключаем общие стили -->
    <link rel="stylesheet" href="styl.css"> <!-- Подключаем стили для страницы "Просмотр пользователей" -->
</head>
<body>
    <header>
       
    </header>
    
    <h1>Просмотр пользователей</h1>

    <!-- Содержимое страницы Просмотр пользователей -->
    <table class="user-table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Имя пользователя</th>
                <th>Пароль</th>
                <th>Роль</th>
            </tr>
        </thead>
        <tbody>
            <?php
            // Вывод данных о пользователях
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row['user_id'] . "</td>";
                echo "<td>" . $row['username'] . "</td>";
                echo "<td>" . $row['password'] . "</td>";
                echo "<td>" . $row['role'] . "</td>";
                echo "</tr>";
            }
            ?>
        </tbody>
    </table>
    <!-- Конец содержимого страницы -->

    <footer>
       
    </footer>
</body>
</html>

<?php
// Закрытие соединения с базой данных
$conn->close();
?>
