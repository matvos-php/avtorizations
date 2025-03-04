<link rel="stylesheet" href='<?=CSS?>body_table.css'>


<form action="" method="POST" enctype="multipart/form-data" class="col-md-12">
    <!-- Отображение таблички с добавлением городов -->
    <div class="row row2">
        <div class="first-tablichka col-md-12">
            <h1 class='text-center py-2'>Список водителей</h1>
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
                                    Фамилия
                                </td>
                                <td>
                                    Имя
                                </td>
                                <td>
                                    Отчество
                                </td>
                                <td>
                                    Номер
                                </td>
                                <td>
                                    Марка машины
                                </td>
                                <td>
                                    Тип тарифа
                                </td>
                                <td>
                                    Тип услуги
                                </td>
                                <td>
                                    Рейтинг водителя
                                </td>

                            </tr>
                            <?php if ($drivers):?>
                            <?php $i=1;
                    foreach($drivers as $driver):?>
                            <tr>
                                <td>
                                    <?=$i?>
                                </td>
                                <td>
                                    <?=$driver['surname']?>
                                </td>
                                <td>
                                    <?=$driver['name']?>
                                </td>
                                <td>
                                    <?=$driver['patronymic']?>
                                </td>
                                <td>
                                    <?=$driver['phone']?>
                                </td>
                                <td>
                                <?php if ($_GET['edit-driver'] == $driver['id_user']):?>
                                    <select class = 'form-control' name="car-list" id="">
                                            <?foreach ($cars as $car):?>
                                                <option <? if($car['id_car'] == $driver['id_user']):?>selected<?endif;?> value="<?=$car['id_car']?>"><?=$car['brand']?></option>
                                            <?endforeach;?>
                                    </select>
                                    <?php else: ?>
                                    <?=$driver['brand']?>
                                    <?php endif;?>
                                </td>
                                <td>
                                <?php if ($_GET['edit-driver'] == $driver['id_user']):?>
                                    <select class = 'form-control' name="tarif-list" id="">
                                            <?foreach ($tarifs as $tarif):?>
                                                <option <? if($tarif['id_tarif'] == $driver['id_user']):?>selected<?endif;?> value="<?=$tarif['id_tarif']?>"><?=$tarif['tarif_name']?></option>
                                            <?endforeach;?>
                                    </select>
                                    <?php else: ?>
                                        <?=$driver['tarif_name']?>
                                    <?php endif;?>
                                </td>
                                <td>
                                <?php if ($_GET['edit-driver'] == $driver['id_user']):?>
                                    <select class = 'form-control' name="uslug-list" id="">
                                            <?foreach ($uslugs as $uslug):?>
                                                <option <? if($uslug['id_uslug'] == $driver['id_user']):?>selected<?endif;?> value="<?=$uslug['id_uslug']?>"><?=$uslug['name_uslug']?></option>
                                            <?endforeach;?>
                                    </select>
                                    <?php else: ?>
                                    <?=$driver['name_uslug']?>
                                    <?php endif;?>
                                </td>
                                <td>
                                    <?=$driver['rating']?>
                                </td>
                                <td>
                                    <a href="?view=drivers&delete-driver=<?=$driver['id_user']?>" class = 'del_driver btn btn-outline-danger btn-sm py-1' name = 'delete-driver' value = 'Удалить'>Удалить</a>

                                    <?php if ($_GET['edit-driver'] == $driver['id_user']):?>
                                        <button class = 'save_driver btn btn-outline-success btn-sm py-1' name = 'save-driver' value = 'Применить'>Применить</button>
                                    <? else:?>
                                        <a href="?view=drivers&edit-driver=<?=$driver['id_user']?>" class = 'edit_driver btn btn-outline-light btn-sm py-1' name = 'edit-driver' value = 'Edit'>Edit</a>
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
                </div>
                <div class="text-center">
                        <? if(isset($_SESSION['answer'])){
                                echo $_SESSION['answer'];
                                unset($_SESSION['answer']);}?>
                    </div>
                </div>
            </div>
        </div>
</form>