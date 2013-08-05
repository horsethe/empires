<?php
header("Content-Type: text/html; charset=UTF-8");
include 'connect.php';
session_start();
error_reporting(E_ALL);

//var_dump ($_SERVER['REQUEST_URI']);
$pageName = substr($_SERVER['REQUEST_URI'], 1);
$simbolNum = strpos($pageName, '?');
if ($simbolNum != 0){
	$pageName = substr($pageName, 0, $simbolNum);
}
if ($pageName == 'index' || $pageName == ''){
	if(isset($_SESSION['id'])){
		$id = $_SESSION['id'];
		$data['userName'] = DB::get_value('SELECT `city` FROM `users` WHERE `id`="'.$id.'"');
		echo t('_header', $data);
		include('index_authorized.php');
		echo t('_footer');
	} else{
		include('index_not_authorized.php');
	}
} else{
	if(isset($_SESSION['id'])){
		$id = $_SESSION['id'];
		$data['userName'] = DB::get_value('SELECT `city` FROM `users` WHERE `id`="'.$id.'"');
		echo t('_header', $data);
		include (APP_DIR.'/'.$pageName.'.php');
		echo t('_footer');
	} else{
		include('index_not_authorized.php');
	}
}
?>