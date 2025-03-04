<link rel="stylesheet" href='<?=CSS?>table.css'>
<div class="">
</div>
<section>
  <!--for demo wrap-->
  <h1 class="start">Доступные заказы</h1>
  <div class="tbl-header">
    <form action="" method="post">
      <table cellpadding="0" cellspacing="0" border="0">
        <thead>
          <tr>
            <th class='text-center'>#</th>
            <th class='text-center'>Имя клиента</th>
            <th class='text-center'>Телефон клиента</th>
            <th class='text-center'>Тариф</th>
            <th class='text-center'>Откуда</th>
            <th class='text-center'>Куда</th>
            <th class='text-center'>Дата оформления заказа</th>
            <th class='text-center'>Статус заказа</th>
            <th class='text-center'>Комментарий к заказу</th>
            <th class='text-center'>Имя водителя</th>
            <th class='text-center'>Телефон водителя</th>
            <th class='text-center'>Кнопки для управления</th>
          </tr>
        </thead>
      </table>
    </div>
    <div class="tbl-content">
      <table>
        <tbody>
        <?php if ($user_orders):?>
          <?php $i=1;
              foreach($user_orders as $user_order):?>
          <tr>
              <td class='text-center'><?=$i?></td>
              <td class='text-center'><?=$user_order['client_name']?></td>
              <td class='text-center'><?=$user_order['client_phone']?></td>
              <td class='text-center'><?=$user_order['tarif_name']?></td>
              <td class='text-center'>
                  <?=$user_order['address_out']?>
              </td>
              <td class='text-center'>
                  <?=$user_order['address_come']?>
              </td>
              <td class='text-center'>
                  <?=$user_order['date_order']?>
              </td>
              <td class='text-center'>
              <span style='color: rgb(<?=$user_order['color']?>);'><?=$user_order['status_name'];?><img class='status_order' src='<?=FILES?>status_order/<?=$user_order['status_img'];?>'></span>
              </td>
              <td class='text-center'>
                <?=$user_order['comment']?>
              </td>
              <td class='text-center'>
              <?=$user_order['surname_driver']?> <?=$user_order['name_driver']?>
              </td>
              <td class='text-center'><?=$user_order['phone_driver']?></td>
              <td class='text-center'>
                <?php if($user_order['id_driver'] == NULL):?>
                  <button type="submit" class="btn btn-success"  name='confirm__order' value="<?=$user_order['id_order']?>">Принять заказ</button>
                <?php elseif($user_order['id_status'] == 3):?>
                  <button type="submit" class="btn btn-warning"  name='edit__order4' value="<?=$user_order['id_order']?>">Я приехал!</button>
                <?php elseif($user_order['id_status'] == 4):?>
                  <button type="submit" class="btn btn-success"  name='edit__order5' value="<?=$user_order['id_order']?>">В путь!</button>
                <?php elseif($user_order['id_status'] == 5):?>
                  <button type="submit" class="btn btn-warning"  name='edit__order6' value="<?=$user_order['id_order']?>">Ожидание</button>
                  <button type="button" class="btn btn-danger my-2" value="<?=$user_order['id_order']?>" data-bs-toggle="modal" data-bs-target="#exampleModal5">Завершить заказ</button>
                  <button type="submit" class="btn btn-danger my-2"  name='end__order' value="<?=$user_order['id_order']?>">Завершить заказ</button>
                <?php elseif($user_order['id_status'] == 6):?>
                  <button type="submit" class="btn btn-success"  name='edit__order5' value="<?=$user_order['id_order']?>">В путь!</button>
                  <button type="button" class="btn btn-danger my-2" value="<?=$user_order['id_order']?>" data-bs-toggle="modal" data-bs-target="#exampleModal5">Завершить заказ</button>
                <?php endif;?>
              </td>
          </tr>
          <? $i++; endforeach;?>
          <?php else:?>
          <tr class=''>
              <td class='text-center' colspan=9>
                  Сейчас новых заказов нет.
              </td>
          </tr>
          <?php endif;?>
        </tbody>
      </table>
      <!-- Модальное окно заявки на водителя-->
<div class="modal fade" id="exampleModal5" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
      <div class="modal-content">
          <div class="modal-header">
              <h1 class="modal-title fs-5 text-center" id="exampleModalLabel">Завершение заказа</h1>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Закрыть"></button>
          </div>
          <div class="modal-body">
              <div class="col m-auto">

              <!-- Контент модального окна -->
              <form method="post">
              <p class="card-description">Оцените клиента по 5-ти бальной шкале.</p>
                  <input style="display: none;" value="<?=$user_order['id_client']?>" type="text" name="id_user">
                  <input type="text" class="form-control my-2" id="floatingInputValue" placeholder="" name='' value="<?=$user_order['client_name']?>">
                  
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
              <!-- Контент модального окна -->
              </div>
          </div>
          <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Закрыть</button>
              <button type="submit" class="btn btn-danger my-2"  name='end__order' value="<?=$user_order['id_order']?>">Завершить заказ</button>
          </div>
      </div>
      </form>
  </div>
</div>
<!-- Модальное окно заявки на водителя-->
    </form>
    <div class="text-center">
        <? if(isset($_SESSION['answer'])){
                echo $_SESSION['answer'];
                unset($_SESSION['answer']);}?>
    </div>
  </div>
</section>

