<link rel="stylesheet" href='<?=CSS?>body_table.css'>

<form action="" method="POST" enctype="multipart/form-data" class="col-md-12">
    <!-- Отображение таблички с добавлением городов -->
    <div class="row row2">
        <div class="first-tablichka col-md-12">
            <h1 class='text-center'>Список услуг</h1>
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
                                    Наименование услуги
                                </td>
                            </tr>
                            <?php if ($uslugs):?>
                            <?php $i=1;
                    foreach($uslugs as $uslug):?>
                            <tr>
                                <td>
                                    <?=$i?>
                                </td>
                                <td>
                                    <?php if ($_GET['edit-uslug'] == $uslug['id_uslug']):?>
                                        <input type="text" class="form-control" id="floatingInputValue" placeholder="Введите наименование услуги" name='usluga-name' value = "<?=$uslug['name_uslug']?>">
                                    <?php else: ?>
                                        <?=$uslug['name_uslug']?>
                                    <?php endif;?>
                                </td>
                                <td>
                                    <a href="?view=uslugs&delete-uslug=<?=$uslug['id_uslug']?>" class = 'del_uslug btn btn-outline-danger btn-sm py-1' name = 'delete-uslug' value = 'Удалить'>Удалить</a>

                                    <?php if ($_GET['edit-uslug'] == $uslug['id_uslug']):?>
                                        <button class = 'save_uslug btn btn-outline-success btn-sm py-1' name = 'save-uslug' value = 'Применить'>Применить</button>
                                    <? else:?>
                                        <a href="?view=uslugs&edit-uslug=<?=$uslug['id_uslug']?>" class = 'edit_uslug btn btn-outline-light btn-sm py-1' name = 'edit-uslug' value = 'Edit'>Edit</a>
                                    <? endif;?>
                                </td>
                            </tr>
                            <? $i++; endforeach;?>
                            <!-- Кнопка для модального окна-->
                            <div class="text-right">
                                <button type="button" class="btn btn-success btn-sm mx-5" data-bs-toggle="modal" data-bs-target="#exampleModal">Добавить новую услугу</button>
                            </div>
                        <!-- Кнопка для модального окна-->
                            <!-- Модальное окно -->
                            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h1 class="modal-title fs-5" style="color: black;" id="exampleModalLabel">Добавление новой услуги</h1>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Закрыть"></button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="col m-auto">

                                            <!-- Контент модального окна -->
                                                <input type="text" class="form-control my-2" id="floatingInputValue" placeholder="Введите название услуги" name='usluga'>
                                                <div class="row">
                                            <!-- Контент модального окна -->
                                        </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Закрыть</button>
                                            <button type="submit" class="btn btn-success"  name='add-uslug'value='Добавить'>Сохранить изменения</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <!-- Модальное окно -->
                            <?php else:?>
                            <tr class='alert alert-info'>
                                <td class='text-center' colspan=2>
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