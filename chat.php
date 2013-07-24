<?php
header("Content-Type: text/html; charset=UTF-8");
include 'connect.php';
session_start();

if(isset($_SESSION['rand'])){
	$result = mysql_query("SELECT `nik` FROM `users` WHERE id='$id'");
	$myrow = mysql_fetch_array($result);
	
	if($_POST['ok']){
		$soob1 = $_POST['soob'];
		$name = $_SESSION['nik'];
		$soob= html_entity_decode ($soob1);
		$soob = trim ($soob1);
		$soob = strip_tags ($soob1);
		$time=date("H:i",time());
	}
	if((strlen($soob)>=2) and (strlen($soob)<=1000)){
		mysql_query ("INSERT INTO `chat`(`id`, `name`, `msg`, `time`) VALUES ('$id','$name','$soob','$time')");
	}
	
	echo '<a href="/chat.php">Обновить</a></br>',$_SESSION['nik'],'
	<form action="" method="POST">
	Введите сообщение:</br>
	<input type="text" name="soob"/></br>
	<input type="submit" name="ok" value="Отправить"/></br>
	----------------------
	</form>';
	$page2left = '';
	$page1left = '';
	$page1right = '';
	$page2right = '';
	$nextpage = '';
	$pervpage ='';
	// Переменная хранит число сообщений выводимых на станице 
	$num = 10; 
	// Извлекаем из URL текущую страницу 
	$page = isset($_GET['page'])?$_GET['page']:0;
	// Определяем общее число сообщений в базе данных 
	$result = mysql_query("SELECT COUNT(*) FROM `chat`"); 
	$posts = mysql_fetch_array($result);
	$posts = $posts[0]; 
	// Находим общее число страниц 
	$total = intval(($posts - 1) / $num) + 1; 
	// Определяем начало сообщений для текущей страницы 
	$page = intval($page); 
	// Если значение $page меньше единицы или отрицательно 
	// переходим на первую страницу 
	// А если слишком большое, то переходим на последнюю 
	if(empty($page) or $page < 0) $page = 1; 
	if($page > $total) $page = $total; 
	// Вычисляем начиная к какого номера 
	// следует выводить сообщения 
	$start = $page * $num - $num; 
	// Выбираем $num сообщений начиная с номера $start 
	$result = mysql_query("SELECT `id`, `name`, `msg`, `time` FROM `chat` ORDER BY `id` DESC LIMIT $start, $num"); 
	// В цикле переносим результаты запроса в массив $postrow 
	while ( $postrow[] = mysql_fetch_array($result)){
} 



echo "<table>"; 
for($i = 0; $i < count($postrow); $i++)
{ 
 echo "<tr>
         <td >".$postrow[$i]['name']."</td>
		 <td>".$postrow[$i]['time']."</td>
         </tr>
		<tr>
		<td collspan = '2'>".$postrow[$i]['msg']."
		<br>------------------------------------------------------------------------------------</td>
		</tr>"; 
	} 
	echo "</table>"; 

	// Проверяем нужны ли стрелки назад 
	if ($page != 1){
	 $pervpage = '<a href="/chat.php?page=1">&lt;&lt;</a> <a href="/pgn.php?page='. ($page - 1) .'">&lt;</a> '; 
	} else {
	  $prevpage = '';
	}
	// Проверяем нужны ли стрелки вперед 
	if ($page != $total) $nextpage = ' <a href="/chat.php?page='. ($page + 1) .'">&gt;</a> 
                                   <a href="/chat.php?page=' .$total. '">&gt;&gt;</a>'; 

	// Находим две ближайшие сhтаницы с обоих краев, если они есть 
	if($page - 2 > 0) $page2left = ' <a href="/chat.php?page='. ($page - 2) .'">'. ($page - 2) .'</a> | '; 
	if($page - 1 > 0) $page1left = '<a href="/chat.php?page='. ($page - 1) .'">'. ($page - 1) .'</a> | '; 
	if($page + 2 <= $total) $page2right = ' | <a href="/chat.php?page='. ($page + 2) .'">'. ($page + 2) .'</a>'; 
	if($page + 1 <= $total) $page1right = ' | <a href="/chat.php?page='. ($page + 1) .'">'. ($page + 1) .'</a>';

	// Вывод меню 
	echo $pervpage.$page2left.$page1left.'<b>'.$page.'</b>'.$page1right.$page2right.$nextpage;
	
	echo "<br><a href='/exit.php'>Выход</a>";
}else{
	echo "Нет доступа!</br>
	<a href='index.php'>На главную</a></br>";
}
?>