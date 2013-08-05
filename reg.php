<?php
if(isset($_SESSION['id'])){
	header('Location: /index');
	exit;
}
$log = post('log', 'Гость');
$pass1 = post('pass');
$city = post('city');	
if($_POST){
	$myrow = DB::get_row('SELECT `id` FROM `users` WHERE `log` = "'.esc($log).'"');
	$myrow1 = DB::get_row('SELECT `id` FROM `users` WHERE `city` = "'.esc($city).'"');
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
		$_SESSION['id'] = DB::get_id('
			INSERT INTO `users`(`log`, `pass`, `reg_data`, `city`) 
			VALUES ("'.esc($log).'","'.esc($pass).'","'.$reg_data.'","'.esc($city).'")
		');
		header('Location: /index.php');
		exit;
		
	} catch(Exception $e){
		echo '<div style="color:red">';
		echo $e->getMessage();
		echo '</div>';
	}	
}

$data = array(
	'log'=>$log,
	'pass1'=>$pass1,
	'city'=>$city,
);

$data['usersCount'] = DB::get_value('SELECT count(*) FROM `users`');

echo t('reg', $data);
echo t('_footer');
?>
