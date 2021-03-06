<?php
if(isset($_SESSION['id'])){
	header('Location: /index');
	exit;
}
$log = post('log', 'Гость');
$pass1 = post('pass');
$city = post('city');
$rep_trader = 0;
$rep_pirate = 0;
$rep_warrior = 0;
switch (post('speciality')){
	case 'trader':$rep_trader = 1000; $location = 1;break;
	case 'pirate':$rep_pirate = 1000; $location = 2;break;
	case 'warrior':
	default: $rep_warrior = 1000; $location = 3;break;
}

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
		$pass = md5(PASSWORD_SALT.$pass1);
		$reg_data = date("j-n-Y");
		$insert_db = array(
			'log' => $log,
			'pass' => $pass,
			'reg_data' => $reg_data,
			'city' => $city,
			'rep_trader' => $rep_trader,
			'rep_pirate' => $rep_pirate,
			'rep_warrior' => $rep_warrior,
			'money1' => getCfg('reg_user_money1'),
			'money2' => getCfg('reg_user_money2'),
			'location' => $location,
		);
		$_SESSION['id'] = DB::get_id('
			INSERT INTO `users`'.DB::arr2insert($insert_db));
		header('Location: /index');
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

?>
