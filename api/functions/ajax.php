<?php 
require('../config.php');
require('model.php');


//Получаем переменные из супермассива $_POST
//Тут же их можно проверить на наличие инъекций
if(isset($_POST['act'])) {$act = $_POST['act'];}
if(isset($_POST['var1'])) {$var1 = $_POST['var1'];}
if(isset($_POST['var2'])) {$var2 = $_POST['var2'];}
if(isset($_POST['var3'])) {$var3 = $_POST['var3'];}

switch($_POST['act']) {//В зависимости от значения act вызываем разные функции
	case 'load': 
		$echo = load($mysqli, $var3); //Загружаем сообщения
	break;
	
	case 'send': 
		if(isset($var1)) {
			$echo = send($mysqli,$var1, $var3); //Отправляем сообщение
		}
	break;
	
	case 'auth': 
		if(isset($var1) && isset($var2)) {//Авторизуемся
			if(auth($mysqli,$var1,$var2)) {
				$echo = load($mysqli);
			}
		}
	break;
}

echo $echo;//Выводим результат работы кода