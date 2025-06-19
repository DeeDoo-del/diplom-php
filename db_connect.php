<?php
// Данные для подключения к базе данных
$host = "localhost";
$username = "egorcebeka";
$password = "jJt2AzHMQB5U";
$database = "egorcebeka";

$conn = new mysqli($host, $username, $password, $database);
if ($conn->connect_error) {
    die("Ошибка подключения: " . $conn->connect_error);
}
$conn->set_charset("utf8");
?>