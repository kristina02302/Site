<?php
// Подключение к базе данных "guest"
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "guest";

$conn = new mysqli($servername, $username, $password, $dbname);

// Проверка подключения
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Получение данных из формы и вставка в таблицу "guest"
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user = $_POST['user'];
    $text_message = $_POST['text_message'];
    $e_mail = $_POST['e_mail'];

   
    $user = htmlspecialchars($user, ENT_QUOTES, 'UTF-8');
    $text_message = htmlspecialchars($text_message, ENT_QUOTES, 'UTF-8');
    $e_mail = htmlspecialchars($e_mail, ENT_QUOTES, 'UTF-8');

    // Вставка данных в таблицу
    $sql = "INSERT INTO guest (user, text_message, e_mail) VALUES ('$user', '$text_message', '$e_mail')";

    if ($conn->query($sql) === TRUE) {
        echo "";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Отзывы - Flower Shop</title>
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
                <li><a href="otzv.php">Отзывы</a></li>
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
        <section class="review-form">
            <h2>Оставьте ваш отзыв</h2>
    <form action="otziv.php" method="post">
        <label for="user">Name:</label>
        <input type="text" name="user" required><br>

        <label for="text_message">Message:</label>
        <textarea name="text_message" required></textarea><br>

        <label for="e_mail">Email:</label>
        <input type="email" name="e_mail" required><br>

        <input type="submit" value="Submit">
    </form>
  
    <?php
    // Отображение записей внизу страницы
    $conn = new mysqli($servername, $username, $password, $dbname);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $sql = "SELECT * FROM guest ORDER BY data_time_message DESC";
    $result = $conn->query($sql);

    echo "<h2>Ваши отзывы</h2>";
    if ($result->num_rows > 0) {
        echo "<ul>";
        while ($row = $result->fetch_assoc()) {
            $safeUser = htmlspecialchars($row["user"], ENT_QUOTES, 'UTF-8');
            $safeEmail = htmlspecialchars($row["e_mail"], ENT_QUOTES, 'UTF-8');
            $safeTextMessage = htmlspecialchars($row["text_message"], ENT_QUOTES, 'UTF-8');

            echo "<li><strong>" . $safeUser . "</strong> (" . $safeEmail . ") said: <br>"
                 . $safeTextMessage . "<br>"
                 . "<small>" . $row["data_time_message"] . "</small></li>";
        }
        echo "</ul>";
    } else {
        echo "No entries yet.";
    }

    $conn->close();
    ?>
      </section>
    </main>
    <footer>
       <p>&copy; 2023 Flower Shop. All rights reserved.</p>
    </footer>
</body>
</html>
