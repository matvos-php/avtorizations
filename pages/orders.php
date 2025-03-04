<link rel="stylesheet" href='<?=CSS?>body_table.css'>

<link rel="stylesheet" href='<?=CSS?>body_table.css'>

<form action="" method="POST" enctype="multipart/form-data" class="col-md-12">
    <div class="row row2">
        <div class="first-tablichka col-md-12">
            <h1 class='text-center'>Список заказов</h1>
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
                                    Телефон
                                </td>
                                <td>
                                    Рейтинг
                                </td>
                            </tr>
                            <?php if ($clients):?>
                            <?php $i=1;
                    foreach($clients as $client):?>
                            <tr>
                                <td>
                                    <?=$i?>
                                </td>
                                <td>
                                    <?php if ($_GET['edit-client'] == $client['id_client']):?>
                                        <input type="text" class="form-control" id="floatingInputValue" placeholder="Введите имя клиента" name='client-name' value = "<?=$client['name']?>">
                                    <?php else: ?>
                                    <?=$client['name']?>
                                    <?php endif;?>
                                </td>
                                <td>
                                    <?php if ($_GET['edit-client'] == $client['id_client']):?>
                                        <input type="text" class="form-control" id="floatingInputValue" placeholder="Введите фамилию клиента" name='client-surname' value = "<?=$client['surname']?>">
                                    <?php else: ?>
                                    <?=$client['surname']?>
                                    <?php endif;?>
                                </td>
                                <td>
                                    <?php if ($_GET['edit-client'] == $client['id_client']):?>
                                        <input type="text" class="form-control" id="floatingInputValue" placeholder="Введите отчество (если есть) клиента" name='client-patronymic' value = "<?=$client['patronymic']?>">
                                    <?php else: ?>
                                    <?=$client['patronymic']?>
                                    <?php endif;?>
                                </td>
                                <td>
                                    <?php if ($_GET['edit-client'] == $client['id_client']):?>
                                        <input type="text" class="form-control" id="floatingInputValue" placeholder="Введите номер телефона клиента" name='client-phone' value = "<?=$client['phone']?>">
                                    <?php else: ?>
                                    +<?=$client['phone']?>
                                    <?php endif;?>
                                </td>
                                <td>
                                    <?php if ($_GET['edit-client'] == $client['id_client']):?>
                                        <input type="text" class="form-control" id="floatingInputValue" placeholder="Введите рейтинг клиента" name='client-rating' value = "<?=$client['rating']?>">
                                    <?php else: ?>
                                    <?=$client['rating']?>
                                    <?php endif;?>
                                </td>
                                <td>
                                    <a href="?view=clients&delete-client=<?=$client['id_client']?>" class = 'del_client btn btn-outline-danger btn-sm py-1' name = 'delete-client' value = 'Удалить'>Удалить</a>

                                    <?php if ($_GET['edit-client'] == $client['id_client']):?>
                                        <button class = 'save_client btn btn-outline-success btn-sm py-1' name = 'save-client' value = 'Применить'>Применить</button>
                                    <? else:?>
                                        <a href="?view=clients&edit-client=<?=$client['id_client']?>" class = 'edit_client btn btn-outline-light btn-sm py-1' name = 'edit-client' value = 'Edit'>Edit</a>
                                    <? endif;?>
                                </td>
                            </tr>
                            <? $i++; endforeach;?>
                            <div class="text-right">
                                <button type="button" class="btn btn-success btn-sm mx-5 my-3" data-bs-toggle="modal" data-bs-target="#exampleModal">Добавить нового клиента</button>
                            </div>
                        <!-- Модальное окно -->
                            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h1 class="modal-title fs-5" style="color: black;" id="exampleModalLabel">Добавление нового клиента</h1>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Закрыть"></button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="col m-auto">
                                            <!-- Контент модального окна -->
                                                <input type="text" class="form-control my-2" id="floatingInputValue" placeholder="Введите фамилию клиента" name='surname'>
                                                <input type="text" class="form-control my-2" id="floatingInputValue" placeholder="Введите имя клиента" name='name'>
                                                <input type="text" class="form-control my-2" id="floatingInputValue" placeholder="Введите отчество (если есть) клиента" name='patronymic'>
                                                <input type="text" class="form-control my-2" placeholder="+7 (123) 456 78-90" name="phone">
                                                <!-- Выпадаюший список -->
                                                <select class='form-control my-2' name="rating_list">
                                                    <option value="">Выбрать рейтинг</option>
                                                        <option value="5">5</option>
                                                        <option value="4">4</option>
                                                        <option value="3">3</option>
                                                        <option value="2">2</option>
                                                        <option value="1">1</option>
                                                </select>
                                            <!-- Контент модального окна -->
                                        </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Закрыть</button>
                                            <button type="submit" class="btn btn-success"  name='add-client'value='Добавить'>Сохранить изменения</button>
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
                    <div class="text-center">
                        <? if(isset($_SESSION['answer'])){
                                echo $_SESSION['answer'];
                                unset($_SESSION['answer']);}?>
                    </div>
                </div>
            </div>
        </div>
</form>