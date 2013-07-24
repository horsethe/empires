<?php
header("Content-Type: text/html; charset=UTF-8");

$link=mysql_connect('mysql.hostinger.ru','u891412166_chat','30011991') or die("Не могу подключиться к серверу БД(1)");
mysql_select_db("u891412166_chat",$link) or die("Не могу подключиться к БД");
mysql_set_charset('utf8', $link);
date_default_timezone_set('Europe/Moscow');

?>