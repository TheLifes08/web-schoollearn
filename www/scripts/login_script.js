/*////////////////////////////////////////////////////*/
/*//                                                //*/
/*//   Скрипт авторизации на сайте SchoolLearn.ru   //*/
/*//             (by Rodion Kolovanov)              //*/
/*//                                                //*/
/*////////////////////////////////////////////////////*/

function clearInput(){
	$('#login_form input:eq(0)').css("border-color", "#A9A9A9");
	$('#login_form input:eq(1)').css("border-color", "#A9A9A9");
}

$(document).ready(function(){
	$('#input_form_login_button').click(function(){
		clearInput();
		var email = $('input.input_form_login[name=log_email]').val();
		var pass = $('input.input_form_login[name=log_pass]').val();
		var error = "";
		var error_input = 0;
		var adr_pattern = /[0-9a-z_-]+@[0-9a-z_-]+\.[a-z]{2,5}/i;
		
		if(email == "" || email == " "){
			error = "Вы не ввели свой Email!";
			error_input = 1;
		} else if(adr_pattern.test(email) == false){
			error = "Введите корректный Email!";
			error_input = 1;
		} else if(pass == "" || pass == " "){
			error = "Вы не ввели пароль!";
			error_input = 2;
		} else if(pass.length < 6){
			error = "Пароль должен состоять из 6 и более символов!";
			error_input = 2;
		}
		if(error == ""){
			error = "Обработка запроса...";
			$('#login_message').css("background-color", "#AFA826")
			$('#login_message').html(error);
			$('#login_message').show();
			$.ajax({
				url: 'login.php',
				type: 'POST',
				cache: 'false',
				data: {'email': email, 'pass': pass},
				dataType: 'html',
				success: function(data){
					if(data == "kek" || data == "kek2"){
						if(data == "kek")
							error = "Неверный Email или пароль!";
						else
							error = "Ваш аккакунт не активирован!";
						$('#login_form input:eq(0)').css("border-color", "#AF3333");
						$('#login_form input:eq(1)').css("border-color", "#AF3333");
						$('#login_message').css("background-color", "#FF5C5C");
						$('#login_message').html(error);
						$('#login_message').show();
					} else if(data == "ok") {
						window.location.href = "http://schoolearn.s06.wh1.su/";
					} else {
						error = "Неизвестная ошибка!";
						$('#login_message').css("background-color", "#FF5C5C");
						$('#login_message').html(error);
						$('#login_message').show();
					}
				}
			});
		} else {
			$('#login_message').html(error);
			$('#login_message').show();
			switch(error_input){
				case 1:  $('#login_form input:eq(0)').css("background-color", "#F3A7A7"); break;
				case 2:  $('#login_form input:eq(1)').css("background-color", "#F3A7A7"); break;
			}
		}

	});
});