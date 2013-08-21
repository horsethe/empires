<?php
$userId = $_SESSION['id'];
$user = DB::get_row('SELECT * FROM users WHERE id = '.intval($userId));
//var_dump($user);
$userLocation = DB::get_row('SELECT * FROM locations WHERE id = '.$user['location']);
//var_dump($userLocation);
echo $userLocation['name'].'<br>'.$userLocation['description'].'<br/>
<a href="/profile">Профиль</a><br>
<a href="/chat">Чат</a><br/>';
$newLocations = DB::get_all('SELECT `id`, `name` FROM `locations` WHERE `id` != '.$user['location']);
//var_dump ($newLocation);
echo'Перелететь на планету:<br/>
<form action="newLocation" method="POST">
	<select name="new_location">';
		foreach($newLocations as $key => $location){
			echo'<option value="'.$location['id'].'">'.$location['name'].'</option>';
		}
	echo '</select><br/>
	<input type="submit" name="ok" value="Перелет"/>
</form>';