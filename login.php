<?php
header("Content-Type: text/html; charset=UTF-8");
include 'connect.php';
session_start();
error_reporting(E_ALL);

if(isset($_SESSION['id'])){
	header('Location: /index.php');
} else{
		$log = post('log');
		$pass1 = post('pass');
	if($_POST){
			$pass = md5($pass1);
			$result = mysql_query("SELECT `id` FROM `users` WHERE `log`='$log' AND `pass`='$pass'");
			$myrow = mysql_fetch_array($result);
		if($myrow){
			$_SESSION['id']=$myrow['id'];
			$_SESSION['rand'] = rand(1000,9999);
			header('Location: /index.php');
		} else{
			unset($_SESSION['id']);
			echo '<div style="color:red">';
			echo 'Неверный логин или пароль!</br>';
			echo '</div>';
		}
	}
	
	echo '<form action="" method="POST">
	<b>Вход</b></br>
	Логин: </br>
	<input type="text" name="log" value="'.$log.'"/></br>
	Пароль: </br>
	<input type="password" name="pass" value="'.$pass1.'"/></br>
	<input type="submit" name="ok"  value="Вход"/><br>
	</form>';
	echo '<a href="/index.php">На главную<br></a>';
}

?>