<?php
header("Content-Type: text/html; charset=UTF-8");
include 'connect.php';
session_start();
error_reporting(E_ALL);

if(isset($_SESSION['id'])){
	include('index_authorized.php');
} else{
	include('index_not_authorized.php');
}
?>