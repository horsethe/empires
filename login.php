<?php
header("Content-Type: text/html; charset=UTF-8");
include 'connect.php';
session_start();
if ($_SERVER['REQUEST_METHOD'] == "POST"){
	$pass = $_POST['pass'];
	$log = $_POST['log'];
	$result = mysql_query("SELECT `id`, `nik` FROM `users` WHERE `login`='$log' AND `password`='$pass'");
	$myrow = mysql_fetch_array($result);
}
if($myrow){
	$_SESSION['nik']=$myrow['nik']; 
	$_SESSION['id']=$myrow['id'];
	$_SESSION['rand'] = rand(1000,9999);
	?>
	<script type="text/javascript">
	window.location = "/chat.php"
	</script>
	<?php
}
else{
	unset($log);
	echo 'Неверный логин или пароль!</br>
	<input type="button" value="Назад" onclick="history.back()"/></br>';

}
?>

