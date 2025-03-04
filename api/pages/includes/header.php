<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

<!--============================================Кастом===================================================-->
    <link rel="stylesheet" href="<?=CSS?>header.css">
    <link rel="stylesheet" href="<?=CSS?>footer.css">
    <link rel="stylesheet" href="<?=BOOTSTRAP?>bootstrap.min.css">
<!--============================================Кастом===================================================-->

<!--============================================Из авторизации===================================================-->
    <link rel="stylesheet" href="<?=CSS?>util.css">
	<link rel="stylesheet" href="<?=CSS?>main.css">
<!--===============================================================================================-->
	<link rel="stylesheet" href="<?BOOTSTRAP?>bootstrap.min.css">
    <link rel="stylesheet" href="../libs/font-awesome/css/font-awesome.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" href="<?FONTS?>font-awesome-4.7.0/css/font-awesome.min.css">
<!--===============================================================================================-->

<link rel="stylesheet" href=" https://use.fontawesome.com/releases/v6.4.4/css/all.css">

<script src="https://api-maps.yandex.ru/2.0-stable/?apikey=ваш API-ключ&load=package.standard&lang=ru-RU" type="text/javascript"></script>
<!--============================================Скрипты для ввода адреса===================================================-->
<script src="<?=JS?>jquery-3.7.1.min.js"></script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/typedata-suggestions@latest/dist/typedata-suggestions.css">
<script src="https://cdn.jsdelivr.net/npm/typedata-suggestions@latest/dist/typedata-suggestions.min.js"></script>
<!--============================================Скрипты для ввода адреса===================================================-->

<script src="https://kit.fontawesome.com/049a41ed22.js" crossorigin="anonymous"></script>
<link rel="stylesheet" href='<?=CSS?>style.css'>
<link rel="stylesheet" href='<?=CSS?>body_main.css'>
<link rel="stylesheet" href='<?=CSS?>scroll.css'>
<link rel="stylesheet" href='<?=CSS?>blog_main.css'>
<script src="<?=JS?>scroll.js"></script>
    <title><?=TITLE?></title>
</head>


<body>
    <nav class=" header navbar navbar-expand-lg" style="background-color: #333333;" data-bs-theme="dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="./">
                <object type="image/svg+xml" data="logo.svg" >
                    <img class="logo" src="<?=IMG?>icons/logo.svg" alt="Таксопарк Драйвер">
                </object>
            </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Переключатель навигации">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <? if(isset($_SESSION['auth']) && $_SESSION['auth']['role'] == 'Администратор'):?>
        <li style="--clr:#25d366;">
        <a href="#" data-bs-toggle="dropdown">
            <i class="fa-solid fa-gear"></i>
            <span style='font-size: 13px; white-space: nowrap;'>Админ-панель</span>
          </a>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="?view=users">Общий список пользователей</a></li>
            <li><a class="dropdown-item" href="?view=tarif">Список тарифов</a></li>
            <li><a class="dropdown-item" href="?view=uslugs">Список услуг</a></li>
            <li><a class="dropdown-item" href="?view=cars">Список машин</a></li>
            <li><a class="dropdown-item" href="?view=drivers">Список водителей</a></li>
            <li><a class="dropdown-item" href="?view=orders">Список заказов</a></li>
            <li><a class="dropdown-item" href="?view=profile" style="color: white">Личный кабинет</a></li>
          </ul>
        </li>
        <?php endif;?>
        <? if(isset($_SESSION['auth']) && $_SESSION['auth']['role'] == 'Клиент' || $_SESSION['auth']['role'] == 'Водитель' || $_SESSION['auth']['role'] == 'Администратор'):?>
        <li style="--clr:#2483ff;">
            <a class="" href="#" data-bs-toggle="modal" data-bs-target="#exampleModal1">
                <i class="fa-solid fa-pen-to-square"></i>
                <span style='font-size: 13px; white-space: nowrap;'>Заказать</span>
            </a>
        </li>
        <? if($_SESSION['auth']['role'] != 'Водитель' && $_SESSION['auth']['role'] != 'Клиент'):?>
        <li style="--clr:#f32ec8;">
            <a href="?view=applicDrivers">
            <i class="fa-brands fa-readme"></i>
            <span style='font-size: 13px; white-space: nowrap;'>Заявки на водителей</span>
            </a>
        </li>
        <? endif;?>
        <li style="--clr: rgb(61, 238, 188);">
            <a href="?view=myOrders">
            <i class="fa-solid fa-user"></i>
            <span style='font-size: 13px; white-space: nowrap;'>Мои заказы</span>
            </a>
        </li>
        <?php endif;?>
        <? if(isset($_SESSION['auth']) && $_SESSION['auth']['role'] == 'Водитель' || $_SESSION['auth']['role'] == 'Администратор'):?>
        <li style="--clr:#ff253f;">
          <a href="?view=driverOrders">
            <i class="fa-solid fa-notes-medical"></i>
            <span style='font-size: 13px; white-space: nowrap;'>Активные заказы</span>
            </a>
        </li>
        <?php endif;?>
      </ul>

      <div class="text-center">
        <? if(isset($_SESSION['answer'])){
                echo $_SESSION['answer'];
                unset($_SESSION['answer']);}?>
    </div>

      <?php if(empty($user_orders)):?>
       <?php elseif(count($user_orders)  == 1):?>
        <?php foreach($user_orders as $user_order):?>
            Статус заказа: <span style='color: rgb(<?=$user_order['color']?>);'><?=$user_order['status_name'];?><img class='status_order' src='<?=FILES?>status_order/<?=$user_order['status_img'];?>'></span>
        <?php endforeach;?>

        <?php elseif(count($user_orders)  > 1):?>
            Статус заказа: У вас <?=count($user_orders)?> активных заказов
        <?php endif;?>

    </div>
      <div class="info-login">
        <?php if($_SESSION['auth']['avatar'] == "NULL" || empty($_SESSION['auth']['avatar'])):?>
            <a href="?view=profile"><img class="round avatar-header" src="<?=FILES?>0.jpg" alt="user" />
        <?php else:?>
	        <a href="?view=profile"><img class="round avatar-header" src="<?=FILES?><?=$_SESSION['auth']['avatar']?>" alt="user" />
        <?php endif;?>
        <span>Здравствуйте, <strong><?=$_SESSION['auth']['name']?></strong></span>
        <a class="nav-item close" href="?do=logout">Выйти</a>
    </div>
    </div>
  </div>
</nav> 
  <!-- Модальное окно -->
<form action="" method="post">
  <div class="modal fade" id="exampleModal1" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h1 class="modal-title fs-5" style="color: white;" id="exampleModalLabel">Заказать такси</h1>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Закрыть"></button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="col m-auto">

                                        <form method="post">
                                            <!-- Контент модального окна -->
                                            <span class="label-input100" style="color:aliceblue;">Имя*</span>
                                                <input type="text" class="form-control my-2" required readonly="" id="floatingInputValue" placeholder="Ваше имя" name='name__user' value="<?echo $_SESSION['auth']['name'];?>">
                                            <span class="label-input100" style="color:aliceblue;">Номер телефона*</span>
                                                <input type="phone" class="tel form-control my-2" id="floatingInputValue" placeholder="Ваш номер телефона" name='phone__number' value="<?echo $_SESSION['auth']['phone'];?>" required>
                                            Такси только по Кузбассу*<br>
                                            <span class="" style="color:aliceblue;">Откуда*</span><br>

                                                <div class="typedataSuggestions_wrapper">
                                                    <input id="typedataSuggestions" type="search" spellcheck=false autocorrect="off" autocomplete="off" autocapitalize="off">
                                                </div>

                                                <span class="label-input100" style="color:aliceblue; padding-left:30px;">Город / населенный пункт*</span>
                                                    <input type="text" class="form-control my-2 city__out" style="margin-left:30px; max-width: 60%" id="floatingInputValue" placeholder="Город" name='city__out' value="" required readonly="">
                                                
                                                <span class="label-input100" style="color:aliceblue; padding-left:30px;">Улица*</span>
                                                    <input type="text" class="form-control my-2 street__out" style="margin-left:30px; max-width: 60%" id="floatingInputValue" placeholder="Улица" name="street__out" value="" required readonly="">
                                                
                                                <span class="label-input100" style="color:aliceblue; padding-left:30px;">Дом*</span>
                                                    <input type="text" class="form-control my-2 house__out" style="margin-left:30px; max-width: 60%" id="floatingInputValue" placeholder="Дом" name="house__out" value="" required readonly="">
                                            
                                                    <span class="" style="color:aliceblue;">Куда*</span><br>

                                                <span class="label-input100" style="color:aliceblue; padding-left:30px;">Город / населенный пункт*</span>
                                                    <input type="text" class="form-control my-2 city__come" style="margin-left:30px; max-width: 60%" id="floatingInputValue" placeholder="Город" name='city__come' value="" required readonly="">
                                                
                                                <span class="label-input100" style="color:aliceblue; padding-left:30px;">Улица*</span>
                                                    <input type="text" class="form-control my-2 street__come" style="margin-left:30px; max-width: 60%" id="floatingInputValue" placeholder="Улица" name="street__come" value="" required readonly="">
                                                
                                                <span class="label-input100" style="color:aliceblue; padding-left:30px;">Дом*</span>
                                                    <input type="text" class="form-control my-2 house__come" style="margin-left:30px; max-width: 60%" id="floatingInputValue" placeholder="Дом" name="house__come" value="" required readonly="">
                                            
                                                <span class="" style="color:aliceblue; padding-left:30px">Выбор тарифа*</span>

                                                <select id='select_tarif' class='select-tarif form-control my-2' style="color:black; padding-left:30px; max-width: 60%" name="tarif_list" id="select-tarif" required>
                                                        <option value="<?=$tarif['id_tarif']?>" style="color:black; max-width: 60%">Выбрать тариф</option>
                                                        <?foreach ($tarifs as $tarif):?>
                                                        <option style="color:black; max-width: 60%" value="<?=$tarif['id_tarif']?>"><?=$tarif['tarif_name']?> || <?=$tarif['tarif_cost']?>₽</option>
                                                        <?endforeach;?>
                                                </select>
                                            <span class="label-input100" style="color:aliceblue;">Комментарий для водителя</span>
                                                <textarea type="text" class="form-control my-2" style="width: 100%;
                                                                                                    height: 100px;
                                                                                                    padding: 5px 10px 5px 10px;
                                                                                                    border:1px solid #999;
                                                                                                    font-size:16px;
                                                                                                    font-family: Tahoma;"
                                                id="floatingInputValue" placeholder="Комментарий для водителя (необязательно)" name='comment' value=""></textarea>
                                            <br>
                                            <span class="label-input100" style="color:aliceblue;">
                                                (Поля указанные  <b>{*}</b>  являются обязательными для заполнения!)
                                                <br>
                                                Чтобы заказать такси на 2 адреса, вы должны ввести 1 адрес, он автоматически заполнится в поля, после чего стереть и ввести новый для второго!
                                            </span>
<!-- <span class="label-input100" style="color:aliceblue;">Выберите маршрут</span>
Интерактивная карта
<div id="map" style="width: 100%; height: 100%; padding: 0; margin: 0;"></div>

<script type="text/javascript" charset="utf-8" async src="https://api-maps.yandex.ru/services/constructor/1.0/js/?um=constructor%3A13d77f46d9f583262f941ee64664b2fcebe29b11ff01d6effa56feefb176e2e8&amp;width=500&amp;height=400&amp;lang=ru_RU&amp;scroll=true"></script>
Интерактивная карта -->
                                                <!-- Контент модального окна -->
                                        </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Закрыть</button>
                                            <button type="submit" class="btn btn-warning"  name='add-order'value='Добавить'>Заказать=>></button>
                                        </div>
                                    </form>
                                    </div>
                                </div>
                            </div>
                        <!-- Модальное окно -->
</form>

