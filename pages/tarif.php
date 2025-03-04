<link rel="stylesheet" href='<?=CSS?>body_table.css'>

<form action="" method="POST" enctype="multipart/form-data" class="col-md-12">
    <!-- Отображение таблички с добавлением городов -->
    <div class="row row2">
        <div class="first-tablichka col-md-12">
            <h1 class='text-center'>Список тарифов</h1>
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
                    <table class='table'>
                        <tbody>
                            <tr>
                                <td>
                                    #
                                </td>
                                <td>
                                    Наименование тарифа
                                </td>
                                <td>
                                    Стоимость тарифа
                                </td>
                            </tr>
                            <?php if ($tarifs):?>
                            <?php $i=1;
                    foreach($tarifs as $tarif):?>
                            <tr>
                                <td>
                                    <?=$i?>
                                </td>
                                <td>
                                <?php if ($_GET['edit-tarif'] == $tarif['id_tarif']):?>
                                        <input type="text" class="form-control" id="floatingInputValue" placeholder="Введите наименование тарифа" name='tarif-name' value = "<?=$tarif['tarif_name']?>">
                                    <?php else: ?>
                                    <?=$tarif['tarif_name']?>
                                    <?php endif;?>
                                </td>
                                <td>
                                <?php if ($_GET['edit-tarif'] == $tarif['id_tarif']):?>
                                        <input type="text" class="form-control" id="floatingInputValue" placeholder="Введите цену тарифа" name='tarif-cost' value = "<?=$tarif['tarif_cost']?>">
                                    <?php else: ?>
                                    <?=$tarif['tarif_cost']?> ₽
                                    <?php endif;?>
                                </td>
                                <td>
                                    <a href="?view=tarif&delete-tarif=<?=$tarif['id_tarif']?>" class = 'del_tarif btn btn-outline-danger btn-sm py-1' name = 'delete-tarif' value = 'Удалить'>Удалить</a>

                                    <?php if ($_GET['edit-tarif'] == $tarif['id_tarif']):?>
                                        <button class = 'save_tarif btn btn-outline-success btn-sm py-1' name = 'save-tarif' value = 'Применить'>Применить</button>
                                    <? else:?>
                                        <a href="?view=tarif&edit-tarif=<?=$tarif['id_tarif']?>" class = 'edit_tarif btn btn-outline-light btn-sm py-1' name = 'edit-tarif' value = 'Edit'>Edit</a>
                                    <? endif;?>
                                </td>
                            </tr>
                            <? $i++; endforeach;?>
                            <div class="text-right">
                                <button type="button" class="btn btn-success btn-sm mx-5" data-bs-toggle="modal" data-bs-target="#exampleModal">Добавить новый тариф</button>
                            </div>
                            <!-- Модальное окно -->
                            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h1 class="modal-title fs-5" style="color: black;" id="exampleModalLabel">Добавление нового тарифа</h1>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Закрыть"></button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="col m-auto">
                    
                                            <!-- Контент модального окна -->
                                                <input type="text" class="form-control my-2" id="floatingInputValue" placeholder="Введите название тарифа" name='tarif-name'>
                                                <div class="row">
                                                    <div class="col-md-8">
                                                        <input type="text" class="password form-control my-2" id="floatingInputValue" placeholder="Введите стоимость тарифа" name='tarif-cost'>
                                                    </div>
                                                </div>
                                            <!-- Контент модального окна -->
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Закрыть</button>
                                            <button type="submit" class="btn btn-success"  name='add-tarif'value='Добавить'>Сохранить изменения</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <!-- Модальное окно -->
                            <?php else:?>
                            <tr class='alert alert-info'>
                                <td class='text-center' colspan=6>
                                    Таблица пуста! Добавьте новые записи.
                                </td>
                            </tr>
                            <?php endif;?>
                        </tbody>
                    </table>
                </div>
                        <? if(isset($_SESSION['answer'])){
                                echo $_SESSION['answer'];
                                unset($_SESSION['answer']);}?>
                    </div>
                </div>
            </div>
        </div>
</form>