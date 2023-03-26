<?php
include('connect.php');
$connection = get_connection();

// Проверяем, что соединение успешно установлено
if (!$connection) {
    die("Ошибка подключения к базе данных: " . mysqli_connect_error());
}

// Выполняем SQL-запросы на базу данных через соединение $connection
?>