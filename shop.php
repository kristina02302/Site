<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Магазин - Flower Shop</title>
    <link rel="stylesheet" href="styles.css">
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
            
            </ul>
        </nav>
    </header>

    <main>
    <h2>Товары в магазине</h2>
    <section class="featured-products">
      
       
        <div class="product">
            <img src="img/flower1.jpg" alt="Flower 1">
            <h3>Розы</h3>
            <p>$20.99</p>
            <form action="cart.php" method="POST"> 
                <input type="hidden" name="product_id" value="1">
                <input type="submit" name="add_to_cart" value="Добавить в корзину">
            </form>
        </div>

        <div class="product">
            <img src="img/flower2.jpg" alt="Flower 2">
            <h3>Тюльпаны</h3>
            <p>$15.99</p>
            <form action="cart.php" method="POST"> 
                <input type="hidden" name="product_id" value="2">
                <input type="submit" name="add_to_cart" value="Добавить в корзину">
            </form>
        </div>
        <div class="product">
        <img src="img/flower3.jpg" alt="Flower 3">
                <h3>Ромашки</h3>
                <p>$12.99</p>
                <form action="cart.php" method="POST"> 
                <input type="hidden" name="product_id" value="3">
                <input type="submit" name="add_to_cart" value="Добавить в корзину">
            </form>
        </div> 

        <div class="product">
        <img src="img/flower4.jpg" alt="Flower 4">
                <h3>Лилии</h3>
                <p>$25.99</p>
                <form action="cart.php" method="POST"> 
                <input type="hidden" name="product_id" value="4">
                <input type="submit" name="add_to_cart" value="Добавить в корзину">
            </form>
        </div>
        
        <div class="product">
        <img src="img/flower5.jpg" alt="Flower 5">
                <h3>Хризантемы</h3>
                <p>$18.99</p>
                <form action="cart.php" method="POST"> 
                <input type="hidden" name="product_id" value="5">
                <input type="submit" name="add_to_cart" value="Добавить в корзину">
            </form>
        </div>
        
        <div class="product">
        <img src="img/flower6.jpg" alt="Flower 6">
                <h3>Пионы</h3>
                <p>$17.99</p>
                <form action="cart.php" method="POST"> 
                <input type="hidden" name="product_id" value="6">
                <input type="submit" name="add_to_cart" value="Добавить в корзину">
            </form>
        </div>
        <div class="product">
        <img src="img/flower7.jpg" alt="Flower 7">
                <h3>Астры</h3>
                <p>$17.99</p>
                <form action="cart.php" method="POST"> 
                <input type="hidden" name="product_id" value="7">
                <input type="submit" name="add_to_cart" value="Добавить в корзину">
            </form>
        </div>
</section>
    </main>

    <footer>
        <p>&copy; 2023 Flower Shop. All rights reserved.</p>
    </footer>
</body>
</html>
