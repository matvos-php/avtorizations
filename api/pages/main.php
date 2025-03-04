<?=myFunction();
  unset($_SESSION['auth']['success']);?>

  <div class="container">
  <h2 class="container-title"> &#x200b; </h2>
  <h3 class="container__title"> &#x200b; </h3>


  <header>
  <h1>Таксопарк «Драйвер» к вашим услугам!</h1>
</header>
<div class="band">
  <div class="item-1">
    <a class="card">
      <div class="thumb" style="background-image: url(<?=IMG?>tarif_img/comfort.jpg); border-radius: 10px;"></div>
      <article>
        <h1>В нашем таксопарке только качественные автомобили!</h1>
        <button type="button"  data-bs-toggle="modal" data-bs-target="#exampleModal1" name=''><span>Убедитесь в этом сами -></button></span>
      </article>
    </a>
  </div>
  <div class="item-2">
    <a class="card">
      <div class="thumb" style="background-image: url(<?=IMG?>tarif_img/description_2.jpg); border-radius: 10px;"></div>
      <article>
        <h1>Комфорт больше чем просто слова. 🧐</h1>
        <span>Наши клиенты нам доверяют, доверьтесь и Вы!🫵</span>
      </article>
    </a>
  </div>
  <div class="item-3">
    <aclass="card">
      <a class="card">
        <div class="thumb" style="background-image: url(<?=IMG?>tarif_img/heart.jpg); border-radius: 10px;"></div>
        <article>
          <h1>Развиваемся для вас!</h1>
          <p style="padding-top: 10px;">Наш сервис, зависит исключительно от наших клиентов! Вы делаете наш таксопарк лучше.</p>
          <span style="text-align: center;">Спасибо что выбираете нас 💞</span>
        </article>
    </a>
  </div>
  <div class="item-5">
    <a class="card">
      <div class="thumb" style="background-image: url(<?=IMG?>tarif_img/driver.jpg); border-radius: 10px;""></div>
      <article>
        <h1>Хотите устроиться к нам водителем?</h1>
        <p style="padding-top: 10px;">Нет никаких проблем, мы готовы принять каждого желающего! 😊</p>
        <button type="button"  data-bs-toggle="modal" data-bs-target="#exampleModal" name=''><span>⮕ Оставить заявку</span></button>
      </article>
    </a>
  </div>
  <div class="item-6">
    <a class="card">
      <div class="thumb" style="background-image: url(<?=IMG?>tarif_img/rating.jpg); border-radius: 10px;""></div>
      <article>
        <h1>Рейтинговая система не только для водителя</h1>
        <p style="padding-top: 10px;">Водитель тоже может поставить вам рейтинг, если он будет низким, водитель может не принять ваш заказ!</p>
        <?php
          if($user_rating){
            $sum_numbers = 0;
            $count = count($user_rating);
              foreach($user_rating as $rating){
                $sum_numbers = $sum_numbers + $rating['rating'];
              }
            $result = $sum_numbers/$count;
          }
        ?>
        <span>Ваш рейтинг: <?=number_format($result, 1, ',', ' ');?>/5 ★</span>
      </article>
    </a>
  </div>
  <div class="item-7">
    <a class="card">
      <div class="thumb" style="background-image: url(<?=IMG?>tarif_img/chat.png); border-radius: 10px;"></div>
      <article>
        <h1>Всегда на связи.</h1>
          <p style="padding-top: 10px;">Будьте всегда на связи с водителем при помощи вашего общего чата!</p>
          <button type="button"  data-bs-toggle="modal" data-bs-target="#exampleModal1" name=''><span>Быть на связи 😊</button></span>
      </article>
    </a>
  </div>
</div>

<!-- Модальное окно чата с водителем-->
<div class="modal fade" id="exampleModal2" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
      <div class="modal-content">
          <div class="modal-header">
              <h1 class="modal-title fs-5 text-center" id="exampleModalLabel">Чат с водителем</h1>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Закрыть"></button>
          </div>
          <div class="modal-body">
              <div class="col m-auto">

              <!-- Контент модального окна -->
                <div class='chat'>
	                <div class='chat-messages'>
		                <div class='chat-messages__content' id='messages'>
			                Загрузка...
		                </div>
	                </div>
	                <div class='chat-input'>
		                <form method='post' id='chat-form'>
			                <input type='text' id='message-text' class='chat-form__input' placeholder='Введите сообщение' onkeyup='checkParams()' /> 
                      <input type='submit' id='submit' disabled class='chat-form__submit' value='=>'>
		                </form>
	                </div>
                </div>
              <!-- Контент модального окна -->
              </div>
          </div>
          <div class="modal-footer">
              <button type="submit" class="btn btn-secondary" id="scrollDown" >Прокрутить вниз</button>
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Закрыть</button>
          </div>
      </div>
  </div>
</div>
<!-- Модальное окно заявки на водителя-->

<!-- Модальное окно заявки на водителя-->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
      <div class="modal-content">
          <div class="modal-header">
              <h1 class="modal-title fs-5 text-center" id="exampleModalLabel">Оставить заявку</h1>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Закрыть"></button>
          </div>
        <form method="post">
          <div class="modal-body">
              <div class="col m-auto">

              <!-- Контент модального окна -->
              <input style="display: none;" value="<?=$_SESSION['auth']['id_user']?>" type="text" name="id_user">
                <span class="label-input100" style="color:aliceblue;">Фамилия*</span>
                  <input type="text" class="form-control my-2" required readonly="" id="floatingInputValue" placeholder="Фамиилия" name='surname__user' value="<?echo $_SESSION['auth']['surname'];?>">
                <span class="label-input100" style="color:aliceblue;">Имя*</span>
                  <input type="text" class="form-control my-2" required readonly="" id="floatingInputValue" placeholder="Ваше имя" name='name__user' value="<?echo $_SESSION['auth']['name'];?>">
                  <span class="label-input100" style="color:aliceblue;">Отчество*</span>
                  <input type="text" class="form-control my-2" required readonly="" id="floatingInputValue" placeholder="Введите отчество" name='patronymic__user' value="<?echo $_SESSION['auth']['patronymic'];?>">
                <span class="label-input100" style="color:aliceblue;">Номер телефона*</span>
                  <input type="phone" class="tel form-control my-2" id="floatingInputValue" placeholder="Ваш номер телефона" name='phone__number' value="<?echo $_SESSION['auth']['phone'];?>" required>
                <span class="label-input100" style="color:aliceblue;">Ваш автомобиль*</span>
                  <input type="text" class="form-control my-2" required id="floatingInputValue" placeholder="Введите марку вашего автомобиля" name='brand__car' value="">
                <span class="label-input100" style="color:aliceblue;">Ваш стаж вождения (ВАЖНО! Принимаем заявки только от 1 года!)*</span>
                  <input type="text" class="form-control my-2" required id="floatingInputValue" placeholder="Введите стаж вождения" name='age__drive' value="">
                <span class="label-input100" style="color:aliceblue;">Водительские права код (6 пункт)*</span>
                  <input type="text" class="form-control my-2 mask-pasport-number" required id="floatingInputValue" placeholder="Введите номер ваших вод.прав" name='license__number' value="">
                <p class="card-description">Заявка будет проверятся нашими администраторами. <br> В течении 10 минут вам поступит звонок. </p>
                <!-- Контент модального окна -->
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Закрыть</button>
                <button type="submit" class="btn btn-light"  name='add__application__driver'>Отправить</button>
            </div>
        </form>
      </div>
  </div>
</div>
<!-- Модальное окно заявки на водителя-->

</div>
<div class="card_tarif__background">
  <div class="card_tarif_body">
    <div class="card__title"><h1>Доступные для заказа тарифы</h1></div>
    <main class="container__cards__tarif">
    <?foreach ($tarifs as $tarif):?>
      <div class="card__tarif">
        <img src="<?=IMG?>tarif_img/<?=$tarif['tarif_img']?>" alt="Эконом" class="img__tarif">
        <img src="<?=IMG?>tarif_img/<?=$tarif['tarif_img']?>" alt="Эконом" class="img__tarif__background">
        <div class="layer">
          <div class="info">
            <h2><?=$tarif['tarif_name']?></h2>
            <p><?=$tarif['tarif_definition']?></p>
            <h2 class='tarif__cost'><?=$tarif['tarif_cost']?>₽</h2>
            <button type="submit" class="btn btn-info button__tarif" data-bs-toggle="modal" data-bs-target="#exampleModal1" name='add_order' data-target='7' value='<?=$tarif['id_tarif']?>'>Заказать такси</button>
          </div>
        </div>
      </div>
      <?endforeach;?>

<div class="main__timeline">
      <svg display="none">
        <symbol id="arrow">
          <polyline points="7 10,12 15,17 10" fill="none" stroke="currentcolor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" />
        </symbol>
      </svg>
      <h1>История таксопарка "Драйвер"</h1>
      <div id="timeline" class="timeline">
        <div class="btn-group">
          <button class="btn" type="button" data-action="expand">Развернуть все</button>
          <button class="btn" type="button" data-action="collapse">Свернуть все</button>
        </div>
        <div class="timeline__item">
          <div class="timeline__item-header">
            <button class="timeline__arrow" type="button" id="item1" aria-labelledby="item1-name" aria-expanded="false" aria-controls="item1-ctrld" aria-haspopup="true" data-item="1">
              <svg class="timeline__arrow-icon" viewBox="0 0 24 24" width="24px" height="24px">
                <use href="#arrow" />
              </svg>
            </button>
            <span class="timeline__dot"></span>
            <span id="item1-name" class="timeline__meta">
              <time class="timeline__date" datetime="2015-18-05">18 Мая 2015</time><br>
              <strong class="timeline__title">Основание таксопарка</strong>
            </span>
          </div>
          <div class="timeline__item-body" id="item1-ctrld" role="region" aria-labelledby="item1" aria-hidden="true">
            <div class="timeline__item-body-content">
              <p class="timeline__item-p">Таксопарк «Драйвер» был основан в <time datetime="2015-18-05">2015 году 18 Мая</time> группой энтузиастов, которые хотели создать комфортную и доступную службу такси для жителей города. В первые годы работы парк не слишком был узнаваем и не приносил как таковой прибыли, в следствии чего, Сергей Южков, (один и трех основателей), стал банкротом и покинул таксопарк 😉.</p>
            </div>
          </div>
        </div>
        <div class="timeline__item">
          <div class="timeline__item-header">
            <button class="timeline__arrow" type="button" id="item2" aria-labelledby="item2-name" aria-expanded="false" aria-controls="item2-ctrld" aria-haspopup="true" data-item="2">
              <svg class="timeline__arrow-icon" viewBox="0 0 24 24" width="24px" height="24px">
                <use href="#arrow" />
              </svg>
            </button>
            <span class="timeline__dot"></span>
            <span id="item2-name" class="timeline__meta">
              <time class="timeline__date" datetime="2017-10-17">17 Октября, 2017</time><br>
              <strong class="timeline__title">Становление таксопарка</strong>
            </span>
          </div>
          <div class="timeline__item-body" id="item2-ctrld" role="region" aria-labelledby="item2" aria-hidden="true">
            <div class="timeline__item-body-content">
              <p class="timeline__item-p">Спустя 2 года, <b>Сергей Южков</b>, решил вновь попробовать себя в сфере «Таксопарка» и вернулся к свои двум коллегам, Андрей Баринов и Георгий Шишкарь которые были на грани банкротства, но Сергей вложился в таксопарк, в следствии чего, «Драйвер» начинает набирать обороты..🤨 </p>
            </div>
          </div>
        </div>
        <div class="timeline__item">
          <div class="timeline__item-header">
            <button class="timeline__arrow" type="button" id="item3" aria-labelledby="item3-name" aria-expanded="false" aria-controls="item3-ctrld" aria-haspopup="true" data-item="3">
              <svg class="timeline__arrow-icon" viewBox="0 0 24 24" width="24px" height="24px">
                <use href="#arrow" />
              </svg>
            </button>
            <span class="timeline__dot"></span>
            <span id="item3-name" class="timeline__meta">
              <time class="timeline__date" datetime="2018-09-09">9 Сентября, 2018</time><br>
              <strong class="timeline__title">Путь до вершин</strong>
            </span>
          </div>
          <div class="timeline__item-body" id="item3-ctrld" role="region" aria-labelledby="item3" aria-hidden="true">
            <div class="timeline__item-body-content">
              <p class="timeline__item-p">Спустя 3 года, как был основан таксопарк «Драйвер», начинает приносить хорошую прибыль, привлекает все больше и больше клиентов по Кузбассу. 🙂</p>
            </div>
          </div>
        </div>
        <div class="timeline__item">
          <div class="timeline__item-header">
            <button class="timeline__arrow" type="button" id="item4" aria-labelledby="item4-name" aria-expanded="false" aria-controls="item4-ctrld" aria-haspopup="true" data-item="4">
              <svg class="timeline__arrow-icon" viewBox="0 0 24 24" width="24px" height="24px">
                <use href="#arrow" />
              </svg>
            </button>
            <span class="timeline__dot"></span>
            <span id="item4-name" class="timeline__meta">
              <time class="timeline__date" datetime="2020-02-13">Февраль 13, 2020</time><br>
              <strong class="timeline__title">Новые горизонты</strong>
            </span>
          </div>
          <div class="timeline__item-body" id="item4-ctrld" role="region" aria-labelledby="item4" aria-hidden="true">
            <div class="timeline__item-body-content">
              <p class="timeline__item-p">В феврале 2020 года, Андрей Баринов, подает заявку на открытие филиалов в других странах СНГ. Заявку одобрили, но желающих приобрести филиал пока что не нашлось. 😥</p>
            </div>
          </div>
        </div>
        <div class="timeline__item">
          <div class="timeline__item-header">
            <button class="timeline__arrow" type="button" id="item5" aria-labelledby="item5-name" aria-expanded="false" aria-controls="item5-ctrld" aria-haspopup="true" data-item="5">
              <svg class="timeline__arrow-icon" viewBox="0 0 24 24" width="24px" height="24px">
                <use href="#arrow" />
              </svg>
            </button>
            <span class="timeline__dot"></span>
            <span id="item5-name" class="timeline__meta">
              <time class="timeline__date" datetime="2023-05-18">Май 18, 2023</time><br>
              <strong class="timeline__title">Еще больше популярности</strong>
            </span>
          </div>
          <div class="timeline__item-body" id="item5-ctrld" role="region" aria-labelledby="item5" aria-hidden="true">
            <div class="timeline__item-body-content">
              <p class="timeline__item-p">В Мае 2023 года, таксопарком воспользовался Андрей Бурим, (который также вложился финансово в проект), что дало не мало новых клиентов и развития для таксопарка</p>
            </div>
          </div>
        </div>
        <div class="timeline__item">
          <div class="timeline__item-header">
            <button class="timeline__arrow" type="button" id="item6" aria-labelledby="item6-name" aria-expanded="false" aria-controls="item6-ctrld" aria-haspopup="true" data-item="6">
              <svg class="timeline__arrow-icon" viewBox="0 0 24 24" width="24px" height="24px">
                <use href="#arrow" />
              </svg>
            </button>
            <span class="timeline__dot"></span>
            <span id="item6-name" class="timeline__meta">
              <time class="timeline__date" datetime="2024-04-30">Апрель 30, 2024</time><br>
              <strong class="timeline__title">Развитие в технологиях</strong>
            </span>
          </div>
          <div class="timeline__item-body" id="item6-ctrld" role="region" aria-labelledby="item6" aria-hidden="true">
            <div class="timeline__item-body-content">
              <p class="timeline__item-p">30 апреля 2024 года, была улучшена и разработана своя система, для учета заказов клиентов. <br>Это та самая система, на которой вы находитесь. 😊 <br> Спасибо что пользуетесь нашими <a type="submit" class="" data-bs-toggle="modal" data-bs-target="#exampleModal1" name='add_order' data-target='7' value='<?=9?>'>Услугами</a>, приятных и комфортных поездок вам</p>
            </div>
          </div>
        </div>
      </div>
  </div>
  </div>
</div>

<link rel="stylesheet" href='<?=CSS?>scroll.css'>
      <div class="container">
        <div class="row">
          <div class="col">
            <header class="header__scroll">
              <h1 class="h1__scroll">Почему именно мы? 👇</h1>
            </header>
            <main class="main__scroll">
              <section class="section__scroll">
                <p class="p__scroll">
                  <span>Мы - ваш надежный партнер в перемещениях! Выбирая наш таксопарк, вы выбираете комфорт, безопасность и надежность.</span>
                </p>
              </section>
            </main>
            <div class="container__social">
                    <ul class="social">
                      <li class="social__item whatsapp">
                        <a class="link__social" href="https://www.whatsapp.com/?lang=ru_RU" target="_blank"><i class="fa fa-whatsapp"></i></a>
                      </li>
                      <li class="social__item vk">
                        <a class="link__social" href="https://vk.com/outthewayeye" target="_blank"><i class="fa fa-vk"></i></a>
                      </li>
                      <li class="social__item telegram">
                        <a class="link__social" href="https://t.me/taxidriverbro" target="_blank"><i class="fa fa-telegram"></i></a>
                      </li>
                    </ul>
                  </div>
          </div>
        </div>
      </div>
