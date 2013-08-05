<?php
if(isset($_SESSION['id'])){
	$id = $_SESSION['id'];
	$result = mysql_query("SELECT `city` FROM `users` WHERE id='".$id."'");
	$myrow = mysql_fetch_array($result);
	
	if($_POST){
		$message = $_POST['message'];
		$userName = $myrow[0];
		$time=date("H:i",time());
	
		if(strlen($message)>=2){
			mysql_query ('INSERT INTO `chat`(`userName`, `message`, `time`) VALUES ("'.esc($userName).'","'.esc($message).'","'.$time.'")');
		}
	}
	echo '<div style="margin-left:20%; margin-right:20%">';
	echo '<a href="/chat">Обновить</a></br>'.$myrow[0].'
	<form action="" method="POST">
	Введите сообщение:</br>
	<input type="text" name="message"/></br>
	<input type="submit" name="ok" value="Отправить"/>
	<hr/>
	</form>';
	echo '</div>';
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
	$result = mysql_query("SELECT `id`, `userName`, `message`, `time` FROM `chat` ORDER BY `id` DESC LIMIT $start, $num"); 
	// В цикле переносим результаты запроса в массив $postrow 
	while ( $postrow[] = mysql_fetch_array($result)){
	} 

	echo '<div style="margin-left:20%; margin-right:20%"><table>'; 
	for($i = 0; $i < count($postrow); $i++)
	{ 
 	echo "<tr width='60%'>
         <td>".$postrow[$i]['userName'].":</td>
		 <td>".$postrow[$i]['time']."</td>
         </tr>
		<tr width='60%'>
		<td collspan = '2'>".$postrow[$i]['message']."
		<hr/></td>
		</tr>"; 
	} 
	echo '</table></div>'; 
	// Проверяем нужны ли стрелки назад 
	if ($page != 1){
	 $pervpage = '<a href="/chat?page=1">&lt;&lt;</a> <a href="/chat?page='.($page - 1).'">&lt;</a> '; 
	} else {
	  $prevpage = '';
	}
	// Проверяем нужны ли стрелки вперед 
	if ($page != $total) $nextpage = ' <a href="/chat?page='.($page + 1).'">&gt;</a> 
                                   <a href="/chat?page='.$total.'">&gt;&gt;</a>'; 

	// Находим две ближайшие сhтаницы с обоих краев, если они есть 
	if($page - 2 > 0) $page2left = ' <a href="/chat?page='. ($page - 2) .'">'. ($page - 2) .'</a> | '; 
	if($page - 1 > 0) $page1left = '<a href="/chat?page='. ($page - 1) .'">'. ($page - 1) .'</a> | '; 
	if($page + 2 <= $total) $page2right = ' | <a href="/chat?page='. ($page + 2) .'">'. ($page + 2) .'</a>'; 
	if($page + 1 <= $total) $page1right = ' | <a href="/chat?page='. ($page + 1) .'">'. ($page + 1) .'</a>';

	// Вывод меню 
	echo '<div style="margin-left:20%; margin-right:20%">';
	echo $pervpage.$page2left.$page1left.'<b>'.$page.'</b>'.$page1right.$page2right.$nextpage;
	echo '</div>';
}else{
	header ('Location: /index');
}
?>