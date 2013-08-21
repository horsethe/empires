<?php
if ($_POST){
	$userId = $_SESSION['id'];
	$locationId = intval($_POST['new_location']);
	$result = DB::get_value('SELECT count(*) FROM `locations` WHERE  `id` = '.$locationId);
	
	if ($result){
		DB::query('UPDATE `users` SET `location`='.$locationId.' WHERE `id` = '.intval($userId));
	}
}
header('Location: /index');