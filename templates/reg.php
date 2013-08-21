<form action="" method="POST">
<b>Регистрация:</b><br/>
Логин<br/>
(может содержать от 2 до 16 русских или английских букв,цифр, знаков _,-,!):<br/>
<input type="text" name="log" value="<?php echo htmlspecialchars($data['log'])?>"/><br/>
Пароль<br/>
(может содержать от 6 до 16 английских букв,цифр, знаков _,-,!):<br/>
<input type="password" name="pass" value="<?php echo htmlspecialchars($data['pass1'])?>"/><br/>
Название страны<br/>
(может содержать от 2 до 16 русских или английских букв,цифр, знаков _,-,!):<br/>
<input type="text" name="city" value="<?php echo htmlspecialchars($data['city'])?>"/><br/>
Выберете специальность:<br/>
<select name="speciality">
	<option value="trader">Торговец</option>
	<option value="pirate">Пират</option>
	<option value="warrior">Воитель</option>
</select><br/>
<input type="submit" name="ok" value="Регистрация"/><br/>
Всего регистраций: <?php echo $data['usersCount']?><br/>
</form>