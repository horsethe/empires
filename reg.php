<?php
header("Content-Type: text/html; charset=UTF-8");
include 'connect.php';
session_start();
error_reporting(E_ALL);

if(isset($_SESSION['id'])){
	header('Location: /index.php');
}else{
	$log = post('log', 'Гость');
	$pass1 = post('pass');
	$city = post('city');	
	if($_POST){	
		$result = mysql_query("SELECT `id` FROM `users` WHERE `log` = '$log'");
		$myrow = mysql_fetch_array($result);
		$result1 = mysql_query("SELECT `id` FROM `users` WHERE `city` = '$city'");
		$myrow1 = mysql_fetch_array($result1);
		$log_valid = preg_match('#^[a-zA-Zа-яА-Я0-9_!]{2,16}$#u',$log);
		$pass_valid = preg_match('#^[a-zA-Z0-9_!]{6,16}$#u',$pass1);
		$city_valid = preg_match('#^[a-zA-Zа-яА-Я0-9_!]{2,16}$#u',$city);
		try {
			if (!empty($myrow)){
				throw new Exception('Логин занят! Выберете другой логин!');
			} elseif(!empty($myrow1)){
				throw new Exception('Такая страна уже существует!');				
			} elseif(!$log_valid){
				throw new Exception('Введен некорректный логин!');
			} elseif(!$pass_valid){
				throw new Exception('Введен некорректный пароль!');
			} elseif(!$city_valid){
				throw new Exception('Неверное название страны!');
			}
			$pass = md5($pass1);
			$reg_data = date("j-n-Y");
			mysql_query("INSERT INTO `users`(`log`, `pass`, `reg_data`, `city`) VALUES ('$log','$pass','$reg_data','$city')");
			$_SESSION['id']= mysql_insert_id();
			header('Location: /index.php');
			exit;
			
		} catch(Exception $e){
			echo '<div style="color:red">';
			echo $e->getMessage();
			echo '</div>';
		}	
	}
		echo'<form action="" method="POST">
		<b>Регистрация:</b></br>
		Логин</br>
		(может содержать от 2 до 16 русских или английских букв,цифр, знаков _,-,!):</br>
		<input type="text" name="log" value="'.$log.'"/></br>
		Пароль</br>
		(может содержать от 6 до 16 английских букв,цифр, знаков _,-,!):</br>
		<input type="password" name="pass" value="'.$pass1.'"/></br>
		Название страны</br>
		(может содержать от 2 до 16 русских или английских букв,цифр, знаков _,-,!):</br>
		<input type="text" name="city" value="'.$city.'"/></br>
		<input type="submit" name="ok" value="Регистрация"/></br>
		</form>';
}



?>