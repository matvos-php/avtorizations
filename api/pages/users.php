<link rel="stylesheet" href='<?=CSS?>body_table.css'>

<? //print_arr($_POST);?>

<form action="" method="POST" enctype="multipart/form-data" class="col-md-12">
    <div class="row row2">
        <div class="first-tablichka col-md-12">
            <h1 class='text-center'>Список пользователей</h1>
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
                                <button type="button" class="btn btn-success btn-sm mx-5 my-3" data-bs-toggle="modal" data-bs-target="#exampleModal">Добавить нового пользователя</button>
                            </div>
                    <table class='table'>
                        <tbody>
                            <tr>
                                <td>
                                    #
                                </td>
                                <td>
                                    Логин
                                </td>
                                <td>
                                    Пароль
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
                                    Роль
                                </td>
                                <td>
                                    Почта
                                </td>
                            </tr>
                            <?php if ($users):?>
                            <?php $i=1;
                    foreach($users as $c):?>
                            <tr>
                                <td>
                                    <?=$i?>
                                </td>
                                <td>
                                    <?php if ($_GET['edit-user'] == $c['id_user']):?>
                                        <input type="text" class="form-control input-en" id="floatingInputValue" placeholder="Введите логин пользователя" name='login-user' value = "<?=$c['login']?>">
                                    <?php else: ?>
                                    <?=$c['login']?>
                                    <?php endif;?>
                                </td>
                                <td>
                                    <?php if ($_GET['edit-user'] == $c['id_user']):?>
                                        <input type="text" class="form-control input-en" id="floatingInputValue" placeholder="Введите пароль пользователя" name='password-user' value = "<?=$c['password']?>">
                                    <?php else: ?>
                                    <?=$c['password']?>
                                    <?php endif;?>
                                </td>
                                <td>
                                    <?php if ($_GET['edit-user'] == $c['id_user']):?>
                                        <input type="text" class="form-control input-ru" id="floatingInputValue" placeholder="Введите фамилию пользователя" name='surname-user' value = "<?=$c['surname']?>">
                                    <?php else: ?>
                                    <?=$c['surname']?>
                                    <?php endif;?>
                                </td>
                                <td>
                                    <?php if ($_GET['edit-user'] == $c['id_user']):?>
                                        <input type="text" class="form-control input-ru" id="floatingInputValue" placeholder="Введите имя пользователя" name='name-user' value = "<?=$c['name']?>">
                                    <?php else: ?>
                                    <?=$c['name']?>
                                    <?php endif;?>
                                </td>
                                <td>
                                    <?php if ($_GET['edit-user'] == $c['id_user']):?>
                                        <input type="text" class="form-control input-ru" id="floatingInputValue" placeholder="Введите отчество пользователя" name='patronymic-user' value = "<?=$c['patronymic']?>">
                                    <?php else: ?>
                                    <?=$c['patronymic']?>
                                    <?php endif;?>
                                </td>
                                <td>
                                    <?php if ($_GET['edit-user'] == $c['id_user']):?>
                                        <input type="text" class="tel form-control" id="floatingInputValue" placeholder="Введите номер телефона пользователя" name='phone-user' value = "<?=$c['phone']?>">
                                    <?php else: ?>
                                    <?=$c['phone']?>
                                    <?php endif;?>
                                </td>
                                <td>
                                <?php if ($_GET['edit-user'] == $c['id_user']):?>
                                    <select class = 'form-control' name="user-list1" id="">
                                            <?foreach ($roles as $cc):?>
                                                <option <? if($cc['id_role'] == $c['id_role']):?>selected<?endif;?> value="<?=$cc['id_role']?>"><?=$cc['role_name']?></option>
                                            <?endforeach;?>    
                                    </select>
                                    <?php else: ?>
                                    <?=$c['role_name']?>
                                    <?php endif;?>
                                </td>
                                <td>
                                    <?php if ($_GET['edit-user'] == $c['id_user']):?>
                                        <input type="text" class="form-control" id="floatingInputValue" placeholder="Введите почту пользователя" name='mail-user' value = "<?=$c['password']?>">
                                    <?php else: ?>
                                    <?=$c['mail']?>
                                    <?php endif;?>
                                </td>
                                <td>
                                    <?if($c['role_name'] != 'Администратор'):?>
                                        <a href="?view=users&delete-user=<?=$c['id_user']?>" class = 'del_user btn btn-outline-danger btn-sm py-1' name = 'delete-user' value = 'Удалить'>Удалить</a>
                                    <?php endif;?>

                                    <?php if ($_GET['edit-user'] == $c['id_user']):?>
                                        <button class = 'save_user btn btn-outline-success btn-sm py-1' name = 'save-user' value = 'Применить'>Применить</button>
                                    <? elseif($c['role_name'] != 'Администратор'):?>
                                        <a href="?view=users&edit-user=<?=$c['id_user']?>" class = 'edit_user btn btn-outline-light btn-sm py-1' name = 'edit-user' value = 'Edit'>Edit</a>
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
        <!-- Модальное окно -->
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h1 class="modal-title fs-5" style="color: black;" id="exampleModalLabel">Добавление нового пользователя</h1>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Закрыть"></button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="col m-auto">

                                            <!-- Контент модального окна -->
                                            <span class="label-input100">Логин</span>
                                                <input type="text" class="form-control my-2 input-en" id="floatingInputValue" placeholder="Введите логин пользователя" name='login'>
                                            <span class="label-input100">Фамилия</span>
                                                <input type="text" class="form-control my-2 input-ru" id="floatingInputValue" placeholder="Введите фамилию" name='surname'>
                                            <span class="label-input100">Имя</span>
                                                <input type="text" class="form-control my-2 input-ru" id="floatingInputValue" placeholder="Введите имя" name='name'>
                                            <span class="label-input100">Отчество</span>
                                                <input type="text" class="form-control my-2 input-ru" id="floatingInputValue" placeholder="Введите отчество (если есть)" name='patronymic'>
                                            <span class="label-input100">Номер телефона</span>
                                                <input type="text" class="tel form-control my-2" placeholder="+7 (123) 456 78-90" name="phone">
                                            <span class="label-input100">Пароль</span>
                                                <div class="row">
                                                <div class="col-md-8">
                                                    <input type="text" class="password form-control my-2 input-en" id="floatingInputValue" placeholder="Введите пароль" name='password'>
                                                </div>
                                                <div class="col-md-4">
                                                    <button type="button" class="generator btn btn-info my-2 w-100" name='generator_pass' value='Сгенерировать'>Сгенерировать пароль</button>
                                                </div>
                                                </div>
                                            <span class="label-input100">Роль пользователя</span>
                                                <!-- Выпадаюший список -->
                                                <select class='select-role form-control my-2 ' name="role_list" id="select-role">
                                                    <option value="">Выбрать роль</option>
                                                    <?foreach ($roles as $cc):?>
                                                    <option value="<?=$cc['id_role']?>"><?=$cc['role_name']?></option>
                                                    <?endforeach;?>
                                                </select>
                                            <span class="label-input100">Почта</span>
                                                <input type="text" class="form-control my-2" id="floatingInputValue" placeholder="Введите почту пользователя" name='mail'>
                                                    <hr>
                                                    <div class="add_info_drivers">
                                                        <!-- Контент модального окна -->

                                                <!-- Выпадаюший список по выбору машин-->
                                            <span class="label-input100">Машина</span>
                                                <select class = 'form-control my-2 drivers-parametrs' name="car-list" id="car-list">
                                                    <option value="">Выбрать марку машины</option>
                                                        <?foreach ($cars as $car):?>
                                                            <option value="<?=$car['id_car']?>"><?=$car['brand']?></option>
                                                        <?endforeach;?>
                                                </select>
                                                <!-- Выпадаюший список по выбору машин-->

                                                <!-- Выпадаюший список по выбору тарифа-->
                                            <span class="label-input100">Тариф</span>
                                                <select class = 'form-control my-2 drivers-parametrs' name="tarif-list" id="">
                                                    <option value="">Выбрать тариф</option>
                                                        <?foreach ($tarifs as $tarif):?>
                                                            <option value="<?=$tarif['id_tarif']?>"><?=$tarif['tarif_name']?></option>
                                                        <?endforeach;?>
                                                    </select>

                                                    <!-- Выпадаюший список по выбору услуг-->
                                                <span class="label-input100">Услуга</span>
                                                    <select class = 'form-control my-2 drivers-parametrs' name="uslug-list" id="">
                                                        <option value="">Выбрать тип услуги</option>
                                                            <?foreach ($uslugs as $uslug):?>
                                                                <option value="<?=$uslug['id_uslug']?>"><?=$uslug['name_uslug']?></option>
                                                            <?endforeach;?>
                                                    </select>
                                                    <!-- Выпадаюший список по выбору услуг-->
                                                    </div>
                                            <!-- Контент модального окна -->
                                        </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Закрыть</button>
                                            <button type="submit" class="btn btn-success"  name='add-user'value='Добавить'>Сохранить изменения</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <!-- Модальное окно -->
</form>