<?php
header("Content-Type: text/html; charset=UTF-8");
include 'connect.php';
session_start();
error_reporting(E_ALL);

if(isset($_SESSION['id'])){
	$id = $_SESSION['id'];
	$result = mysql_query("SELECT * FROM `users` WHERE `id`='$id'");
	$myrow = mysql_fetch_assoc($result);
	echo "Профиль игрока ".$myrow['log']."<br>";
	echo "Страна: ".$myrow['city']."<br>";
	
} else{
	echo 'Вы не авторизованы';
}
echo '<a href="/index.php">На главную<br></a>';
?>