<div></div>

<form method="post">
<? if(empty($user_orders)):?>
  <? if($_SESSION['auth']['role'] == 'Водитель'):?>
    <div class="card orders">
            <div class="container-card bg-white-box">
            <svg width="80" height="80" viewBox="120 10 1 250" fill="#cb77cb" fill-opacity="0.15" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" style="enable-background:new 0 0 189.473 189.473;" xml:space="preserve">
              <rect x="1" y="1" width="120" height="120" rx="24" fill="#cb77cb" fill-opacity="0.15" stroke="#f409d5" stroke-width="2"></rect>
              <rect x="150" y="100" width="120" height="120" rx="24" fill="#cb77cb" fill-opacity="0.15" stroke="#f409d5" stroke-width="2"></rect>
              <g><path d="M341.837,169.748l-32.62-98.12c-4.476-13.463-17.07-22.548-31.259-22.548h-52.623l-11.461-34.384 c-2.896-8.691-11.029-14.553-20.19-14.553h-22.192c-9.161,0-17.294,5.861-20.19,14.553L139.84,49.08H87.217 c-14.188,0-26.783,9.085-31.259,22.548l-32.62,98.12C9.829,173.858,0,186.415,0,201.268v80.939 c0,18.187,14.735,32.93,32.918,32.941v40.471c0,5.199,4.214,9.412,9.412,9.412h43.293c5.199,0,9.412-4.213,9.412-9.412v-40.471 H270.14v40.471c0,5.199,4.214,9.412,9.412,9.412h43.294c5.198,0,9.411-4.213,9.411-9.412v-40.471 c18.183-0.014,32.918-14.756,32.918-32.941v-80.939C365.175,186.415,355.346,173.859,341.837,169.748z M156.298,26.347h17.526V8.82 h17.526v17.526h17.525v17.526H191.35V26.347h-17.526v17.526h-17.526V26.347z M90.61,88.842h183.953l19.693,65.84H70.023 L90.61,88.842z M73.587,272.704c-17.305,0-31.333-14.027-31.333-31.332c0-17.306,14.028-31.334,31.333-31.334 s31.333,14.028,31.333,31.334C104.92,258.676,90.892,272.704,73.587,272.704z M291.587,272.704 c-17.305,0-31.333-14.027-31.333-31.332c0-17.306,14.028-31.334,31.333-31.334s31.333,14.028,31.333,31.334 C322.92,258.676,308.892,272.704,291.587,272.704z"/></g></svg>
                  <p class="card-title">У вас сейчас нет заказов</p>
                  <p class="card-description">У вас сейчас нет активного заказа, возьмите заказ в списке <a href="?view=driverOrders">Заказы</a>.</p>
            </div>
      </div>
  <? elseif($_SESSION['auth']['role'] == 'Клиент' || $_SESSION['auth']['role'] == 'Администратор'):?>
    <div class="card orders">
          <div class="container-card bg-white-box">
            <svg width="80" height="80" viewBox="120 10 1 250" fill="#cb77cb" fill-opacity="0.15" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" style="enable-background:new 0 0 189.473 189.473;" xml:space="preserve">
              <rect x="1" y="1" width="120" height="120" rx="24" fill="#cb77cb" fill-opacity="0.15" stroke="#f409d5" stroke-width="2"></rect>
              <rect x="150" y="100" width="120" height="120" rx="24" fill="#cb77cb" fill-opacity="0.15" stroke="#f409d5" stroke-width="2"></rect>
              <g><path d="M341.837,169.748l-32.62-98.12c-4.476-13.463-17.07-22.548-31.259-22.548h-52.623l-11.461-34.384 c-2.896-8.691-11.029-14.553-20.19-14.553h-22.192c-9.161,0-17.294,5.861-20.19,14.553L139.84,49.08H87.217 c-14.188,0-26.783,9.085-31.259,22.548l-32.62,98.12C9.829,173.858,0,186.415,0,201.268v80.939 c0,18.187,14.735,32.93,32.918,32.941v40.471c0,5.199,4.214,9.412,9.412,9.412h43.293c5.199,0,9.412-4.213,9.412-9.412v-40.471 H270.14v40.471c0,5.199,4.214,9.412,9.412,9.412h43.294c5.198,0,9.411-4.213,9.411-9.412v-40.471 c18.183-0.014,32.918-14.756,32.918-32.941v-80.939C365.175,186.415,355.346,173.859,341.837,169.748z M156.298,26.347h17.526V8.82 h17.526v17.526h17.525v17.526H191.35V26.347h-17.526v17.526h-17.526V26.347z M90.61,88.842h183.953l19.693,65.84H70.023 L90.61,88.842z M73.587,272.704c-17.305,0-31.333-14.027-31.333-31.332c0-17.306,14.028-31.334,31.333-31.334 s31.333,14.028,31.333,31.334C104.92,258.676,90.892,272.704,73.587,272.704z M291.587,272.704 c-17.305,0-31.333-14.027-31.333-31.332c0-17.306,14.028-31.334,31.333-31.334s31.333,14.028,31.333,31.334 C322.92,258.676,308.892,272.704,291.587,272.704z"/></g></svg>
              <p class="card-title">У вас сейчас нет заказов</p>
              <p class="card-description">Статус вашего заказа <b><span style='color: rgb(255, 0, 0);'>Отсутствует<img class='status_order' src='<?=FILES?>status_order/offline.gif'></span></b> <a href="#" class="" data-bs-toggle="modal" data-bs-target="#exampleModal1">закажите</a> такси!</p>
          </div>
      </div>
  <? endif;?>
  <?else:?>
  <? if($_SESSION['auth']['role'] == 'Водитель'):?>
    <? foreach($user_orders as $user_order):?>
      <? if($user_order['id_status'] >= 3 && $user_order['id_status'] < 7):?>
          <div class="card orders">
              <div class="container-card bg-white-box">
                <svg width="80" height="80" viewBox="120 10 1 250" fill="#cb77cb" fill-opacity="0.15" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" style="enable-background:new 0 0 189.473 189.473;" xml:space="preserve">
                  <rect x="1" y="1" width="120" height="120" rx="24" fill="#cb77cb" fill-opacity="0.15" stroke="#f409d5" stroke-width="2"></rect>
                  <rect x="150" y="100" width="120" height="120" rx="24" fill="#cb77cb" fill-opacity="0.15" stroke="#f409d5" stroke-width="2"></rect>
                  <g><path d="M341.837,169.748l-32.62-98.12c-4.476-13.463-17.07-22.548-31.259-22.548h-52.623l-11.461-34.384 c-2.896-8.691-11.029-14.553-20.19-14.553h-22.192c-9.161,0-17.294,5.861-20.19,14.553L139.84,49.08H87.217 c-14.188,0-26.783,9.085-31.259,22.548l-32.62,98.12C9.829,173.858,0,186.415,0,201.268v80.939 c0,18.187,14.735,32.93,32.918,32.941v40.471c0,5.199,4.214,9.412,9.412,9.412h43.293c5.199,0,9.412-4.213,9.412-9.412v-40.471 H270.14v40.471c0,5.199,4.214,9.412,9.412,9.412h43.294c5.198,0,9.411-4.213,9.411-9.412v-40.471 c18.183-0.014,32.918-14.756,32.918-32.941v-80.939C365.175,186.415,355.346,173.859,341.837,169.748z M156.298,26.347h17.526V8.82 h17.526v17.526h17.525v17.526H191.35V26.347h-17.526v17.526h-17.526V26.347z M90.61,88.842h183.953l19.693,65.84H70.023 L90.61,88.842z M73.587,272.704c-17.305,0-31.333-14.027-31.333-31.332c0-17.306,14.028-31.334,31.333-31.334 s31.333,14.028,31.333,31.334C104.92,258.676,90.892,272.704,73.587,272.704z M291.587,272.704 c-17.305,0-31.333-14.027-31.333-31.332c0-17.306,14.028-31.334,31.333-31.334s31.333,14.028,31.333,31.334 C322.92,258.676,308.892,272.704,291.587,272.704z"/></g></svg>
                  <p class="card-title">Ваш заказ принят! &nbsp;<i class="fa-solid fa-wand-magic-sparkles"></i></p>
                    <p class="card-description">Статус вашего заказа: "<span style='color: rgb(<?=$user_order['color']?>);'><?=$user_order['status_name'];?><img class='status_order' src='<?=FILES?>status_order/<?=$user_order['status_img'];?>'></span>"</p>
                    <button type="button" value='<?=$user_order['id_order']?>' class="chat__button card-description btn btn-info btn-sm text-center card_button my-2" style="color: black; background: black;" data-bs-toggle="modal" data-bs-target="#exampleModal2"><i class="fa-regular fa-comment"></i>&nbsp;<span>Чат с водителем</span></button></p>
                    <button type="submit" class="btn btn-danger my-2" id="confirm__" name='end__order' value="<?=$user_order['id_order']?>">Отменить заказ</button>
                </div>
            </div>
      <?endif;?>
    <? endforeach;?>
  <? elseif($_SESSION['auth']['role'] == 'Клиент' || $_SESSION['auth']['role'] == 'Администратор'):?>
    <? foreach($user_orders as $user_order):?>
      <?php if($user_order['id_status'] == 2):?>
          <div class="card orders">
              <div class="container-card bg-white-box">
                <svg width="80" height="80" viewBox="120 10 1 250" fill="#cb77cb" fill-opacity="0.15" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" style="enable-background:new 0 0 189.473 189.473;" xml:space="preserve">
                  <rect x="1" y="1" width="120" height="120" rx="24" fill="#cb77cb" fill-opacity="0.15" stroke="#f409d5" stroke-width="2"></rect>
                  <rect x="150" y="100" width="120" height="120" rx="24" fill="#cb77cb" fill-opacity="0.15" stroke="#f409d5" stroke-width="2"></rect>
                  <g><path d="M341.837,169.748l-32.62-98.12c-4.476-13.463-17.07-22.548-31.259-22.548h-52.623l-11.461-34.384 c-2.896-8.691-11.029-14.553-20.19-14.553h-22.192c-9.161,0-17.294,5.861-20.19,14.553L139.84,49.08H87.217 c-14.188,0-26.783,9.085-31.259,22.548l-32.62,98.12C9.829,173.858,0,186.415,0,201.268v80.939 c0,18.187,14.735,32.93,32.918,32.941v40.471c0,5.199,4.214,9.412,9.412,9.412h43.293c5.199,0,9.412-4.213,9.412-9.412v-40.471 H270.14v40.471c0,5.199,4.214,9.412,9.412,9.412h43.294c5.198,0,9.411-4.213,9.411-9.412v-40.471 c18.183-0.014,32.918-14.756,32.918-32.941v-80.939C365.175,186.415,355.346,173.859,341.837,169.748z M156.298,26.347h17.526V8.82 h17.526v17.526h17.525v17.526H191.35V26.347h-17.526v17.526h-17.526V26.347z M90.61,88.842h183.953l19.693,65.84H70.023 L90.61,88.842z M73.587,272.704c-17.305,0-31.333-14.027-31.333-31.332c0-17.306,14.028-31.334,31.333-31.334 s31.333,14.028,31.333,31.334C104.92,258.676,90.892,272.704,73.587,272.704z M291.587,272.704 c-17.305,0-31.333-14.027-31.333-31.332c0-17.306,14.028-31.334,31.333-31.334s31.333,14.028,31.333,31.334 C322.92,258.676,308.892,272.704,291.587,272.704z"/></g></svg>
                      <p class="card-title">Ваш заказ оформлен! &nbsp;<i class="fa-solid fa-wand-magic-sparkles"></i></p>
                      <p class="card-description">Статус вашего заказа: "<span style='color: rgb(<?=$user_order['color']?>);'><?=$user_order['status_name'];?><img class='status_order' src='<?=FILES?>status_order/<?=$user_order['status_img'];?>'></span>"</p>
              </div>
          </div>
      <? elseif($user_order['id_status'] >= 3 && $user_order['id_status'] < 7):?>
          <div class="card orders">
              <div class="container-card bg-white-box">
                <svg width="80" height="80" viewBox="120 10 1 250" fill="#cb77cb" fill-opacity="0.15" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" style="enable-background:new 0 0 189.473 189.473;" xml:space="preserve">
                  <rect x="1" y="1" width="120" height="120" rx="24" fill="#cb77cb" fill-opacity="0.15" stroke="#f409d5" stroke-width="2"></rect>
                  <rect x="150" y="100" width="120" height="120" rx="24" fill="#cb77cb" fill-opacity="0.15" stroke="#f409d5" stroke-width="2"></rect>
                  <g><path d="M341.837,169.748l-32.62-98.12c-4.476-13.463-17.07-22.548-31.259-22.548h-52.623l-11.461-34.384 c-2.896-8.691-11.029-14.553-20.19-14.553h-22.192c-9.161,0-17.294,5.861-20.19,14.553L139.84,49.08H87.217 c-14.188,0-26.783,9.085-31.259,22.548l-32.62,98.12C9.829,173.858,0,186.415,0,201.268v80.939 c0,18.187,14.735,32.93,32.918,32.941v40.471c0,5.199,4.214,9.412,9.412,9.412h43.293c5.199,0,9.412-4.213,9.412-9.412v-40.471 H270.14v40.471c0,5.199,4.214,9.412,9.412,9.412h43.294c5.198,0,9.411-4.213,9.411-9.412v-40.471 c18.183-0.014,32.918-14.756,32.918-32.941v-80.939C365.175,186.415,355.346,173.859,341.837,169.748z M156.298,26.347h17.526V8.82 h17.526v17.526h17.525v17.526H191.35V26.347h-17.526v17.526h-17.526V26.347z M90.61,88.842h183.953l19.693,65.84H70.023 L90.61,88.842z M73.587,272.704c-17.305,0-31.333-14.027-31.333-31.332c0-17.306,14.028-31.334,31.333-31.334 s31.333,14.028,31.333,31.334C104.92,258.676,90.892,272.704,73.587,272.704z M291.587,272.704 c-17.305,0-31.333-14.027-31.333-31.332c0-17.306,14.028-31.334,31.333-31.334s31.333,14.028,31.333,31.334 C322.92,258.676,308.892,272.704,291.587,272.704z"/></g></svg>
                  <p class="card-title">Ваш заказ принят! &nbsp;<i class="fa-solid fa-wand-magic-sparkles"></i></p>
                    <p class="card-description">Статус вашего заказа: "<span style='color: rgb(<?=$user_order['color']?>);'><?=$user_order['status_name'];?><img class='status_order' src='<?=FILES?>status_order/<?=$user_order['status_img'];?>'></span>"</p>
                    <button type="button" value='<?=$user_order['id_order']?>' class="chat__button card-description btn btn-info btn-sm text-center card_button my-2" style="color: black; background: black;" data-bs-toggle="modal" data-bs-target="#exampleModal2"><i class="fa-regular fa-comment"></i>&nbsp;<span>Чат с водителем</span></button></p>
                    <button type="submit" class="btn btn-danger my-2"  name='end__order' value="<?=$user_order['id_order']?>">Отменить заказ</button>
                    <?php if($_SESSION['auth']['check_rate_user'] == 0):?>
                    <p class="card-description">Оцените работу водителя по 5-ти бальной шкале.</p>
                  <div class="rating-area">
	                  <input type="radio" id="star-5" name="rating" value="5">
                    <label for="star-5" title="Оценка «5»"></label>	
                    <input type="radio" id="star-4" name="rating" value="4">
                    <label for="star-4" title="Оценка «4»"></label>    
                    <input type="radio" id="star-3" name="rating" value="3">
                    <label for="star-3" title="Оценка «3»"></label>  
                    <input type="radio" id="star-2" name="rating" value="2">
                    <label for="star-2" title="Оценка «2»"></label>
                    <input type="radio" id="star-1" name="rating" value="1">
                    <label for="star-1" title="Оценка «1»"></label>
                  </div>
                  <button type="submit" class="btn btn-warning my-2"  name='rate__user' value="<?=$user_order['id_order']?>">Оценить</button>
                  <?elseif($_SESSION['auth']['check_rate_user'] == 1):?>
                      <p class="card-description">Спасибо что оценили работу водителя!</p>
                    <?php endif;?>
                    <?php if($_SESSION['auth']['id_user'] == $user_order['id_client'] && $user_order['id_status'] == 7){
                      $_SESSION['auth']['check_rate_user'] = 0;
                    }?>
              </div>
          </div>
      <?endif;?>
    <? endforeach;?>
  <? endif;?>


<? endif;?>
</form>

<!-- Модальное окно чата с водителем-->
<div class="modal fade" id="exampleModal2" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
      <div class="modal-content">
          <div class="modal-header">
              <h1 class="modal-title fs-5 text-center" id="exampleModalLabel">Чат с водителем</h1>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Закрыть"></button>
          </div>
          <div class="modal-body">
              <div class="col m-auto">

              <!-- Контент модального окна -->
                <div class='chat'>
	                <div class='chat-messages'>
		                <div class='chat-messages__content' id='messages'>
			                Загрузка...
		                </div>
	                </div>
	                <div class='chat-input'>
		                <form method='post' id='chat-form'>
			                <input type='text' id='message-text' class='chat-form__input' placeholder='Введите сообщение' onkeyup='checkParams()' /> 
                      <button type='submit' id='submit' class='send__message__chat' name='send__message' disabled class='chat-form__submit' value=''>=></button>
		                </form>
	                </div>
                </div>
              <!-- Контент модального окна -->
              </div>
          </div>
          <div class="modal-footer">
              <button type="submit" class="btn btn-secondary" id="scrollDown" >Прокрутить вниз</button>
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Закрыть</button>
          </div>
      </div>
  </div>
</div>
<!-- Модальное окно чата с водителем-->
