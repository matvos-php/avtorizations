<link rel="stylesheet" href='<?=CSS?>table.css'>
<div class="">
</div>
<section>
  <!--for demo wrap-->
  <h1 class="start">Заявки на водителей</h1>
  <div class="tbl-header">
    <form action="" method="post">
      <table cellpadding="0" cellspacing="0" border="0">
        <thead>
          <tr>
            <th class='text-center'>#</th>
            <th class='text-center'>Фамилия</th>
            <th class='text-center'>Имя</th>
            <th class='text-center'>Отчество</th>
            <th class='text-center'>Номер телефона</th>
            <th class='text-center'>Автомобиль</th>
            <th class='text-center'>Стаж вождения</th>
            <th class='text-center'>Лицензия на вождение</th>
            <th class='text-center'>Кнопки для управления</th>
          </tr>
        </thead>
      </table>
    </div>
    <div class="tbl-content">
      <table cellpadding="0" cellspacing="0" border="0">
        <tbody>
        <?php if ($all_application_drivers):?>
          <?php $i=1;
              foreach($all_application_drivers as $all_application_driver):?>
          <tr>
              <td class='text-center'><?=$i?></td>
              <td class='text-center'><?=$all_application_driver['surname']?></td>
              <td class='text-center'><?=$all_application_driver['name']?></td>
              <td class='text-center'><?=$all_application_driver['patronymic']?></td>
              <td class='text-center'><?=$all_application_driver['phone']?></td>
              <td class='text-center'><?=$all_application_driver['brand_car']?></td>
              <td class='text-center'><?=$all_application_driver['driving_age']?></td>
              <td class='text-center'><?=$all_application_driver['license']?></td>
              <td class='text-center'>
                <button type="submit" class="btn btn-success"  name='confirm__application' value="<?=$all_application_driver['id_user']?>">Принять заявку!</button>
                <button type="submit" class="btn btn-danger my-2"  id='__confirm' name='discard__application' value="<?=$all_application_driver['id_user']?>">Отменить</button>
            </td>
          </tr>
          <? $i++; endforeach;?>
          <?php else:?>
          <tr class=''>
              <td class='text-center' colspan=9>
                  Сейчас новых заявок нет.
              </td>
          </tr>
          <?php endif;?>
        </tbody>
      </table>
    </form>
    <div class="text-center">
        <? if(isset($_SESSION['answer'])){
                echo $_SESSION['answer'];
                unset($_SESSION['answer']);}?>
    </div>
  </div>
</section>