<?php
class User{
	public function __construct($login,$password){
		$this->login = $login;
		$this->password = $password;
	}
	public $son;
	public $login;
	public $password;
	public function adminCheck(){
		echo 'Мой логин:'.$this->login.'<br/>';
		if($this->login !== 'admin'){
			echo 'Это не админ';
		} else{
			if($this->password !== '123456'){
				echo 'Это лжеадмин';
			} else {
				echo 'Привет,Админ';
			}
		}
	}
	public function childsCheck(){
		if ($this->son){
			echo 'У пользователя '.$this->login.' сыном является '.$this->son->login.'<br/>';
		} else {
			echo 'У пользователя '.$this->login.' сына нету <br/>';
		}
	}
}
$me = new User('adminchik','123456');
//$me['login'] = 'admin';
//$me->login = 'admin';
//$me->password = '123456';
$fa = new User('admin','654321');
$fa->son = $me;
//echo $fa->son->login;
//$fa->password = '654321';
$fa->childsCheck();
$me->childsCheck();
