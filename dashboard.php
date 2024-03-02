<?php
session_start();

// Проверка наличия сессии пользователя
if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
    // Пользователь не аутентифицирован, перенаправляем на страницу входа
    header('Location: login.php');
    exit();
}

// Проверка роли пользователя
if ($_SESSION['role'] === 'администратор') {
    // Перенаправление администратора на страницу admin.php
    header('Location: admin.php');
    exit();
} elseif ($_SESSION['role'] === 'менеджер') {
    // Перенаправление менеджера на страницу menedger.php
    header('Location: menedger.php');
    exit();
} elseif ($_SESSION['role'] === 'покупатель') {
    // Перенаправление покупателя на страницу index.php
    header('Location: index.php');
    exit();
} else {
    // Неопределенная роль
    echo 'Ошибка! Неизвестная роль пользователя';
}
?>


