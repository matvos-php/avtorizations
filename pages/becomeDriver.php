
<form action="" method="POST" enctype="multipart/form-data" class="col-md-12">
    <!-- Отображение таблички с добавлением городов -->
    <div class="row row2">
        <div class="first-tablichka col-md-12">
            <h1 class='text-center'>Заявка на водителя</h1>
            <div class="row">
            <!-- Изменить под заявку на водителя -->
                <div class="col-md-6 text-center">
                    <input type="text" class="form-control my-2 text-center" id="floatingInputValue" placeholder="Введите логин пользователя" name='login'>
                </div>
                <div class="row">
                    <div class="col-md-6 text-center">
                        <input type="text" class="password form-control my-2" id="floatingInputValue" placeholder="Введите пароль" name='password'>
                    </div>
                </div>
                    <? if(isset($_SESSION['answer'])){
                        echo $_SESSION['answer'];
                        unset($_SESSION['answer']);}?>
                </div>
            </div>
            <!-- Изменить под заявку на водителя -->
        </div>
    </div>
</form>