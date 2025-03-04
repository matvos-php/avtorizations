<link rel="stylesheet" href='<?=CSS?>body_table.css'>
<link rel="stylesheet" href='<?=CSS?>profile.css'>
<form action="" method="POST" enctype="multipart/form-data">

<div class="card-container" style="width: 450px">
	<span class="
    <?php 
        if($_SESSION['auth']['role'] == 'Водитель'){
            echo 'driver';
        }elseif($_SESSION['auth']['role'] == 'Администратор'){
            echo 'administrator';
        }elseif($_SESSION['auth']['role'] == 'Клиент'){
            echo 'client';
        }
    ?>"><?=$_SESSION['auth']['role']?></span>
    <?php if($_SESSION['auth']['avatar'] == "NULL" || empty($_SESSION['auth']['avatar'])):?>
        <img class="round avatar-header" src="<?=FILES?>0.jpg" alt="user" />
    <?php else:?>
	    <img class="round avatar-header" src="<?=FILES?><?=$_SESSION['auth']['avatar']?>" alt="user" />
    <?php endif;?>
	<h3><?=$_SESSION['auth']['surname']?> <?=$_SESSION['auth']['name']?></h3>
    <?php
    if($user_rating){
        $sum_numbers = 0;
        $count = count($user_rating);
        foreach($user_rating as $rating){
            $sum_numbers = $sum_numbers + $rating['rating'];
        }
        $result = $sum_numbers/$count;
    }
    ?>
	<p class="rating" data-title="Ваш рейтинг"><?=number_format($result, 1, ',', ' ');?>/5 ★</p>
	<div class="buttons">
		<button type="button" class="primary" data-bs-toggle="modal" data-bs-target="#exampleModal2">
			Изменить аватар
		</button>
	</div>
    <?php if($_SESSION['auth']['role'] == 'Водитель'):?>
        <div class="skills">
            <h6>Статистика по заказам</h6>
            <ul>
                <li>Всего выполненных / <?=count($count_user_order_complete);?></li>
                <li>Выполненно за сегодня / <?=count($count_user_order_complete_today);?></li>
            </ul>
        </div>
    <?php else:?>
        <div class="skills">
		<h6>Статистика по заказам <br><span style="color: rgba(255, 255, 255, 0.3); font-size: 16px; text-transform: lowercase;">чтобы получить промокод, вам нужно 10 заказов</span></h6>
		<ul>
			<li>Всего вызвано такси: <span style="font-size: 14px;"><?php if(is_countable($count_user_order_complete) == 0):?> у вас нет заказов <?php else:?> <?=is_countable($count_user_order_complete);?> <?php endif;?></span></li>
			<li>До промокода осталось <span style="font-size: 14px;">(<?php if(((10-(is_countable($count_user_order_complete)%10))) == 10):?>ваш промокод: <?=uniqid()?><?php else:?> <?=10-(is_countable($count_user_order_complete)%10)?> <?php endif;?>)/10</span></li>
		</ul>
	</div>    
    <?endif;?>

<!-- Модальное окно c добавлением аватара-->
<div class="modal fade" id="exampleModal2" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
      <div class="modal-content">
          <div class="modal-header">
              <h1 class="modal-title fs-5 text-center" id="exampleModalLabel">Добавить аватар</h1>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Закрыть"></button>
          </div>
          <div class="modal-body">
              <div class="col m-auto">

              <!-- Контент модального окна -->
                <div class='chat'>
	                <div class='chat-messages'>
		                <div class='chat-messages__content' id='messages'>
                            <img id="image" style="max-width: 500px; max-height: 500px;"/>
		                </div>
	                </div>
	                <div class='chat-input'>
		                <form method='post' id='chat-form'>
                            <input type="file" name="user_avatar" accept="image/*" id="files" >
                            <button type="submit" name="add-avatar"class="btn btn-info col-md-6 my-2">Добавить аватар</button>
		                </form>
	                </div>
                </div>
              <!-- Контент модального окна -->
              </div>
          </div>
          <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Отменить</button>
          </div>
      </div>
  </div>
</div>
<!-- Модальное окно с добавлением аватара-->

</form>