$(document).ready(function(){
    $('.tel').mask('+7 (999) 999-99-99');
    $('.mask-pasport-number').mask('99-99 999999');
// Скрипт для ввода адреса

const typedataSuggestionsJS = new typedataSuggestions({
    token: '2fac6166-65e4-4c83-994f-57732b398268',
        events: {
        input: {
            selection: (event) => {
                const selection = event.detail.selection.value;
                typedataSuggestionsJS.input.value = selection.value;
                
                if($('.city__out').val() && $('.street__out').val() && $('.house__out').val()){
                    $('.city__come').val(selection['data']['city']);
                        if(selection['data']['settlement_with_type']){
                    $('.city__come').val($('.city__come').val() + ', ' + selection['data']['settlement_with_type']);
                        }
                    $('.street__come').val(selection['data']['street_with_type']);
                    $('.house__come').val(selection['data']['house_with_type']); 
                }else{
                    $('.city__out').val(selection['data']['city']);
                        if(selection['data']['settlement_with_type']){
                    $('.city__out').val($('.city__out').val() + ', ' + selection['data']['settlement_with_type']);
                }
                $('.street__out').val(selection['data']['street_with_type']);
                $('.house__out').val(selection['data']['house_with_type']);
                }   
            }
        }
    }
});



// \\Скрипт для ввода адреса

    $('.chat__button').on('click', function(){
        $('.send__message__chat').val($(this).val());
        var3 = $(this).val();
    })

    $('#scrollDown').on('click', function(){

        console.log($(".chat-messages").scrollTop());
        console.log($(".chat-messages__content").height()-$(".chat-messages").height());
        $(".chat-messages").scrollTop($(".chat-messages__content").height()-$(".chat-messages").height())
    });

    $('#teh-podder').on('click', function(){
        var number_phone = 123;
        $.ajax({
            url: 'http://avtorization/functions/ajax.php',
            type: 'POST',
            data: { enter: number_phone},
            success: function(data) {
                //alert(data)
            }
         })
    })

// СКРИПТЫ ДЛЯ ЧАТА
//document.getElementById('messages').innerHTML = 'Работает';
var messages__container = document.getElementById('messages');
//Контейнер сообщений — скрипт будет добавлять в него сообщения

var interval = null; //Переменная с интервалом подгрузки сообщений

var sendForm = document.getElementById('chat-form'); //Форма отправки
var messageInput = document.getElementById('message-text'); //Инпут для текста сообщения

function send_request(act, login = null, password = null) {//Основная функция
	//Переменные, которые будут отправляться
	var var1 = null;
	var var2 = null;

	if(act == 'auth') {
		//Если нужно авторизоваться, получаем логин и пароль, которые были переданы в функцию
		var1 = login;
		var2 = password;
	} else if(act == 'send') {
//Если нужно отправить сообщение, то получаем текст из поля ввода
		var1 = messageInput.value;
       // var3 = messageInput.value;
	}
	$.post('../../functions/ajax.php',{ //Отправляем переменные
		act: act,
		var1: var1,
		var2: var2,
        var3: var3
	}).done(function (data) {
		//Заносим в контейнер ответ от сервера
		messages__container.innerHTML = data;
		if(act == 'send') {
			//Если нужно было отправить сообщение, очищаем поле ввода
			messageInput.value = '';
		}
	});
}

function checkParams() {
    var message = $('#message-text').val();

    if(message.length != 0) {
        $('#submit').removeAttr('disabled');
    } else {
        $('#submit').attr('disabled', 'disabled');
    }
}

function update() {
    checkParams()
	send_request('load');

    //$('.chat-messages__content')attr(target)
}
interval = setInterval(update,500);

function handleButtonClick() {
    var nextMessage = $(".chat-messages__content");
    var containerTop = nextMessage.scrollTop();
    var containerBottom = containerTop + nextMessage.height();
    return containerBottom;
}

sendForm.onsubmit = function () {
	send_request('send');
    send_request('load');
    $(".chat").scrollTop($(".chat").height()-$(".chat-messages").height())
	return false; //Возвращаем ложь, чтобы остановить классическую отправку формы
};

// СКРИПТЫ ДЛЯ ЧАТА

    $('#select-role').on('change', function(){
        if($('#select-role').val() == 2)
        {
            $('.add_info_drivers').show();
            $('.drivers-parametrs').attr('required', true)
        }else{
          $('.add_info_drivers').hide();
          $('.drivers-parametrs').attr('required', false)
        }
    });


	$('.tel').mask('+7 (999) 999-99-99');
    $('body').on('input', '.tel', function(){
        this.value = this.value.replace(/[^0-9]/g, '');
    });

    $('body').on('input', '.input-ru', function(){
        this.value = this.value.replace(/[^а-яё\s]/gi, '');
    });
    $('body').on('input', '.input-en', function(){
        this.value = this.value.replace(/[^a-z\s]/gi, '');
    });
})

$('.del_user').click(function(){
    var res = confirm('Вы действительно хотите удалить запись?');

    if(!res){
        return false;
    }
})


$('.del_tarif').click(function(){
    var res = confirm('Вы действительно хотите удалить запись?');

    if(!res){
        return false;
    }
})

$('#__confirm').click(function(){
    var res = confirm('Вы действительно хотите отменить заявку? Перед отменой заявки, обязательно свяжитесь с клиентом и объясните причину отказа!!!');

    if(!res){
        return false;
    }
})

$('#confirm__').click(function(){
    var res = confirm('Вы действительно хотите отменить заказ?');

    if(!res){
        return false;
    }
})

$('body').on('click', '.password-checkbox', function(){
	if ($(this).is(':checked')){
		$('#password-input').attr('type', 'text');
	} else {
		$('#password-input').attr('type', 'password');
	}
}); 

$(document).on("click", function(){
    $('.alert').fadeOut("slow");
});

setTimeout(function() { $('.alert').fadeOut("slow"); }, 2000);

$(function () {

    // Нажатие на кнопку сгенерировать
    $('.generator').click(function () {
        // Отправка запроса на сервер без перезагрузки страницы
        $.ajax({
            // Обработчик PHP\
            url: '',
            // метод передачи данных
            method: 'POST',
            // данные которые передаются
            data: { generator_pass: 'pass' },
            // в каком виде хотим получить данные
            dataType: 'json',
            // что делать в случае успеха
            success: function (gen_pass) {
                console.log(gen_pass)
                $('.password').val(gen_pass)
            }
        })
    })

})

ymaps.ready(init);

var myMap,
    myPlacemark;

function init(){
    myMap = new ymaps.Map ("map", {
        center: [54.42, 86.30], 
        zoom: 13
    });

    myPlacemark = new ymaps.myPlacemark([54.42, 86.30], { 
        hintContent: 'Москва', 
        balloonContent: 'Столица России' 
    });

    myMap.geoObjects.add(myPlacemark);
}


$('#js-file').change(function(){
    alert($(this).val());
    $('.gallery').attr('srt', '')
    if (window.FormData === undefined) {
        alert('Загрузка файлов в вашем браузере не поддерживается');
    } else {
        var formData = new FormData();
        $.each($("#js-file")[0].files, function(key, input){
            formData.append('file[]', input);
        });

        $.ajax({
            type: 'POST',
            url: '../../functions/model.php',
            cache: false,
            contentType: false,
            processData: false,
            data: formData,
            dataType: 'json',
            success: function(msg){
                msg.forEach(function(row) {
                    if (row.error == ''){
                        $('#js-file-list').append(row.data);
                    } else {
                        alert(row.error);
                    }
                });
            }
        });
    }
});

function remove_img(target){
    $(target).parent().remove();
}