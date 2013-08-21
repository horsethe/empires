<?php
header("Content-Type: text/html; charset=UTF-8");
define('APP_DIR', __DIR__);
include ('balance.php');
include ('config.php');
define('PASSWORD_SALT', 'p2n4v3j');
$link=mysql_connect(getCfg('db_host'),getCfg('db_login'),getCfg('db_password')) or die("Не могу подключиться к серверу БД(1)");
mysql_select_db(getCfg('db_name'),$link) or die("Не могу подключиться к БД");
mysql_set_charset('utf8', $link);
date_default_timezone_set('Europe/Moscow');
spl_autoload_register(function ($class) {
    include APP_DIR.'/classes/' . $class . '.class.php';
});


function post($key, $defValue=''){
     return isset($_POST[$key])?$_POST[$key]:$defValue;
}

function esc($val){
	return mysql_real_escape_string($val);
}

function t($templateName, $data=array()){
	ob_start();
	include(APP_DIR.'/templates/'.$templateName.'.php');
	return ob_get_clean();
}
function getCfg($key){
	global $config;
	if (isset($config[$key])){
		return $config[$key];
	} else {
		return NULL;
	}
}