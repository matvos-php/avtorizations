<?php
/*

                controller.php - выступает как переключателем страниц

*/

require "model.php"; // Подключение файла с функциями


if (isset($_POST['register'])){
    register($mysqli);
    redirect('./');
}

if (isset($_POST['auth']) && $_POST['auth'] == 'auth'){
    auth($mysqli);
    redirect();
}

if(isset($_POST['add-order']) && $_POST['add-order'] == 'Добавить'){
    $_SESSION['status_order'] = add_order($mysqli);
    redirect();
}

if(isset($_SESSION['auth']['login'])){
    $user_orders = all_user_orders($mysqli);
    $user_rating = user_rating($mysqli);
}

if($_SESSION['status_order'] == 0){
    $status = "<span class='status_order_offline'> Заказ отсутствует!</span>
                <img class='status_order' src='".FILES.'status_order/offline.gif'."'>";
}else if($_SESSION['status_order'] == 0){
    $status = "<span class='status_order_processing'> Идет поиск водителя!</span>
                <img class='status_order' src='".FILES.'status_order/expectation.gif'."'>";
}else if($_SESSION['status_order'] == 2){
    $status = "<span class='status_order_online'> Водитель принял ваш заказ!</span>
                <img class='status_order' src='".FILES.'status_order/online.gif'."'>";
}else if($_SESSION['status_order'] == 2){
    $status = "<span class='status_order_online'> Водитель принял ваш заказ!</span>
                <img class='status_order' src='".FILES.'status_order/online.gif'."'>";
}


if(isset($_GET['do']) && $_GET['do']=='logout'){
    unset($_SESSION['auth']);
    redirect('./');
}

//$count_user_order_complete = count_user_order_complete($mysqli);

$tarifs = all_tarifs($mysqli);
$view = isset($_GET['view']) ? $_GET['view']: 'main';
switch($view){

    case('main'):
        $tarifs = all_tarifs($mysqli);

        if(isset($_POST['add-order'])){
            add_order($mysqli);
            $_SESSION['status_order'] = 1;
            redirect();
        }
        if(isset($_POST['add__application__driver'])){
            add_driver_application($mysqli);
            redirect();
        }
        break;
    
    case('applicDrivers'):
        $all_application_drivers = all_application_drivers($mysqli);
        
        if(isset($_POST['confirm__application'])){
            confirm_driver_application($mysqli);
            redirect();
        }

        if(isset($_POST['discard__application'])){
            discard__application($mysqli);
            redirect();
        }
        break;

//-----=====Исполняемые функции и команды для страницы users=====-----
    case('users'):
        if(isset($_POST['search']) AND !empty($_POST['text_search'])){
            $text_search = $_POST['text_search'];
            $users = search_users($mysqli, $text_search);
        }else{
            $users = all_users($mysqli);
        }

        $cars = all_cars($mysqli);
        $tarifs = all_tarifs($mysqli);
        $uslugs = all_uslugs($mysqli);
        $roles = all_roles($mysqli);

        if(isset($_POST['add-user']) && $_POST['add-user'] == 'Добавить'){
            add_user($mysqli);
            //redirect('?view=users');
        }
        if(isset($_POST['generator_pass']) && ($_POST['generator_pass']) == 'pass'){
            $pass = generator_pass(6);
            exit(json_encode($pass));
        }
        if(isset($_GET['delete-user'])){
            delete_user($mysqli);
            redirect('?view=users');
        }
        if(isset($_POST['save-user']) && ($_POST['save-user']) == 'Применить'){
            edit_user($mysqli);
            redirect('?view=users');
        }
        if(isset($_POST['add-avatar'])){
            add_avatar($mysqli);
            redirect();
        }
        break;

//-----=====Исполняемые функции и команды для страницы users=====-----

//-----=====Исполняемые функции и команды для страницы profile=====----
    case('profile'):
        $users = all_users($mysqli);
        $files_dir = array_diff(scandir('./pages/files/gallery/', SCANDIR_SORT_DESCENDING), array('..', '.', ' '));
        $count_user_order_complete_today = count_user_order_complete_today($mysqli);
        $count_user_order_complete = count_user_order_complete($mysqli);

        $user_rating = user_rating($mysqli);

        if(isset($_POST['add-gallery'])){
            add_gallery();
            redirect('?view=profile');
        }

        if(isset($_POST['add-avatar'])){
            add_avatar($mysqli);
            redirect('?view=profile');
        }
        break;
//-----=====Исполняемые функции и команды для страницы profile=====----

//-----=====Исполняемые функции и команды для страницы tarif=====----
    case('tarif'):
        if(isset($_POST['search']) AND !empty($_POST['text_search'])){
            $text_search = $_POST['text_search'];
            $tarifs = search_tarif($mysqli, $text_search);
        }else{
            $tarifs = all_tarifs($mysqli);
        }

        if(isset($_POST['add-tarif']) && $_POST['add-tarif'] == 'Добавить'){
            add_tarif($mysqli);
            redirect('?view=tarif');
        }

        if(isset($_POST['save-tarif']) && ($_POST['save-tarif']) == 'Применить'){
            edit_tarif($mysqli);
            redirect('?view=tarif');
        }

        if(isset($_GET['delete-tarif'])){
            delete_tarif($mysqli);
            redirect('?view=tarif');
        }
        break;

//-----=====Исполняемые функции и команды для страницы tarif=====----

//-----=====Исполняемые функции и команды для страницы cars=====----
case('cars'):
    if(isset($_POST['search']) AND !empty($_POST['text_search'])){
        $text_search = $_POST['text_search'];
        $cars = search_cars($mysqli, $text_search);
    }else{
        $cars = all_cars($mysqli);
    }

    if(isset($_POST['add-car']) && $_POST['add-car'] == 'Добавить'){
        add_car($mysqli);
        redirect('?view=cars');
    }

    if(isset($_GET['delete-car'])){
        delete_car($mysqli);
        redirect('?view=cars');
    }

    if(isset($_POST['save-car']) && ($_POST['save-car']) == 'Применить'){
        edit_car($mysqli);
        redirect('?view=cars');
    }

    break;

//-----=====Исполняемые функции и команды для страницы cars=====----

//-----=====Исполняемые функции и команды для страницы uslugs=====----
    case('uslugs'):
        if(isset($_POST['search']) AND !empty($_POST['text_search'])){
            $text_search = $_POST['text_search'];
            $uslugs = search_uslugs($mysqli, $text_search);
        }else{
            $uslugs = all_uslugs($mysqli);
        }

        if(isset($_POST['add-uslug']) && $_POST['add-uslug'] == 'Добавить'){
            add_uslugs($mysqli);
            redirect('?view=uslugs');
        }

        if(isset($_GET['delete-uslug'])){
            delete_uslug($mysqli);
            redirect('?view=uslugs');
        }

        if(isset($_POST['save-uslug']) && ($_POST['save-uslug']) == 'Применить'){
            edit_uslug($mysqli);
            redirect('?view=uslugs');
        }

        break;
//-----=====Исполняемые функции и команды для страницы uslugs=====----

//-----=====Исполняемые функции и команды для страницы drivers=====----
    case('drivers'):
        if(isset($_POST['search']) AND !empty($_POST['text_search'])){
            $text_search = $_POST['text_search'];
            $drivers = search_drivers($mysqli, $text_search);
        }else{
            $drivers = all_drivers($mysqli);
        }

        $cars = all_cars($mysqli);
        $tarifs = all_tarifs($mysqli);
        $uslugs = all_uslugs($mysqli);
        $users = all_users($mysqli);

        if(isset($_POST['add-driver']) && $_POST['add-driver'] == 'Добавить'){
            add_driver($mysqli, $_POST['user_id']);
            redirect('?view=drivers');
        }

        if(isset($_POST['save-driver']) && ($_POST['save-driver']) == 'Применить'){
            edit_driver($mysqli);
            redirect('?view=drivers');
        }

        if(isset($_GET['delete-driver'])){
            delete_driver($mysqli);
            redirect('?view=drivers');
        }
        break;

//-----=====Исполняемые функции и команды для страницы drivers=====----

//-----=====Исполняемые функции и команды для страницы clients=====----
    case('clients'):
        if(isset($_POST['search']) AND !empty($_POST['text_search'])){
            $text_search = $_POST['text_search'];
            $clients = search_clients($mysqli, $text_search);
        }else{
            $clients = all_clients($mysqli);
        }

        if(isset($_POST['add-client']) && $_POST['add-client'] == 'Добавить'){
            add_client($mysqli);
            redirect('?view=clients');
        }

        if(isset($_GET['delete-client'])){
            delete_client($mysqli);
            redirect('?view=clients');
        }

        if(isset($_POST['save-client']) && ($_POST['save-client']) == 'Применить'){
            edit_client($mysqli);
            redirect('?view=clients');
        }
        break;

//-----=====Исполняемые функции и команды для страницы clients=====----

//-----=====Исполняемые функции и команды для страницы becomeDriver=====----
    case('becomeDriver'):
        $users = all_users($mysqli);
        $roles = all_roles($mysqli);
        if(isset($_POST['add-user']) && $_POST['add-user'] == 'Добавить'){
            add_user($mysqli);
            redirect('?view=users');
        }
        break;
    
    case('driverOrders'):
        $user_orders = all_user_orders($mysqli);

        if(isset($_POST['confirm__order'])){
            confirm__order($mysqli);
            redirect('?view=driverOrders');
        }
        if(isset($_POST['edit__order4'])){
            edit__order($mysqli, $_POST['edit__order4'], 4);
            redirect('?view=driverOrders');
        }
        if(isset($_POST['edit__order5'])){
            edit__order($mysqli, $_POST['edit__order5'], 5);
            redirect('?view=driverOrders');
        }
        if(isset($_POST['edit__order6'])){
            edit__order($mysqli, $_POST['edit__order6'], 6);
            redirect('?view=driverOrders');
        }
        if(isset($_POST['end__order'])){
            edit__order($mysqli, $_POST['end__order'], 7);
            redirect();
        }
        break;

        case('myOrders'):
            $user_orders = all_user_orders($mysqli);
    
            if(isset($_POST['rate__user'])){
                rate_driver($mysqli);
                redirect();
            }
            break;

//-----=====Исполняемые функции и команды для страницы becomeDriver=====----

}

require($_SERVER['DOCUMENT_ROOT']."/pages/index.php");
?>