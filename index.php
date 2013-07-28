<?php
header("Content-Type: text/html; charset=UTF-8");
include 'connect.php';
session_start();
error_reporting(E_ALL);

if(isset($_SESSION['id'])){
	echo 'Вы авторизованы';
} else{
	echo 'Вы не авторизованы';
}
?>