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
		include(APP_DIR.'/pages/index_authorized.php');
		echo t('_footer');
	} else{
		include(APP_DIR.'/pages/index_not_authorized.php');
	}
} else{
	if(isset($_SESSION['id'])){
		$id = $_SESSION['id'];
		$data['userName'] = DB::get_value('SELECT `city` FROM `users` WHERE `id`="'.$id.'"');
		//echo t('_header', $data);	
	}
	$url = APP_DIR.'/pages/'.$pageName.'.php';
	if(is_file($url)){
		include ($url);	
	} else {
		include (APP_DIR.'/pages/404.php');
	}
echo t('_footer');
}
