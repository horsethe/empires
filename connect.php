<?php
header("Content-Type: text/html; charset=UTF-8");
$link=mysql_connect('localhost','h53305_belka','30011991') or die("Не могу подключиться к серверу БД(1)");
mysql_select_db('h53305_db',$link) or die("Не могу подключиться к БД");
mysql_set_charset('utf8', $link);
date_default_timezone_set('Europe/Moscow');

function post($key, $defValue=''){
     return isset($_POST[$key])?$_POST[$key]:$defValue;
}
?>