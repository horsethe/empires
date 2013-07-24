<?php
header("Content-Type: text/html; charset=UTF-8");
include 'connect.php';
session_start();
echo '<a href="/login.php">Вход</a><br>
или<br>
<a href="/reg.php">Регистрация</a><br>';

?>