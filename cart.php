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

// Запрос к базе данных для получения товаров в корзине и их количества
if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];

    $sql = "SELECT Products.product_id, Products.product_name, Products.product_price, Cart.quantity
            FROM Cart
            INNER JOIN Products ON Cart.product_id = Products.product_id
            WHERE Cart.user_id = $user_id"; 

    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Вывод данных о товарах в корзине
        echo "<h2>Содержимое корзины:</h2>";
        echo "<ul>";
        while ($row = $result->fetch_assoc()) {
            echo "<li>" . $row["product_name"] . " - Цена: $" . $row["product_price"] . " - Количество: " . $row["quantity"] . "</li>";
        }
        echo "</ul>";
    } else {
        echo "Ваша корзина пуста";
    }
} else {
    echo "Вы не вошли в систему"; 
}

// Закрываем соединение с базой данных
$conn->close();
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Корзина - Flower Shop</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <header>
        <h1>Ваша корзина</h1>
        <nav>
            <ul>
                <li><a href="index.php">Главная</a></li>
                <li><a href="shop.php">Товары</a></li>
                <li><a href="cart.php">Корзина</a></li>
                <li><a href="otziv.php">Отзывы</a></li>
                <li><a href="login.php">Выход</a></li>
             
            </ul>
        </nav>
    </header>

        <main>
    <h2>Ваша корзина</h2>
    
</main>

    

    <footer>
        <p>&copy; 2023 Flower Shop. Все права защищены.</p>
    </footer>
</body>
</html>
