<link rel="stylesheet" href='<?=CSS?>body_table.css'>

<? //print_arr($_POST);?>

<form action="" method="POST" enctype="multipart/form-data" class="col-md-12">
    <div class="row row2">
        <div class="first-tablichka col-md-12">
            <h1 class='text-center'>Список машин</h1>
            <div class="row">
                <div class="col-md-12">
		                    <div class="row">
			                    <div class="col-md-4">
					                    <input type="text" class="form-control" id="number" name="text_search" placeholder="Поиск">
			                    </div>
			                    <div class="col-md-2">
					                    <input type="submit" class="btn btn-outline-primary text-center" name="search" value="Искать">
			                    </div>
		                    </div>
                            <div class="text-right">
                                <button type="button" class="btn btn-success btn-sm mx-5 my-3" data-bs-toggle="modal" data-bs-target="#exampleModal">Добавить новую машину</button>
                            </div>
                        <!-- Модальное окно -->
                            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h1 class="modal-title fs-5" style="color: black;" id="exampleModalLabel">Добавление новой машины</h1>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Закрыть"></button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="col m-auto">

                                            <!-- Контент модального окна -->
                                                <input type="text" class="form-control my-2" id="floatingInputValue" placeholder="Введите марку машины" name='brand-car-add'>
                                                <input type="text" class="form-control my-2" id="floatingInputValue" placeholder="Введите цвет машины" name='color-car-add'>
                                                <input type="text" class="form-control my-2" id="floatingInputValue" placeholder="Введите тип машины (Хэчбек/Седан)" name='type-car-add'>
                                                <input type="text" class="form-control my-2" id="floatingInputValue" placeholder="Введите гос. номер машины" name='gov-number-add'>
                                            <!-- Контент модального окна -->
                                        </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Закрыть</button>
                                            <button type="submit" class="btn btn-success"  name='add-car'value='Добавить'>Сохранить изменения</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <!-- Модальное окно -->
                    <table class='table'>
                        <tbody>
                            <tr>
                                <td>
                                    #
                                </td>
                                <td>
                                    Марка машины
                                </td>
                                <td>
                                    Цвет
                                </td>
                                <td>
                                    Тип машины
                                </td>
                                <td>
                                    Гос. номер
                                </td>
                            </tr>
                            <?php if ($cars):?>
                            <?php $i=1;
                    foreach($cars as $car):?>
                            <tr>
                                <td>
                                    <?=$i?>
                                </td>
                                <td>
                                    <?php if ($_GET['edit-car'] == $car['id_car']):?>
                                        <input type="text" class="form-control" id="floatingInputValue" placeholder="Введите марку машины" name='brand-car' value = "<?=$car['brand']?>">
                                    <?php else: ?>
                                    <?=$car['brand']?>
                                    <?php endif;?>
                                </td>
                                <td>
                                    <?php if ($_GET['edit-car'] == $car['id_car']):?>
                                        <input type="text" class="form-control" id="floatingInputValue" placeholder="Введите цвет машины" name='color-car' value = "<?=$car['color']?>">
                                    <?php else: ?>
                                    <?=$car['color']?>
                                    <?php endif;?>
                                </td>
                                <td>
                                <?php if ($_GET['edit-car'] == $car['id_car']):?>
                                        <input type="text" class="form-control" id="floatingInputValue" placeholder="Введите тип машины" name='type-car' value = "<?=$car['type_car']?>">
                                    <?php else: ?>
                                    <?=$car['type_car']?>
                                    <?php endif;?>
                                </td>
                                <td>
                                    <?php if ($_GET['edit-car'] == $car['id_car']):?>
                                        <input type="text" class="form-control" id="floatingInputValue" placeholder="Введите гос. номер машины" name='gov-car' value = "<?=$car['gov_number']?>">
                                    <?php else: ?>
                                    <?=$car['gov_number']?>
                                    <?php endif;?>
                                </td>
                                <td>
                                    <a href="?view=cars&delete-car=<?=$car['id_car']?>" class = 'del_car btn btn-outline-danger btn-sm py-1' name = 'delete-car' value = 'Удалить'>Удалить</a>

                                    <?php if ($_GET['edit-car'] == $car['id_car']):?>
                                        <button class = 'save_car btn btn-outline-success btn-sm py-1' name = 'save-car' value = 'Применить'>Применить</button>
                                    <? else:?>
                                        <a href="?view=cars&edit-car=<?=$car['id_car']?>" class = 'edit_car btn btn-outline-light btn-sm py-1' name = 'edit-car' value = 'Edit'>Edit</a>
                                    <? endif;?>
                                </td>
                            </tr>
                            <? $i++; endforeach;?>
                            <?php else:?>
                            <tr class='alert alert-info'>
                                <td class='text-center' colspan=6>
                                    Таблица пуста! Добавьте новые записи.
                                </td>
                            </tr>
                            <?php endif;?>
                        </tbody>
                    </table>
                    <div class="text-center">
                        <? if(isset($_SESSION['answer'])){
                                echo $_SESSION['answer'];
                                unset($_SESSION['answer']);}?>
                    </div>
                </div>
            </div>
        </div>
</form>