<?php
header("Content-Type: text/html; charset=UTF-8");
include 'connect.php';
session_start();
error_reporting(E_ALL);

if(isset($_SESSION['id'])){
	$id = $_SESSION['id'];
	$data['userName'] = DB::get_row('SELECT `city` FROM `users` WHERE `id`="'.$id.'"');
	echo t('_header', $data);
	include('index_authorized.php');
	echo t('_footer');
} else{
	include('index_not_authorized.php');
}
?>