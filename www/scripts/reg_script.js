/*////////////////////////////////////////////////////*/
/*//                                                //*/
/*//   Скрипт регистрации на сайте SchoolLearn.ru   //*/
/*//             (by Rodion Kolovanov)              //*/
/*//                                                //*/
/*////////////////////////////////////////////////////*/

function clearInput(){
	$('#reg_form input:eq(0)').css("background-color", "#F3F3F3");
	$('#reg_form input:eq(1)').css("background-color", "#F3F3F3");
	$('#reg_form input:eq(2)').css("background-color", "#F3F3F3");
	$('#reg_form input:eq(3)').css("background-color", "#F3F3F3");
	$('#reg_form input:eq(4)').css("background-color", "#F3F3F3");
}

$(document).ready(function(){
	$('#input_form_reg_button').click(function(){
		clearInput();
		
		//Получение значений полей
		var name = $('input.input_form_reg[name=reg_name]').val();
		var surname = $('input.input_form_reg[name=reg_surname]').val();
		var email = $('input.input_form_reg[name=reg_email]').val();
		var pass = $('input.input_form_reg[name=reg_pass]').val();
		var repass = $('input.input_form_reg[name=reg_repass]').val();
		var error = "";
		var error_input = 0;
		var adr_pattern = /[0-9a-z_-]+@[0-9a-z_-]+\.[a-z]{2,5}/i;
		
		//Проверка на корректность введенных данных
		if(name == "" || name == " "){
			error = "Вы не ввели своё имя!";
			error_input = 1;
		} else if(name.length == 1){
			error = "Длина имени должна быть больше одного символа!";
			error_input = 1;
		} else if(surname == "" || surname == " "){
			error = "Вы не ввели свою фамилию!";
			error_input = 2;
		} else if(surname.length == 1){
			error = "Длина фамилии должна быть больше одного символа!";
			error_input = 2;
		} else if(email == "" || email == " "){
			error = "Вы не ввели свой Email!";
			error_input = 3;
		} else if(adr_pattern.test(email) == false){
			error = "Введите корректный Email!";
			error_input = 3;
		} else if(pass == "" || pass == " "){
			error = "Вы не ввели пароль!";
			error_input = 4;
		} else if(repass == "" || repass == " "){
			error = "Вы не ввели пароль!";
			error_input = 5;
		} else if(pass.length < 6 || repass.length < 6){
			error = "Пароль должен состоять из 6 и более символов!";
			error_input = 6;
		} else if(pass != repass){
			error = "Введенные пароли не совпадают!";
			error_input = 6;
		}
		
		//Если данные корректны, то зарегистрировать пользователя
		if(error == ""){
			error = "Регистрация пользователя...";
			$('#reg_message').css("background-color", "#AFA826")
			$('#reg_message').html(error);
			$('#reg_message').show();
			
			//Использование технологии AJAX
			$.ajax({
				url: 'reg.php',
				type: 'POST',
				cache: 'false',
				data: {'name': name, 'surname': surname, 'email': email, 'pass': pass},
				dataType: 'html',
				success: function(data){
					if(data == "error1"){
						error = "Не удается подключиться к базе данных сайта. Пожалуйста, попробуйте позже.";
						$('#reg_message').html(error);
						$('#reg_message').css("background-color", "#FF5C5C");
						$('#reg_message').show();
					} else if(data == "error2"){
						error = "Такой Email уже зарегистрирован!";
						$('#reg_form input:eq(2)').css("border-color", "#AF3333");
						$('#reg_message').css("background-color", "#FF5C5C")
						$('#reg_message').html(error);
						$('#reg_message').show();
					} else if(data == "ok") {
						error = "На ваш Email было отправлено письмо для активации аккаунта. Чтобы активировать аккаунт, перейдите по ссылке в письме.";
						$('#reg_message').html(error);
						$('#reg_message').css("background-color", "#42AF2D");
						$('#reg_message').show();
					} else {
						error = "Незвестная ошибка!";
						$('#reg_message').html(error);
						$('#reg_message').css("background-color", "#FF5C5C");
						$('#reg_message').show();
					}
				}
			});
		} else {
			$('#reg_message').html(error);
			$('#reg_message').show();
			switch(error_input){
				case 1:  $('#reg_form input:eq(0)').css("background-color", "#F3A7A7"); break;
				case 2:  $('#reg_form input:eq(1)').css("background-color", "#F3A7A7"); break;
				case 3:  $('#reg_form input:eq(2)').css("background-color", "#F3A7A7"); break;
				case 4:  $('#reg_form input:eq(3)').css("background-color", "#F3A7A7"); break;
				case 5:  $('#reg_form input:eq(4)').css("background-color", "#F3A7A7"); break;
				case 6:  $('#reg_form input:eq(3)').css("background-color", "#F3A7A7"); $('#reg_form input:eq(4)').css("background-color", "#F3A7A7"); break;
			}
		}
	});
});
