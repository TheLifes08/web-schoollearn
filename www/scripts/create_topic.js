/*//////////////////////////////////////////////////////*/
/*//                                                  //*/
/*//   Скрипт создание темы на сайте SchoolLearn.ru   //*/
/*//             (by Rodion Kolovanov)                //*/
/*//                                                  //*/
/*//////////////////////////////////////////////////////*/

function clearInput2(){
	$('#topic_name_input').css("background-color", "#F3F3F3");
	$('#topic_desc_input').css("background-color", "#F3F3F3");
}

$(document).ready(function(){
	$('#topic_butt_input').click(function(){
		clearInput2();
		var topic_name = $('#topic_name_input').val();
		var topic_desc = $('#topic_desc_input').val();
		var error = "";
		var error_input = 0;
		
		if(topic_name == "" || topic_name == " "){
			error = "Вы не ввели название темы!";
			error_input = 1;
		} else if(topic_name.length <= 3){
			error = "Название темы должно быть больше 3 символов!";
			error_input = 1;
		} else if(topic_desc == "" || topic_desc == " "){
			error = "Вы не ввели текст сообщения!";
			error_input = 2;
		}
		
		if(error == ""){
			error = "Создание темы...";
			$('#create_topic_message').css("background-color", "#AFA826")
			$('#create_topic_message').html(error);
			$('#create_topic_message').show();
			$.ajax({
				url: 'create.php',
				type: 'POST',
				cache: 'false',
				data: {'topic_name': topic_name, 'topic_desc': topic_desc},
				dataType: 'html',
				success: function(data){
					if(data == ""){
						error = "Тема успешно создана!";
						$('#create_topic_message').css("background-color", "#42AF2D")
						$('#create_topic_message').html(error);
						$('#create_topic_message').show();
					} else if(data == "error1"){
						error = "Для создание темы нужно авторизоваться! Нажмите для авторизации: <a href='../../../php/login/' style='color: white;'>Войти</a>";
						$('#create_topic_message').html(error);
						$('#create_topic_message').css("background-color", "#FF5C5C");
						$('#create_topic_message').show();
					} else if(data == "error2"){
						error = "Тема с таким именем уже существует!";
						$('#create_topic_message').html(error);
						$('#create_topic_message').css("background-color", "#FF5C5C");
						$('#create_topic_message').show();
					} else {
						error = "Незвестная ошибка!";
						$('#create_topic_message').html(error);
						$('#create_topic_message').css("background-color", "#FF5C5C");
						$('#create_topic_message').show();
					}
				}
			});
		} else {
			$('#create_topic_message').css("background-color", "#FF5C5C");
			$('#create_topic_message').html(error);
			$('#create_topic_message').show();
			switch(error_input){
				case 1: $('#topic_name_input').css("background-color", "#F3A7A7"); break;
				case 2: $('#topic_desc_input').css("background-color", "#F3A7A7"); break;
			}
		}
	});
});
