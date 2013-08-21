<?php
if(isset($_SESSION['id'])){
	$id = $_SESSION['id'];
	$result = mysql_query("SELECT * FROM `users` WHERE `id`='$id'");
	$myrow = mysql_fetch_assoc($result);
	echo "Профиль игрока ".$myrow['log']."<br>";
	echo "Страна: ".$myrow['city']."<br>";
	
} else{
	echo 'Вы не авторизованы';
}
?>