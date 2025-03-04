<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href='<?=CSS?>style.css'>
<!--============================================Для авторизации===================================================-->
    <link rel="stylesheet" href="<?=CSS?>util.css">
	<link rel="stylesheet" href="<?=CSS?>main.css">
<!--===============================================================================================-->	
	<link rel="icon" href="<?IMG?>icons/favicon.ico"/>
<!--===============================================================================================-->
	<link rel="stylesheet" href="<?BOOTSTRAP?>bootstrap.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" href="<?FONTS?>font-awesome-4.7.0/css/font-awesome.min.css">
<!--===============================================================================================-->
    <title><?=TITLE?></title>
</head>

<script src="<?=JS?>bootstrap.bundle.min.js"></script>
<script src="<?=JS?>jquery-3.7.1.min.js"></script>
<script src="<?=JS?>jquery.maskedinput.min.js"></script>
<script src="<?=JS?>script.js"></script>

<body>
<?if (!isset($_SESSION['auth']['logged'])):?>
<form method="post" action="" name="signup">
    <div class="limiter">
		<div class="container-login100" style="background-image: url('images/bg-01.jpg');">
			<div class="wrap-login100 p-l-55 p-r-55 p-t-65 p-b-54">
			
			<a class="navbar-brand">
                <object type="image/svg+xml" data="logo.svg" >
                    <img class="logo-auth" src="<?=IMG?>icons/logo-black.svg" alt="Таксопарк Драйвер">
                </object>
            </a>
				<? if(isset($_POST['reg'])): ?>
					<span class="login100-form-title p-b-49">
						Регистрация
					</span>

					<div class="wrap-input100 validate-input m-b-23">
						<span class="label-input100">Логин</span>
						<input class="input100 input-en" type="text" name="login" placeholder="Придумайте логин">
					</div>

					<div class="wrap-input100 validate-input">
						<span class="label-input100">Пароль</span>
						<input class="input100 input-en" type="password" name="password" id="password-input" placeholder="Придумайте пароль">
					</div>
					<label class='black my-5'><input type="checkbox" class="password-checkbox"> Показать пароль</label>

                    <div class="wrap-input100 validate-input">
						<span class="label-input100">Номер телефона</span>
						<input class="tel input100 input-number" type="tel" name="phone" placeholder="Номер телефона">
					</div>

                    <div class="wrap-input100 validate-input ">
						<span class="label-input100">Электронная почта</span>
						<input class="input100 input-en" type="email" name="mail" placeholder="Электронная почта">
					</div>
					<div class="wrap-input100 validate-input">
						<span class="label-input100">Фамилия</span>
						<input class="input100 input-ru" type="text" name="surname" placeholder="Введите вашу фамилию">
					</div>
					<div class="wrap-input100 validate-input">
						<span class="label-input100">Имя</span>
						<input class="input100 input-ru" type="text" name="name" placeholder="Введите ваше имя">
					</div>
					<div class="wrap-input100 validate-input">
						<span class="label-input100">Отчество</span>
						<input class="input100 input-ru" type="text" name="patronymic" placeholder="Введите ваше отчество">
					</div>
					<div class="container-login100-form-btn">
						<div class="wrap-login100-form-btn">
							<div class="login100-form-bgbtn"></div>
							<button class="login100-form-btn border my-2" type="submit" name="register" value="register">
								Зарегестрироваться
							</button>
                            <button class="login100-form-btn border" type="submit" name="back" value="back">
								Вернуться
							</button>
						</div>
					</div>
					<?if (isset($_SESSION['answer'])){
						echo $_SESSION['answer'];
						unset($_SESSION['answer']);
					}
					?>
					<? endif;?>
					<? if(!isset($_POST['reg'])): ?>
					<span class="login100-form-title p-b-49">
						Вход
					</span>
					<div class="wrap-input100 validate-input m-b-23">
						<span class="label-input100">Логин</span>
						<input class="input100 input-en" type="text" name="login" placeholder="Введите ваш логин">
					</div>

					<div class="wrap-input100 validate-input">
						<span class="label-input100">Пароль</span>
						<input class="input100 input-en" type="password" name="password" id="password-input" placeholder="Введите пароль">
					</div>
					<label class='black my-5'><input type="checkbox" class="password-checkbox"> Показать пароль</label>
					<div class="text-right p-t-8 p-b-31">
						<!-- <a href="#">
							Забыли пароль?
						</a> -->
					</div>
					<div class="container-login100-form-btn">
						<div class="wrap-login100-form-btn">
							<div class="login100-form-bgbtn"></div>
							<button class="login100-form-btn border" type="submit" name="auth" value="auth">
								Войти
							</button>
                            <button class="login100-form-btn border" type="submit" name="reg" value="reg">
								Регистрация
							</button>
						</div>
					</div>
						<? endif;?>
					<?if (isset($_SESSION['answer'])){
						echo $_SESSION['answer'];
						unset($_SESSION['answer']);
					}
					?>
                    <?
                        if (isset($_SESSION['auth']['error'])){
                            echo $_SESSION['auth']['error'];
                            unset ($_SESSION['auth']['error']);
                        }
                    ?>
					</div>
				</form>
			</div>
		</div>
    </div>
</form>
<? endif;?>
</body>
<script src="<?=JS?>bootstrap.bundle.min.js"></script>
<script src="<?=JS?>jquery-3.7.1.min.js"></script>
<script src="<?=JS?>jquery.maskedinput.min.js"></script>
<script src="<?=JS?>script.js"></script>
<script src="<?=JS?>styles.js"></script>
<script src="<?=JS?>timeline.js"></script>
<script src="<?=JS?>map.js"></script>
</html>