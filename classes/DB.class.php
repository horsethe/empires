<?php
class DB {
	//получает строку из базы 
	static function get_row($sql){
		$result = mysql_query($sql);
		if ($result === FALSE){
			echo 'Ошибка выполнения запроса:<br><pre>'.$sql.mysql_error();
			exit;
		}
		$myrow = mysql_fetch_array($result);
		return  $myrow;
	}
	
	//получает ай ди записи. полученной в результате запроса	
	static function get_id($sql){
		$result = mysql_query($sql);
		if ($result === FALSE){
			echo 'Ошибка выполнения запроса:<br><pre>'.$sql.mysql_error();
			exit;
		}
		$myrow = mysql_insert_id();
		return  $myrow;
	}
	 
	static function get_value($sql){
		$result = mysql_query($sql);
		if ($result === FALSE){
			echo 'Ошибка выполнения запроса:<br><pre>'.$sql.mysql_error();
			exit;
		}
		$myrow = mysql_fetch_array($result);
		return  $myrow[0];
	}
}
