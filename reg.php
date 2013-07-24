<?php
header("Content-Type: text/html; charset=UTF-8");
include 'connect.php';
session_start();
$id = $_SESSION['id'];
if(isset($id)){
	?>
	<script type="text/javascript">
	window.location = "/index.php"
	</script>
	<?
	}else{
	$ok = $_POST['ok'];
	if(empty($ok)){
	echo'<form action="" method="POST">
		<b>Регистрация:</b></br>
		Логин</br>
		(может содержать от 2 до 16 русских или английских букв,цифр, знаков _,-,!):</br>
		<input type="text" name="log" value=""/></br>
		Пароль</br>
		(может содержать от 2 до 16 английских букв,цифр, знаков _,-,!):</br>
		<input type="text" name="pass" value=""/></br>
		Название страны</br>
		(может содержать от 2 до 16 русских или английских букв,цифр, знаков _,-,!):</br>
		<input type="text" name="city" value=""/></br>
		<input type="submit" name="ok" value="Регистрация"/></br>
		</form>';
		}else{
			$log = $_POST['log'];
			$pass1 = $_POST['pass'];
			$city = $_POST['city'];		
			$result = mysql_query("SELECT `id` FROM `users` WHERE `log` = '$log'");
			$myrow = mysql_fetch_array($result);
			$result1 = mysql_query("SELECT `id` FROM `users` WHERE `city` = '$city'");
			$myrow1 = mysql_fetch_array($result1);
			if(empty($myrow) and empty($myrow1) and preg_match('#^[a-zA-Zа-яА-Я0-9_!]{2,16}$#',$log) and  preg_match('#^[a-zA-Z0-9_!]{2,16}$#',$pass1) and  preg_match('#^[a-zA-Zа-яА-Я0-9_!]{2,16}$#',$city)){
				$pass = md5($pass1);
				$reg_data = date("j-n-Y");
				mysql_query("INSERT INTO `users`(`log`, `pass`, `reg_data`, `city`) VALUES ('$log','$pass','$reg_data','$city')");

				echo 'Вы зарегистрировались! </br>
				Используйте ваш логин и пароль для <a href="/login.php">входа</a> в игру!</a></br>';
				}else{
					if(isset($myrow['id'])){
						echo'Логин занят! Выберете другой логин!<br>';
						}
					elseif(isset($myrow1['id'])){
						echo'Такая страна уже существует!<br>';
						
					}else{
						echo'Введены некорректные данные!<br>';
					}
					echo'<input type="button" value="Назад" onclick="history.back()"/></br>';

				}
			}
	}



?>