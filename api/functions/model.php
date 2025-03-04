<?

// Функция для распечатки массива
function print_arr($arr){
    echo "<pre>";
    print_r($arr);
    echo "</pre>";
}

// Функция редирект
function redirect($http = false){
    if($http){
        $redirect = $http;
    }else{
        $redirect = isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER']: PATH;
    }
    header("Location: $redirect");
    exit;
}

// Функция авторизации
function auth($mysqli){
    $login = trim($_POST['login']);
    $password = trim($_POST['password']);

    if(empty($login) || empty($password)) {
        $_SESSION['auth']['error'] = "<div class='error border'> Ошибка! Поля не заполнены!</div>";
    } else {
        $res = $mysqli->query(" SELECT users.*, roles.role_name FROM users
                                JOIN roles ON roles.id_role = users.id_role
                                WHERE login = '$login' AND password = '$password'");
        if (!$res) {  // Если запрос к базе не отработал
            $_SESSION['auth']['error'] = "<div class='error'>" . $mysqli->error . "</div>";
        } else {
            if ($res->num_rows == 0) {
                $_SESSION['auth']['error'] = "<div class='error border'>Ошибка! Логин или пароль введены некорректно</div>";
            } else {
                $row = $res->fetch_assoc();

                $_SESSION['auth']['id_user'] = $row['id_user'];
                $_SESSION['auth']['login'] = $row['login'];
                $_SESSION['auth']['name'] = $row['name'];
                $_SESSION['auth']['surname'] = $row['surname'];
                $_SESSION['auth']['patronymic'] = $row['patronymic'];
                $_SESSION['auth']['phone'] = $row['phone'];
                $_SESSION['auth']['password'] = $row['password'];
                $_SESSION['auth']['role'] = $row['role_name'];
                $_SESSION['auth']['id_role'] = $row['id_role'];
                $_SESSION['auth']['mail'] = $row['mail'];
                $_SESSION['auth']['avatar'] = $row['img'];

                $_SESSION['auth']['check_rate_user'] = 0;

                $_SESSION['auth']['success'] = "Вы успешно авторизировались в системе!";
            }
        }
    }
}


/*function load($mysqli) {
    $id_user = $_SESSION['auth']['id_user'];
	$echo = "";
	if(isset($_SESSION['auth'])) {//Проверяем успешность авторизации
		$result = $mysqli->query(" SELECT * FROM chat WHERE "); //Запрашиваем сообщения из базы
		if($result) {
			if($result->num_rows >= 1) {
				while($array = mysqli_fetch_array($result)) {//Выводим их с помощью цикла
					$user_result = $mysqli->query("SELECT * FROM chat WHERE chat.id_user = $id_user");//Получаем данные об авторе сообщения
					if(mysqli_num_rows($user_result) == 1) {
						$user = $user_result->fetch_array();
						$echo .= "<div class='chat__message chat__message_$user[nick_color]'><b>$user[login]:</b> $array[message]</div>"; //Добавляем сообщения в переменную $echo
					}
				}
			} else {
				$echo = "Нет сообщений!";//В базе ноль записей
			}
		}
	} else {
		$echo = "Проблема авторизации";//Авторизация не удалась
	}
	return $echo;//Возвращаем результат работы функции
}*/

function load($mysqli, $id_order) {

    $id_user = $_SESSION['auth']['id_user'];
    $login =  $_SESSION['auth']['login'];
	if(isset($_SESSION['auth'])) {//Проверяем успешность авторизации
		$result = $mysqli->query("SELECT chat.*, users.name, users.surname, users.login, users.img, roles.role_name, roles.id_role FROM chat
                                JOIN users ON users.id_user = chat.id_user
                                JOIN roles ON roles.id_role = users.id_role
                                JOIN orders ON orders.id_order = chat.id_order
                                WHERE chat.id_order = $id_order
                                ORDER BY `time` ASC"); //Запрашиваем сообщения из базы
		if($result) {
			if($result->num_rows >= 1) {
				while($array = mysqli_fetch_array($result)) {//Выводим их с помощью цикла
                    if(!empty($array['img'])){
                        $path_avatar = FILES.$array['img'];
                    }
                    else{
                        $path_avatar = FILES.'0.jpg';
                    }

// Проверка по айдишнику роли, цвета для ролей
                    if($array['id_role'] == 1){
                        $color = 'rgb(30, 144, 255);';
                    }elseif($array['id_role'] == 2){
                        $color = '#FEBB0B';
                    }else{
                        $color = 'darksalmon';
                    }
// Проверка по айдишнику роли, цвета для ролей

// Проверка для вывода свои сообщений по правой стороне
                    if($array['id_user'] == $id_user){
                        $message = "<div class='chat__message myMessage'>
                        <img class='chats-avatar' src='".$path_avatar."'>
                        <b>  $array[login] | <span style='color: ".$color."'>$array[role_name]</span> | $array[name] $array[surname]:</b> <br> $array[message]
                        <div class='myTime'>".date("m.d H:i:s", strtotime($array['time']))."</div>
                        </div>";
                    }else{
                        $message = "<div class='chat__message'>
                        <img class='chats-avatar' src='".$path_avatar."'>
                        <b>  $array[login] | <span style='color: ".$color."'>$array[role_name]</span> | $array[name] $array[surname]:</b> <br> $array[message]
                        <div class='text-right time'>".date("m.d H:i:s", strtotime($array['time']))."</div>
                        </div>";
                    }
// Проверка для вывода свои сообщений по правой стороне

						$echo .= $message; //Добавляем сообщения в переменную $echo
				}
			} else {
				$echo = "Нет сообщений!";//В базе ноль записей
			}
		}
	} else {
		$echo = "Проблема авторизации";//Авторизация не удалась
	}
	return $echo;//Возвращаем результат работы функции
}

function send($mysqli,$message, $id_order) {
    date_default_timezone_set('Asia/Novokuznetsk');
    $id_user = $_SESSION['auth']['id_user'];
    $time = date('Y-m-d H:i:s');
    $user_orders = all_user_orders($mysqli);
		$message = htmlspecialchars($message);//Заменяем символы ‘<’ и ‘>’на ASCII-код
		$message = trim($message); //Удаляем лишние пробелы
		$message = addslashes($message); //Экранируем запрещенные символы
		$result = $mysqli->query("INSERT INTO chat (id_user,message,time,id_order) VALUES ($id_user,'$message','$time', $id_order)");//Заносим сообщение в базу данных
	return load($mysqli); //Вызываем функцию загрузки сообщений
}

// Функция регистрации
function register($mysqli){
    // собираем данные с формы
    $role_list = 3;
    $login = trim($_POST["login"]);
    $password = trim($_POST["password"]);
    $mail = trim($_POST["mail"]);
    $surname = trim($_POST["surname"]);
    $name = trim($_POST["name"]);
    $patronymic = trim($_POST["patronymic"]);
    $phone = trim($_POST["phone"]);

    // проверка на пустоту
    if(empty($login) || empty($mail) || empty($password) || empty($role_list) || empty($surname) || empty($name) || empty($patronymic) || empty($phone)){
        $_SESSION['answer'] = "<div class='alert alert-danger alert-dismissible fade show' role='alert'> Вводимое поле/поля пусты! <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Закрыть'></button> </div>";
        return false;
    }else{
        // Блок с проверкой на одинаковую запись
        $check = $mysqli -> query("SELECT * FROM users WHERE login = '$login'");
        if ($check -> num_rows > 0){
            $_SESSION['answer'] = "<div class='alert alert-danger alert-dismissible fade show' role='alert'> Данная запись уже существует! <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Закрыть'></button> </div>" ;
            return false;
        //
        }else{
            $sql = $mysqli -> query("INSERT INTO users SET login = '$login', password = '$password', mail = '$mail', id_role = $role_list, surname = '$surname', name = '$name', patronymic = '$patronymic', phone = '$phone'");
            if($sql){
                $_SESSION['answer'] = "<div class='alert alert-success alert-dismissible fade show' role='alert'> Вы успешно зарегестрировались, зайдите в систему! <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Закрыть'></button> </div>";
                return true;
            }else{
                echo $mysqli -> error;
            }
        }
    }
}

define('MY_FUNCTION_CALLED', false);
function myFunction() {
    if (MY_FUNCTION_CALLED === false && isset($_SESSION['auth']['success'])) {
        echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>".
                $_SESSION['auth']['success'].
                "<button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Закрыть'></button>
            </div>";
        MY_FUNCTION_CALLED == true;
    }
}

// функции поиска по пользователям
function search_users($mysqli, $text_search){
	$res = $mysqli->query("SELECT users.*, roles.role_name FROM users
                        JOIN roles ON roles.id_role = users.id_role
                        WHERE REPLACE(users.login, ' ', '') LIKE REPLACE('%$text_search%', ' ', '')
                        OR REPLACE(users.surname, ' ', '') LIKE REPLACE('%$text_search%', ' ', '')
                        OR REPLACE(users.name, ' ', '') LIKE REPLACE('%$text_search%', ' ', '')
                        OR REPLACE(users.patronymic, ' ', '') LIKE REPLACE('%$text_search%', ' ', '')
                        OR REPLACE(users.phone, ' ', '') LIKE REPLACE('%$text_search%', ' ', '')
                        OR REPLACE(roles.role_name, ' ', '') LIKE REPLACE('%$text_search%', ' ', '')
                        OR REPLACE(users.mail, ' ', '') LIKE REPLACE('%$text_search%', ' ', '')");
    if($res->num_rows > 0){
        while($row = $res->fetch_assoc()){
            $users_search[] = $row;
        }
        return $users_search;
    }
}

// функции поиска для таблицы cars
function search_cars($mysqli, $text_search){
	$res = $mysqli->query("SELECT * FROM cars
                        WHERE REPLACE(brand, ' ', '') LIKE REPLACE('%$text_search%', ' ', '')
                        OR REPLACE(gov_number, ' ', '') LIKE REPLACE('%$text_search%', ' ', '')
                        OR REPLACE(type_car, ' ', '') LIKE REPLACE('%$text_search%', ' ', '')
                        OR REPLACE(color, ' ', '') LIKE REPLACE('%$text_search%', ' ', '')");
    if($res->num_rows > 0){
        while($row = $res->fetch_assoc()){
            $cars_search[] = $row;
        }
        return $cars_search;
    }
}

// функции поиска для таблицы clients
function search_clients($mysqli, $text_search){
	$res = $mysqli->query("SELECT clients.*, users.login, users.surname, users.name, users.patronymic, users.phone FROM clients
                        WHERE REPLACE(users.login, ' ', '') LIKE REPLACE('%$text_search%', ' ', '')
                        OR REPLACE(users.surname, ' ', '') LIKE REPLACE('%$text_search%', ' ', '')
                        OR REPLACE(users.name, ' ', '') LIKE REPLACE('%$text_search%', ' ', '')
                        OR REPLACE(users.patronymic, ' ', '') LIKE REPLACE('%$text_search%', ' ', '')
                        OR REPLACE(users.phone, ' ', '') LIKE REPLACE('%$text_search%', ' ', '')
                        OR REPLACE(clients.rating, ' ', '') LIKE REPLACE('%$text_search%', ' ', '')");
    if($res->num_rows > 0){
        while($row = $res->fetch_assoc()){
            $clients_search[] = $row;
        }
        return $clients_search;
    }
}

// функции поиска для таблицы tarif
function search_tarif($mysqli, $text_search){
	$res = $mysqli->query("SELECT * FROM tarif
                        WHERE REPLACE(tarif_name, ' ', '') LIKE REPLACE('%$text_search%', ' ', '')
                        OR REPLACE(tarif_cost, ' ', '') LIKE REPLACE('%$text_search%', ' ', '')");
    if($res->num_rows > 0){
        while($row = $res->fetch_assoc()){
            $tarif_search[] = $row;
        }
        return $tarif_search;
    }
}

// функции поиска для таблицы tarif
function search_uslugs($mysqli, $text_search){
	$res = $mysqli->query("SELECT * FROM uslugs
                        WHERE REPLACE(name_uslug, ' ', '') LIKE REPLACE('%$text_search%', ' ', '')");
    if($res->num_rows > 0){
        while($row = $res->fetch_assoc()){
            $uslug_search[] = $row;
        }
        return $uslug_search;
    }
}

// функции поиска для таблицы drivers
function search_drivers($mysqli, $text_search){
	$res = $mysqli->query("SELECT drivers.*, tarif.tarif_name, uslugs.name_uslug, cars.brand, users.login, users.surname, users.name, users.patronymic, users.phone FROM drivers
                        JOIN tarif ON tarif.id_tarif = drivers.id_tarif
                        JOIN uslugs ON uslugs.id_uslug = drivers.id_uslug
                        JOIN cars ON cars.id_car = drivers.id_car
                        JOIN users ON users.id_user = drivers.id_user
                        WHERE REPLACE(users.login, ' ', '') LIKE REPLACE('%$text_search%', ' ', '')
                        OR REPLACE(users.surname, ' ', '') LIKE REPLACE('%$text_search%', ' ', '')
                        OR REPLACE(users.name, ' ', '') LIKE REPLACE('%$text_search%', ' ', '')
                        OR REPLACE(users.patronymic, ' ', '') LIKE REPLACE('%$text_search%', ' ', '')
                        OR REPLACE(users.phone, ' ', '') LIKE REPLACE('%$text_search%', ' ', '')
                        OR REPLACE(tarif.tarif_name, ' ', '') LIKE REPLACE('%$text_search%', ' ', '')
                        OR REPLACE(uslugs.name_uslug, ' ', '') LIKE REPLACE('%$text_search%', ' ', '')
                        OR REPLACE(cars.brand, ' ', '') LIKE REPLACE('%$text_search%', ' ', '')
                        OR REPLACE(drivers.rating, ' ', '') LIKE REPLACE('%$text_search%', ' ', '')");
    if($res->num_rows > 0){
        while($row = $res->fetch_assoc()){
            $drivers_search[] = $row;
        }
        return $drivers_search;
    }
}

// Функция вывода пользователей из базы данных
function all_users($mysqli){
    $sql = $mysqli -> query("SELECT users.*, roles.role_name FROM users
                            JOIN roles ON roles.id_role = users.id_role
                            WHERE users.id_role = roles.id_role");
    while($row = $sql -> fetch_assoc()){
        $c[] = $row;
    }
    return $c;
}

//Функция вывода пользователей из базы данных
function all_drivers($mysqli){
    $sql = $mysqli -> query("SELECT tarif.tarif_name, uslugs.name_uslug, cars.brand, users.* FROM users
                            JOIN tarif ON tarif.id_tarif = users.id_tarif
                            JOIN uslugs ON uslugs.id_uslug = users.id_uslug
                            JOIN cars ON cars.id_car = users.id_car
                            WHERE users.id_role = 2");
    while($row = $sql -> fetch_assoc()){
        $c[] = $row;
    }
    return $c;
}

//Функция вывода заказов
function all_user_orders($mysqli){
    $id_user = $_SESSION['auth']['id_user'];
    $id_role = $_SESSION['auth']['id_role'];
    if($id_role == 2){
        $sql = $mysqli -> query("SELECT orders.*, status_order.*, tarif.tarif_name, users.surname AS surname_driver, users.name AS name_driver, users.phone AS phone_driver FROM orders
        JOIN status_order ON orders.id_status = status_order.id_status 
        JOIN tarif ON tarif.id_tarif = orders.id_tarif
        JOIN users ON users.id_user = orders.id_driver
        WHERE orders.id_driver = '$id_user' AND orders.id_status < 7"); 
        if($sql->num_rows == 0){
            $sql = $mysqli -> query("SELECT orders.*, status_order.*, tarif.tarif_name FROM orders
            JOIN status_order ON orders.id_status = status_order.id_status
            JOIN tarif ON tarif.id_tarif = orders.id_tarif 
            WHERE orders.id_driver IS NULL AND orders.id_status < 7");
        }
    }else{
        $sql = $mysqli -> query("SELECT orders.*, status_order.*, tarif.tarif_name FROM orders
                            JOIN status_order ON orders.id_status = status_order.id_status
                            JOIN tarif ON tarif.id_tarif = orders.id_tarif
                            WHERE id_client = $id_user AND orders.id_status < 7");  
    }
    
    while($row = $sql -> fetch_assoc()){
        $c[] = $row;
    }
    return $c;
}

function count_user_order_complete($mysqli){
    $id_user = $_SESSION['auth']['id_user'];
    $id_role = $_SESSION['auth']['id_role'];
    if($id_role == 2){
        $sql = $mysqli -> query("SELECT orders.*, status_order.*, users.* FROM orders
        JOIN status_order ON orders.id_status = status_order.id_status
        JOIN users ON users.id_user = orders.id_driver
        WHERE orders.id_driver = '$id_user' AND orders.id_status = 7");
    }else{
        $sql = $mysqli -> query("SELECT orders.*, status_order.*, tarif.tarif_name FROM orders
                            JOIN status_order ON orders.id_status = status_order.id_status
                            JOIN tarif ON tarif.id_tarif = orders.id_tarif
                            WHERE id_client = $id_user AND orders.id_status = 7");
    }
    
    while($row = $sql -> fetch_assoc()){
        $c[] = $row;
    }
    return $c;
}

function count_user_order_complete_today($mysqli){
    $id_user = $_SESSION['auth']['id_user'];
    $id_role = $_SESSION['auth']['id_role'];
    $date = date('Y-m-d');
    if($id_role == 2){
        $sql = $mysqli -> query("SELECT orders.*, status_order.*, users.* FROM orders
        JOIN status_order ON orders.id_status = status_order.id_status
        JOIN users ON users.id_user = orders.id_driver
        WHERE orders.id_driver = '14' AND orders.id_status = 7 AND DATE(date_complete_order) = '$date'");
    while($row = $sql -> fetch_assoc()){
        $c[] = $row;
    }
    return $c;
    }
}

// Функция вывода машин из базы данных
function all_cars($mysqli){
    $sql = $mysqli -> query("SELECT * FROM cars");
    while($row = $sql -> fetch_assoc()){
        $c[] = $row;
    }
    return $c;
}

// Функция вывода клиентов из базы данных
function all_clients($mysqli){
    $sql = $mysqli -> query("SELECT * FROM clients");
    while($row = $sql -> fetch_assoc()){
        $c[] = $row;
    }
    return $c;
}

// Функция вывода клиентов из базы данных
function all_application_drivers($mysqli){
    $sql = $mysqli -> query("SELECT * FROM application_driver WHERE `status` = 1");
    while($row = $sql -> fetch_assoc()){
        $c[] = $row;
    }
    return $c;
}

// Функция вывода всех ролей из базы данных
function user_rating($mysqli){
    $id_user = $_SESSION['auth']['id_user'];
    $sql = $mysqli -> query("SELECT * FROM rating WHERE id_user = $id_user");
    while($row = $sql -> fetch_assoc()){
        $c[] = $row;
    }
    return $c;
}

// Функция вывода всех ролей из базы данных
function all_roles($mysqli){
    $sql = $mysqli -> query("SELECT * FROM roles");
    while($row = $sql -> fetch_assoc()){
        $c[] = $row;
    }
    return $c;
}

function all_tarifs($mysqli){
        $sql = $mysqli -> query("SELECT * FROM tarif ORDER BY tarif_cost ASC");
        while($row = $sql -> fetch_assoc()){
            $c[] = $row;
        }
        return $c;
}

// Функция вывода всех ролей из базы данных
function all_uslugs($mysqli){
    $sql = $mysqli -> query("SELECT * FROM uslugs");
    while($row = $sql -> fetch_assoc()){
        $c[] = $row;
    }
    return $c;
}

// ФУНКЦИЯ С ДОБАВЛЕНИЕМ НОВОГО ПОЛЬЗОВАТЕЛЯ В ТАБЛИЦУ
function add_user($mysqli){
    // собираем данные с формы
    $role_list = $_POST['role_list'];
    $login = trim($_POST["login"]);
    $password = trim($_POST["password"]);
    $phone = trim($_POST["phone"]);
    $surname = trim($_POST["surname"]);
    $name = trim($_POST["name"]);
    $patronymic = trim($_POST["patronymic"]);
    $mail = trim($_POST["mail"]);

    // проверка на пустоту
    if(empty($login) || empty($mail) || empty($password) || empty($role_list) || empty($phone) || empty($surname) || empty($name) || empty($patronymic)){
        $_SESSION['answer'] = "<div class='alert alert-danger alert-dismissible fade show' role='alert'> Вводимое поле/поля пусты! <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Закрыть'></button> </div>";
        return false;
    }else{
        // Блок с проверкой на одинаковую запись
        $check = $mysqli -> query("SELECT * FROM users WHERE login = '$login'");
        if ($check -> num_rows > 0){
            $_SESSION['answer'] = "<div class='alert alert-danger alert-dismissible fade show' role='alert'> Пользователь с таким логином уже существует! <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Закрыть'></button> </div>" ;
            return false;
        //
        }else{
            $sql = $mysqli -> query("INSERT INTO users SET login = '$login', password = '$password', surname = '$surname', name = '$name', patronymic = '$patronymic', phone = '$phone', id_role = $role_list, mail = '$mail'");
            if($sql){
                $id_user = $mysqli->insert_id;
                echo $id_user;
                $_SESSION['answer'] = "<div class='alert alert-success alert-dismissible fade show' role='alert'> Пользователь добавлен в таблицу! <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Закрыть'></button> </div>";
                if($role_list == 2){
                    add_driver($mysqli, $id_user);
                }
                return true;
            }else{
                echo $mysqli -> error;
            }
        }
    }
}


// ФУНКЦИЯ С ДОБАВЛЕНИЕМ водителя В ТАБЛИЦУ
function add_driver($mysqli, $id){
    // собираем данные с формы
    $car_list = $_POST['car-list'];
    $tarif_list = $_POST['tarif-list'];
    $uslug_list = $_POST['uslug-list'];

    /*$surname = trim($_POST["surname-driver"]);
    $name = trim($_POST["name-driver"]);
    $patronymic = trim($_POST["patronymic-driver"]);
    $phone = trim($_POST["phone-driver"]);
    $rating = trim($_POST["rating-driver"]);*/

        // Блок с проверкой на одинаковую запись
        // $check = $mysqli -> query("SELECT * FROM drivers WHERE surname = '$surname' AND name = '$name' AND patronymic = '$patronymic' AND phone = '$phone' AND id_car = $car_list AND id_tarif = $tarif_list AND id_uslug = $uslug_list");
        // if ($check -> num_rows > 0){
        //     $_SESSION['answer'] = "<div class='alert alert-danger alert-dismissible fade show' role='alert'> Данная запись уже существует! <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Закрыть'></button> </div>" ;
        //     return false;
        // }else{
            $sql = $mysqli -> query("INSERT INTO drivers SET id_car = $car_list, id_tarif = $tarif_list, id_uslug = $uslug_list, id_user = $id");
            if($sql){
                $_SESSION['answer'] = "<div class='alert alert-success alert-dismissible fade show' role='alert'> Водитель добавлен в таблицу! <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Закрыть'></button> </div>";
                return true;
            }else{
                echo $mysqli -> error;
            }
        }

// }

// ФУНКЦИЯ С ДОБАВЛЕНИЕМ НОВОГО водителя на трудоустройство
function add_driver_application($mysqli){
    // собираем данные с формы
    $id_user = trim($_POST["id_user"]);
    $surname = trim($_POST["surname__user"]);
    $name = trim($_POST["name__user"]);
    $patronymic = trim($_POST["patronymic__user"]);
    $phone = trim($_POST["phone__number"]);
    $car = trim($_POST["brand__car"]);
    $driving_age = trim($_POST["age__drive"]);
    $license = trim($_POST["license__number"]);

        // Блок с проверкой на одинаковую запись
       $check = $mysqli -> query("SELECT * FROM application_driver WHERE id_user = $id_user AND `status` = 1");
        if ($check -> num_rows > 0){
            $_SESSION['answer'] = "<div class='alert alert-danger alert-dismissible fade show' role='alert'> Вы уже подали заявку, ожидайте звонка! <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Закрыть'></button> </div>" ;
            return false;
        //
        }else{
            $sql = $mysqli -> query("INSERT INTO application_driver SET surname = '$surname', name = '$name', patronymic = '$patronymic', phone = '$phone', brand_car = '$car', driving_age = '$driving_age', license = '$license', id_user = $id_user, `status` = 1");
            if($sql){
                $_SESSION['answer'] = "<div class='alert alert-success alert-dismissible fade show' role='alert'>Спасибо что оставили заявку!<br>Через некоторое время администратор свяжется с вами, ожидайте!<button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Закрыть'></button> </div>";
                return true;
            }else{
                echo $mysqli -> error;
            }
        }
}

// ФУНКЦИЯ принятия на работу
function confirm_driver_application($mysqli){
    // собираем данные с формы
    
    $id_user = trim($_POST["confirm__application"]);

            $sql = $mysqli -> query("UPDATE application_driver SET `status` = 2 WHERE id_user = $id_user");
            if($sql){
                $_SESSION['answer'] = "<div class='alert alert-success alert-dismissible fade show' role='alert'>Водитель принят на работу!<button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Закрыть'></button> </div>";
                $sql = $mysqli -> query("UPDATE users SET id_role = 2 
                                            WHERE id_user = $id_user");
                return true;
            }else{
                echo $mysqli -> error;
            }
        }

function discard__application($mysqli){
    // собираем данные с формы
    
    $id_user = trim($_POST["discard__application"]);

    $sql = $mysqli -> query("UPDATE application_driver SET `status` = 2 WHERE id_user = $id_user");
    if($sql){
        $_SESSION['answer'] = "<div class='alert alert-danger alert-dismissible fade show' role='alert'>Заявка отменена!<button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Закрыть'></button> </div>";
        return true;
    }else{
        echo $mysqli -> error;
    }
}

// ФУНКЦИЯ С ДОБАВЛЕНИЕМ НОВОГО клиента В ТАБЛИЦУ
function add_client($mysqli){
    // собираем данные с формы
    $surname = trim($_POST["surname"]);
    $name = trim($_POST["name"]);
    $patronymic = trim($_POST["patronymic"]);
    $phone = trim($_POST["phone"]);
    $rating_list = $_POST['rating_list'];

    // проверка на пустоту
    if(empty($surname) || empty($name) || empty($patronymic) || empty($phone) || empty($rating_list)){
        $_SESSION['answer'] = "<div class='alert alert-danger alert-dismissible fade show' role='alert'> Вводимое поле/поля пусты! <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Закрыть'></button> </div>";
        return false;
    }else{
        // Блок с проверкой на одинаковую запись
        $check = $mysqli -> query("SELECT * FROM clients WHERE surname = '$surname' AND name = '$name' AND patronymic = '$patronymic' AND phone = '$phone' AND rating = $rating_list");
        if ($check -> num_rows > 0){
            $_SESSION['answer'] = "<div class='alert alert-danger alert-dismissible fade show' role='alert'> Данная запись уже существует! <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Закрыть'></button> </div>" ;
            return false;
        //
        }else{
            $sql = $mysqli -> query("INSERT INTO clients SET surname = '$surname', name = '$name', patronymic = '$patronymic', phone = '$phone', rating = $rating_list");
            if($sql){
                $_SESSION['answer'] = "<div class='alert alert-success alert-dismissible fade show' role='alert'> Клиент добавлен в таблицу! <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Закрыть'></button> </div>";
                return true;
            }else{
                echo $mysqli -> error;
            }
        }
    }
}

// ФУНКЦИЯ С ДОБАВЛЕНИЕМ НОВОГО ПОЛЬЗОВАТЕЛЯ В ТАБЛИЦУ
function add_car($mysqli){
    // собираем данные с формы
    $brand = trim($_POST["brand-car-add"]);
    $color = trim($_POST["color-car-add"]);
    $type = trim($_POST["type-car-add"]);
    $gov = trim($_POST["gov-number-add"]);

    // проверка на пустоту
    if(empty($brand) || empty($type) || empty($color) || empty($gov)){
        $_SESSION['answer'] = "<div class='alert alert-danger alert-dismissible fade show' role='alert'> Вводимое поле/поля пусты! <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Закрыть'></button> </div>";
        return false;
    }else{
        // Блок с проверкой на одинаковую запись
        $check = $mysqli -> query("SELECT * FROM cars WHERE brand = '$brand' AND color = '$color' AND type_car = '$type' AND gov_number = '$gov'");
        if ($check -> num_rows > 0){
            $_SESSION['answer'] = "<div class='alert alert-danger alert-dismissible fade show' role='alert'> Данная запись уже существует! <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Закрыть'></button> </div>" ;
            return false;
        //
        }else{
            $sql = $mysqli -> query("INSERT INTO cars SET brand = '$brand', color = '$color', type_car = '$type', gov_number = '$gov'");
            if($sql){
                $_SESSION['answer'] = "<div class='alert alert-success alert-dismissible fade show' role='alert'> Машина добавлена в таблицу! <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Закрыть'></button> </div>";
                return true;
            }else{
                echo $mysqli -> error;
            }
        }
    }
}

// ФУНКЦИЯ С ДОБАВЛЕНИЕМ НОВОГО ПОЛЬЗОВАТЕЛЯ В ТАБЛИЦУ
function add_uslugs($mysqli){
    // собираем данные с формы
    $name_uslug = trim($_POST["usluga"]);

    // проверка на пустоту
    if(empty($name_uslug)){
        $_SESSION['answer'] = "<div class='alert alert-danger alert-dismissible fade show' role='alert'> Вводимое поле/поля пусты! <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Закрыть'></button> </div>";
        return false;
    }else{
        // Блок с проверкой на одинаковую запись
        $check = $mysqli -> query("SELECT * FROM uslugs WHERE name_uslug = '$name_uslug'");
        if ($check -> num_rows > 0){
            $_SESSION['answer'] = "<div class='alert alert-danger alert-dismissible fade show' role='alert'> Данная запись уже существует! <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Закрыть'></button> </div>" ;
            return false;
        //
        }else{
            $sql = $mysqli -> query("INSERT INTO uslugs SET name_uslug = '$name_uslug'");
            if($sql){
                $_SESSION['answer'] = "<div class='alert alert-success alert-dismissible fade show' role='alert'> Услуга добавлена в таблицу! <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Закрыть'></button> </div>";
                return true;
            }else{
                echo $mysqli -> error;
            }
        }
    }
}

// ФУНКЦИЯ С ДОБАВЛЕНИЕМ НОВОГО заказа
function add_order($mysqli){
    date_default_timezone_set('Asia/Novokuznetsk');
        // собираем данные с формы

        $city__out = trim($_POST["city__out"]);
        $street__out = trim($_POST["street__out"]);
        $house__out = trim($_POST["house__out"]);

        $city__come = trim($_POST["city__come"]);
        $street__come = trim($_POST["street__come"]);
        $house__come = trim($_POST["house__come"]);

        $id_client = $_SESSION['auth']['id_user'];
        $client_name = trim($_POST["name__user"]);
        $client_phone = trim($_POST["phone__number"]);
        $date_order = date('Y-m-d H:i:s');
        $status = 2;
        $tarif = $_POST['tarif_list'];
        $comment = trim($_POST["comment"]);

        $address_out = $city__out.', '.$street__out.', '.$house__out;
        $address_come = $city__come.', '.$street__come.', '.$house__come;

                //$sql = $mysqli -> query("INSERT INTO `orders` (`id_client`, `address_out`, `address_come`, `date_order`, `status`, `id_tarif`) VALUES ('$id_client', '$address_out', '$address_come', '$date_order', '$status', '$id_tarif')");
                $sql = $mysqli -> query("INSERT INTO orders SET id_client = $id_client, client_name = '$client_name', client_phone = '$client_phone', address_out = '$address_out', address_come = '$address_come', date_order = '$date_order', `id_status` = '$status', id_tarif = $tarif, comment = '$comment'");
                if($sql){
                    $_SESSION['answer'] = "<div class='alert alert-success alert-dismissible fade show' role='alert'> Ваш заказ оформлен, ожидайте водителя! <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Закрыть'></button> </div>";
                    $_SESSION['status_order'] = $status;
                    return true;
                }else{
                    echo $mysqli -> error;
                }
            }

function confirm__order($mysqli){
    date_default_timezone_set('Asia/Novokuznetsk');
    $id_driver = $_SESSION['auth']['id_user'];
    $id_order = $_POST['confirm__order'];
    $date_confirm_order = date('Y-m-d H:i:s');
    $status = 3;

            
            $sql = $mysqli -> query("UPDATE orders SET id_driver = $id_driver, date_confirm_order = '$date_confirm_order', `id_status` = '$status'
                                    WHERE id_order = $id_order");
            if($sql){
                $_SESSION['answer'] = "<div class='alert alert-success alert-dismissible fade show' role='alert'> Заказ принят! <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Закрыть'></button> </div>";
                $_SESSION['status_order'] = $status;
                return true;
            }else{
                echo $mysqli -> error;
            }
}

function edit__order($mysqli, $id_order, $status){
    date_default_timezone_set('Asia/Novokuznetsk');

    $rate = $_POST['rating'];
    
    $sql = $mysqli -> query("SELECT orders.* FROM orders WHERE orders.id_order = $id_order");
    $row = $sql->fetch_assoc();
    $id_client = $row['id_client'];

    $sql = $mysqli -> query("INSERT INTO rating SET rating = $rate, id_user = $id_client");

    if($status == 7){
        $date_complete_order = date('Y-m-d H:i:s');
        $sql = $mysqli -> query("UPDATE orders SET date_complete_order = '$date_complete_order', `id_status` = '$status'
                                    WHERE id_order = $id_order");
    }else{
        $sql = $mysqli -> query("UPDATE orders SET `id_status` = '$status'
                                    WHERE id_order = $id_order");
        }
            if($sql){
                $_SESSION['answer'] = "<div class='alert alert-success alert-dismissible fade show' role='alert'> Заказ завершен! <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Закрыть'></button> </div>";
                $_SESSION['status_order'] = $status;
                return true;
            }else{
                echo $mysqli -> error;
            }
}

function rate_driver($mysqli){

    $rate = $_POST['rating'];
    $id_order = $_POST['rate__user'];

    $sql = $mysqli -> query("SELECT orders.* FROM orders WHERE orders.id_order = $id_order");
    $row = $sql->fetch_assoc();
    $id_driver = $row['id_driver'];

    $sql = $mysqli -> query("INSERT INTO rating SET rating = $rate, id_user = $id_driver");
    if($sql){
        $_SESSION['answer'] = "<div class='alert alert-success alert-dismissible fade show' role='alert'> Спасибо за оценку! <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Закрыть'></button> </div>";
        $_SESSION['auth']['check_rate_user'] = 1;
        return true;
    }else{
        echo $mysqli -> error;
    }


}

// ФУНКЦИЯ С ДОБАВЛЕНИЕМ НОВОГО тарифа В ТАБЛИЦУ
function add_tarif($mysqli){
    // собираем данные с формы
    $tarif_name = trim($_POST["tarif-name"]);
    $tarif_cost = (int)$_POST["tarif-cost"];

    // проверка на пустоту
    if(empty($tarif_name) || empty($tarif_cost)){
        $_SESSION['answer'] = "<div class='alert alert-danger alert-dismissible fade show' role='alert'> Вводимое поле/поля пусты! <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Закрыть'></button> </div>";
        return false;
    }else{
        // Блок с проверкой на одинаковую запись
        $check = $mysqli -> query("SELECT * FROM tarif WHERE tarif_name = '$tarif_name' AND tarif_cost = $tarif_cost");
        if ($check -> num_rows > 0){
            $_SESSION['answer'] = "<div class='alert alert-danger alert-dismissible fade show' role='alert'> Данная запись уже существует! <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Закрыть'></button> </div>" ;
            return false;
        //
        }else{
            $sql = $mysqli -> query("INSERT INTO tarif SET tarif_name = '$tarif_name', tarif_cost = $tarif_cost");
            if($sql){
                $_SESSION['answer'] = "<div class='alert alert-success alert-dismissible fade show' role='alert'> Тариф добавлен в таблицу! <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Закрыть'></button> </div>";
                return true;
            }else{
                echo $mysqli -> error;
            }
        }
    }
}

// ===**Удаление клиента из таблицы**===
function delete_client($mysqli){
    // Сбор
    $id = (int)$_GET['delete-client'];

    // $sqluser = $mysqli -> query("SELECT * FROM users WHERE id_user = $id");
    //     if($sqluser -> num_rows > 0){
    //         $_SESSION['answer'] = "<div class='alert alert-danger'>В других таблицах есть данный пользователь!</div>";
    //         return false;
    //     }else{
            $sql = $mysqli -> query("DELETE FROM clients WHERE id_client = $id");

            if($sql){
                $_SESSION['answer'] = "<div class='alert alert-success'>Клиент под ID(base)'$id', успешно удален!</div>";
                return true;
            }else{
                $_SESSION['answer'] = "<div class='alert alert-danger'>Произошла ошибка БД:".$mysqli->error."</div>";
                return false;
            }
        }
//}

// ===**Удаление пользователя из таблицы**===
function delete_car($mysqli){
    // Сбор
    $id = (int)$_GET['delete-car'];

    // $sqluser = $mysqli -> query("SELECT * FROM users WHERE id_user = $id");
    //     if($sqluser -> num_rows > 0){
    //         $_SESSION['answer'] = "<div class='alert alert-danger'>В других таблицах есть данный пользователь!</div>";
    //         return false;
    //     }else{
            $sql = $mysqli -> query("DELETE FROM cars WHERE id_car = $id");

            if($sql){
                $_SESSION['answer'] = "<div class='alert alert-success'>Машина под ID(base)'$id', успешно удален!</div>";
                return true;
            }else{
                $_SESSION['answer'] = "<div class='alert alert-danger'>Произошла ошибка БД:".$mysqli->error."</div>";
                return false;
            }
        }
//}

// ===**Удаление тарифа из таблицы**===
function delete_tarif($mysqli){
    // Сбор
    $id = (int)$_GET['delete-tarif'];

    // $sqluser = $mysqli -> query("SELECT * FROM users WHERE id_user = $id");
    //     if($sqluser -> num_rows > 0){
    //         $_SESSION['answer'] = "<div class='alert alert-danger'>В других таблицах есть данный пользователь!</div>";
    //         return false;
    //     }else{
            $sql = $mysqli -> query("DELETE FROM tarif WHERE id_tarif = $id");

            if($sql){
                $_SESSION['answer'] = "<div class='alert alert-success'>Тариф под ID(base)'$id', успешно удален!</div>";
                return true;
            }else{
                $_SESSION['answer'] = "<div class='alert alert-danger'>Произошла ошибка БД:".$mysqli->error."</div>";
                return false;
            }
        }
//}

// ===**Удаление пользователя из таблицы**===
function delete_user($mysqli){
    // Сбор
    $id = (int)$_GET['delete-user'];

    // $sqluser = $mysqli -> query("SELECT * FROM users WHERE id_user = $id");
    //     if($sqluser -> num_rows > 0){
    //         $_SESSION['answer'] = "<div class='alert alert-danger'>В других таблицах есть данный пользователь!</div>";
    //         return false;
    //     }else{
            $sql = $mysqli -> query("DELETE FROM users WHERE id_user = $id");

            if($sql){
                $_SESSION['answer'] = "<div class='alert alert-success'>Пользователь под ID(base)'$id', успешно удален!</div>";
                return true;
            }else{
                $_SESSION['answer'] = "<div class='alert alert-danger'>Произошла ошибка БД:".$mysqli->error."</div>";
                return false;
            }
        }
//}

// ===**Удаление пользователя из таблицы**===
function delete_driver($mysqli){
    // Сбор
    $id = (int)$_GET['delete-driver'];

    // $sqluser = $mysqli -> query("SELECT * FROM users WHERE id_user = $id");
    //     if($sqluser -> num_rows > 0){
    //         $_SESSION['answer'] = "<div class='alert alert-danger'>В других таблицах есть данный пользователь!</div>";
    //         return false;
    //     }else{
            $sql = $mysqli -> query("DELETE FROM drivers WHERE id_driver = $id");

            if($sql){
                $_SESSION['answer'] = "<div class='alert alert-success'>Водитель под ID(base)'$id', успешно удален!</div>";
                return true;
            }else{
                $_SESSION['answer'] = "<div class='alert alert-danger'>Произошла ошибка БД:".$mysqli->error."</div>";
                return false;
            }
        }
//}

// ===**Удаление uslugs из таблицы**===
function delete_uslug($mysqli){
    // Сбор
    $id = (int)$_GET['delete-uslug'];

    // $sqluser = $mysqli -> query("SELECT * FROM users WHERE id_user = $id");
    //     if($sqluser -> num_rows > 0){
    //         $_SESSION['answer'] = "<div class='alert alert-danger'>В других таблицах есть данный пользователь!</div>";
    //         return false;
    //     }else{
            $sql = $mysqli -> query("DELETE FROM uslugs WHERE id_uslug = $id");

            if($sql){
                $_SESSION['answer'] = "<div class='alert alert-success'>Услуга под ID(base)'$id', успешно удален!</div>";
                return true;
            }else{
                $_SESSION['answer'] = "<div class='alert alert-danger'>Произошла ошибка БД:".$mysqli->error."</div>";
                return false;
            }
        }
//}

// ===**РЕДАКТИРОВАНИЕ ЗАПИСИ В ТАБЛИЦЕ "USERS"**===
function edit_user($mysqli){
    // собираем данные с формы

    $id = $_GET['edit-user'];
    $user_list = $_POST['user-list1'];
    $login_user = trim($_POST["login-user"]);
    $password = trim($_POST["password-user"]);
    $surname = trim($_POST["surname-user"]);
    $name = trim($_POST["name-user"]);
    $patronymic = trim($_POST["patronymic-user"]);
    $phone = trim($_POST["phone-user"]);
    $mail = trim($_POST["mail-user"]);

    // проверка на пустоту
    if(empty($login_user) || empty($password) || empty($mail) || empty($user_list) || empty($surname) || empty($name) || empty($patronymic) || empty($phone)){
        $_SESSION['answer'] = "<div class='alert alert-danger alert-dismissible fade show' role='alert'>Вводимое поле пустое или роль не была выбрана! </div>";
        return false;
    }else{
        // Блок с проверкой на одинаковую запись
        $check = $mysqli -> query("SELECT * FROM users WHERE login = '$login_user' AND password = '$password' AND surname = '$surname' AND name = '$name' AND patronymic = '$patronymic' AND phone = '$phone' AND mail = '$mail' AND id_role = $user_list");
        if ($check -> num_rows > 0){
            $_SESSION['answer'] = "<div class='alert alert-danger alert-dismissible fade show' role='alert'>Такой пользователь уже существует! </div>";
            return false;
        //
        }else{
            $sql = $mysqli -> query("UPDATE users SET login = '$login_user', password = '$password', surname = '$surname', name = '$name', patronymic = '$patronymic', phone = '$phone', mail = '$mail', id_role = $user_list WHERE id_user = $id");
            if($sql){
                $_SESSION['answer'] = "<div class='alert alert-success alert-dismissible fade show' role='alert'>Запись сохранена!</div>";
                return true;
            }else{
                echo $mysqli -> error;
            }
        }
    }
}

// ===**РЕДАКТИРОВАНИЕ ЗАПИСИ В ТАБЛИЦЕ "USERS"**===
function edit_driver($mysqli){
    // собираем данные с формы
    //Собираем ID
    $id = $_GET['edit-driver'];
    //Собираем ID

    // Информация с выпдающих списков
    $car_list = $_POST['car-list'];
    $tarif_list = $_POST['tarif-list'];
    $uslug_list = $_POST['uslug-list'];
    // Информация с выпдающих списков

    // Информация с инпутов
    // $surname = trim($_POST["surname-driver"]);
    // $name = trim($_POST["name-driver"]);
    // $patronymic = trim($_POST["patronymic-driver"]);
    // $phone = trim($_POST["phone-driver"]);
    // Информация с инпутов

    // проверка на пустоту
    if(empty($car_list) || empty($tarif_list) || empty($uslug_list)){
        $_SESSION['answer'] = "<div class='alert alert-danger alert-dismissible fade show' role='alert'>Поле не может быть пустым! </div>";
        return false;
    }else{
        // Блок с проверкой на одинаковую запись
        $check = $mysqli -> query("SELECT * FROM drivers WHERE id_car = $car_list AND id_tarif = $tarif_list AND id_uslug = $uslug_list");
        if ($check -> num_rows > 0){
            $_SESSION['answer'] = "<div class='alert alert-danger alert-dismissible fade show' role='alert'>Такой водитель уже существует! </div>";
            return false;
        //
        }else{
            $sql = $mysqli -> query("UPDATE drivers SET id_car = $car_list, id_tarif = $tarif_list, id_uslug = $uslug_list WHERE id_driver = $id");
            if($sql){
                $_SESSION['answer'] = "<div class='alert alert-success alert-dismissible fade show' role='alert'>Запись сохранена!</div>";
                return true;
            }else{
                echo $mysqli -> error;
            }
        }
    }
}

// ===**РЕДАКТИРОВАНИЕ ЗАПИСИ В ТАБЛИЦЕ "cars"**===
function edit_car($mysqli){
    // собираем данные с формы
    $id = $_GET['edit-car'];
    $brand = trim($_POST["brand-car"]);
    $color = trim($_POST["color-car"]);
    $type = trim($_POST["type-car"]);
    $gov = trim($_POST["gov-car"]);

    // проверка на пустоту
    if(empty($brand) || empty($color) || empty($type) || empty($gov)){
        $_SESSION['answer'] = "<div class='alert alert-danger alert-dismissible fade show' role='alert'>Вводимое поле/поля пустые! </div>";
        return false;
    }else{
        // Блок с проверкой на одинаковую запись
        $check = $mysqli -> query("SELECT * FROM cars WHERE brand = '$brand' AND gov_number = '$gov'");
        if ($check -> num_rows > 0){
            $_SESSION['answer'] = "<div class='alert alert-danger alert-dismissible fade show' role='alert'>Такая машина уже есть в таблице! </div>";
            return false;
        //
        }else{
            $sql = $mysqli -> query("UPDATE cars SET brand = '$brand', gov_number = '$gov', color = '$color', type_car = '$type' WHERE id_car = $id");
            if($sql){
                $_SESSION['answer'] = "<div class='alert alert-success alert-dismissible fade show' role='alert'>Запись сохранена!</div>";
                return true;
            }else{
                echo $mysqli -> error;
            }
        }
    }
}

// ===**РЕДАКТИРОВАНИЕ ЗАПИСИ В ТАБЛИЦЕ "clients"**===
function edit_client($mysqli){
    // собираем данные с формы
    $id = $_GET['edit-client'];
    $client_name = trim($_POST["client-name"]);
    $client_surname = trim($_POST["client-surname"]);
    $client_patronymic = trim($_POST["client-patronymic"]);
    $client_phone = trim($_POST["client-phone"]);
    $client_rating = trim($_POST["client-rating"]);

    // проверка на пустоту
    if(empty($client_name) || empty($client_surname) || empty($client_patronymic) || empty($client_phone) || empty($client_rating)){
        $_SESSION['answer'] = "<div class='alert alert-danger alert-dismissible fade show' role='alert'>Вводимое поле/поля пустые! </div>";
        return false;
    }else{
        // Блок с проверкой на одинаковую запись
        $check = $mysqli -> query("SELECT * FROM clients WHERE name = '$client_name' AND surname = '$client_surname' AND patronymic = '$client_patronymic' AND phone = '$client_phone' AND rating = '$client_rating'");
        if ($check -> num_rows > 0){
            $_SESSION['answer'] = "<div class='alert alert-danger alert-dismissible fade show' role='alert'>Такой клиент уже есть в таблице! </div>";
            return false;
        //
        }else{
            $sql = $mysqli -> query("UPDATE clients SET name = '$client_name', surname = '$client_surname', patronymic = '$client_patronymic', phone = '$client_phone', rating = '$client_rating' WHERE id_client = $id");
            if($sql){
                $_SESSION['answer'] = "<div class='alert alert-success alert-dismissible fade show' role='alert'>Запись сохранена!</div>";
                return true;
            }else{
                echo $mysqli -> error;
            }
        }
    }
}

// ===**РЕДАКТИРОВАНИЕ ЗАПИСИ В ТАБЛИЦЕ "tarif"**===
function edit_tarif($mysqli){
    // собираем данные с формы
    $id = $_GET['edit-tarif'];
    $tarif_name = trim($_POST["tarif-name"]);
    $tarif_cost = (int)$_POST["tarif-cost"];

    // проверка на пустоту
    if(empty($tarif_name) || empty($tarif_cost)){
        $_SESSION['answer'] = "<div class='alert alert-danger alert-dismissible fade show' role='alert'>Вводимое поле/поля пустые! </div>";
        return false;
    }else{
        // Блок с проверкой на одинаковую запись
        $check = $mysqli -> query("SELECT * FROM tarif WHERE tarif_name = '$tarif_name' AND tarif_cost = $tarif_cost");
        if ($check -> num_rows > 0){
            $_SESSION['answer'] = "<div class='alert alert-danger alert-dismissible fade show' role='alert'>Тариф '$tarif_name' уже есть в таблице! </div>";
            return false;
        //
        }else{
            $sql = $mysqli -> query("UPDATE tarif SET tarif_name = '$tarif_name', tarif_cost = $tarif_cost WHERE id_tarif = $id");
            if($sql){
                $_SESSION['answer'] = "<div class='alert alert-success alert-dismissible fade show' role='alert'>Запись сохранена!</div>";
                return true;
            }else{
                echo $mysqli -> error;
            }
        }
    }
}

// ===**РЕДАКТИРОВАНИЕ ЗАПИСИ В ТАБЛИЦЕ "tarif"**===
function edit_uslug($mysqli){
    // собираем данные с формы
    $id = $_GET['edit-uslug'];
    $uslug_name = trim($_POST["usluga-name"]);

    // проверка на пустоту
    if(empty($uslug_name)){
        $_SESSION['answer'] = "<div class='alert alert-danger alert-dismissible fade show' role='alert'>Вводимое поле/поля пустые! </div>";
        return false;
    }else{
        // Блок с проверкой на одинаковую запись
        $check = $mysqli -> query("SELECT * FROM uslugs WHERE name_uslug = '$uslug_name'");
        if ($check -> num_rows > 0){
            $_SESSION['answer'] = "<div class='alert alert-danger alert-dismissible fade show' role='alert'>Услуга '$uslug_name' уже есть в таблице! </div>";
            return false;
        //
        }else{
            $sql = $mysqli -> query("UPDATE uslugs SET name_uslug = '$uslug_name' WHERE id_uslug = $id");
            if($sql){
                $_SESSION['answer'] = "<div class='alert alert-success alert-dismissible fade show' role='alert'>Запись сохранена!</div>";
                return true;
            }else{
                echo $mysqli -> error;
            }
        }
    }
}

// Генерация пароля
function generator_pass($length = 6){
	$password = '';
	$arr = array(
		'a', 'b', 'c', 'd', 'e', 'f', 'g', 'h', 'i', 'j', 'k', 'l', 'm', 
		'n', 'o', 'p', 'q', 'r', 's', 't', 'u', 'v', 'w', 'x', 'y', 'z', 
		'A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M', 
		'N', 'O', 'P', 'Q', 'R', 'S', 'T', 'U', 'V', 'W', 'X', 'Y', 'Z', 
		'1', '2', '3', '4', '5', '6', '7', '8', '9', '0'
	);
 
	for ($i = 0; $i < $length; $i++) {
		$password .= $arr[random_int(0, count($arr) - 1)];
	}
	return $password;
}

// Добавление аватара для пользователя
function add_avatar($mysqli){
    $allowTypes = array("image/jpeg", "image/png", "image/jpg");
    $allowSize = 2097152;
    $id_user = $_SESSION['auth']['id_user'];

    $ext = explode('.', $_FILES['user_avatar']['name']);
    $ext = $ext[1];
    $avatarName = $id_user.'.'.$ext;

    if(in_array($_FILES['user_avatar']['type'], $allowTypes)){
        if($_FILES['user_avatar']['size'] > $allowSize){
            $_SESSION['add_user']['error'] = 'Размер файла превышает 2МБ';
        }else{
        chmod('./pages/files/', 0755);
        if(copy($_FILES['user_avatar']['tmp_name'], './pages/files/'.$avatarName));
            $res = $mysqli->query("UPDATE users SET img = '$avatarName' WHERE id_user = $id_user");
            if($res){
                $_SESSION['auth']['avatar'] = $avatarName;
            }
            $_SESSION['add_user']['success'] = 'Файл загружен';
        }
    }else{
        $_SESSION['add_user']['error'] = 'Тип данных не поддерживается';
    }

}

function add_gallery(){
        // $id_user = $_SESSION['auth']['id_user'];
        // $ext = explode('.', $_FILES['user-gallery']['name']);
        // $ext = $ext[1];
        // $newPhotoName = $id_user.'.'.$ext;;

        // chmod('./pages/files/gallery/', 0755);
        // copy($_FILES['user-gallery']['tmp_name'], './pages/files/gallery/'.$newPhotoName);
        if(isset($_POST['add-gallery'])){
            // Кол-во всего файлов
            $countfiles = count($_FILES['user-gallery']['name']);

            // Looping all files
            for($i=0;$i<$countfiles;$i++){
                $filename = $_FILES['user-gallery']['name'][$i];

            // Upload file
            chmod('./pages/files/gallery/', 0755);
            copy($_FILES['user-gallery']['tmp_name'][$i],'./pages/files/gallery/'.$filename);

            }
        }
        
}

function asd($mysqli){
    echo 123;
}

// function echo_gallery(){
//     $files = array_filter($_FILES['gallery']); // Используем перед обработкой файлов.

    
//     chmod('./pages/files/', 0777);
//     chmod('./pages/files/gallery/', 0777);

//     // Количество загруженных файлов в массив
//     $total = count($files);

//     // Вывод каждого файла
//     for( $i=0 ; $i < $total ; $i++ ) {

//     // Получение временного пути файла
//         $tmpFilePath = $_FILES['gallery']['tmp_name'][$i];

//     // Проверяем, что у нас есть путь к файлу
//     if ($tmpFilePath != ""){
//     // Ставим новый путь файла
//         $newFilePath = "./pages/files/gallery/" . $_FILES['gallery']['name'][$i];

//     // Загружаем файл во временный каталог
//     if(move_uploaded_file($tmpFilePath, $newFilePath)) {

//         $_SESSION["add-photo"]["answer"] = "Файл успешно загружен в галерею!";

//     }
//     }
// }
// }
