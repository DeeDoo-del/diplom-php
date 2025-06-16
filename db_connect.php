<?php
// Данные для подключения к базе данных
$host = "localhost:5432";
$username = "postgres";
$password = "bjsdmw24";
$database = "public";
// Подключение к базе данных
$conn = pg_connect("host=$host dbname=$database user=$user password=$password");

if (!$conn) {
    die("Ошибка подключения: " . pg_last_error());
}
echo "Успешное подключение к базе данных!";
?>