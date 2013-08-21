<?php
class DB {
	//выполняет запрос
	static function query($sql){
		$result = mysql_query($sql);
		if ($result === FALSE){
			echo 'Ошибка выполнения запроса:<br><pre>'.$sql.mysql_error();
			exit;
		}
		return $result;
	}

	//получает строку из базы 
	static function get_row($sql){
		$result = self::query($sql);
		$myrow = mysql_fetch_array($result);
		return  $myrow;
	}
	
	static function get_all($sql){
		$result = self::query($sql);
		$ans = array();
		while($myrow = mysql_fetch_array($result)){
			$ans[] = $myrow;
		}
		return  $ans;
	}
	
	//получает ай ди записи. полученной в результате запроса	
	static function get_id($sql){
		$result = self::query($sql);
		$myrow = mysql_insert_id();
		return  $myrow;
	}
	 
	static function get_value($sql){
		$result = self::query($sql);
		$myrow = mysql_fetch_array($result);
		return  $myrow[0];
	}
	
	static function arr2insert($data){
		foreach ($data as $key=>$val){
			if (!is_int($val)){
				$data[$key] = '"'.esc($val).'"';
				
			}
		}
		$part1 = implode(',',array_keys($data));
		$part2 = implode(',',array_values($data));
		return sprintf(' (%s) VALUES (%s)',$part1, $part2);
	}
	
	
}
