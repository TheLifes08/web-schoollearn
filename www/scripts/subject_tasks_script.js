var data1 = "";
var data2 = "";
var ajxIsRun = false;

$(document).ajaxStart(function(){
  ajxIsRun = true;
});

$(document).ajaxStop(function(){
  ajxIsRun = false;
});

function goToTop(){
	$('html, body').animate({
		scrollTop: $('.section_subject_header').offset().top + 'px'
    }, 'fast');
}

function sleep(millis) {
    var t = (new Date()).getTime();
    var i = 0;
    while (((new Date()).getTime() - t) < millis) {
        i++;
    }
}
	
function underline_buttns(obj){
	if(!ajxIsRun){
		$('.butt_full').css('text-decoration', 'none');
		$('.butt_full').css('color', 'black');
		$(obj).css('text-decoration', 'underline');
		$(obj).css('color', '#428bca');
	}
}
	
function setValues(){
	var block = $('.tasks_subject_main_body_content');
	var nav = $('.tasks_subject_main_body_razd');
	block.html(data1);
	nav.html(data2);
	$(".loading_task").css("display", "none");
}
	
function showContentTasks(subject, section, razd_num){
	goToTop();
	var block = $('.tasks_subject_main_body_content');
	var nav = $('.tasks_subject_main_body_razd')
	block.html("");
	nav.html("");
	$(".loading_task").css("display", "block");
	
	if(!ajxIsRun){
	
	$.ajax({
		url: 'get_content.php',
		type: 'POST',
		cache: 'false',
		data: {'SUBJECT': subject, 'SECTION': section, 'RAZDEL_NUM': razd_num, 'MODE': 1},
		dataType: 'html',
		success: 
			
		function(datak){
			data1 = datak;
		}
	});
	sleep(100);
	$.ajax({
		url: 'get_content.php',
		type: 'POST',
		cache: 'false',
		data: {'SUBJECT': subject, 'SECTION': section, 'RAZDEL_NUM': razd_num, 'MODE': 2},
		dataType: 'html',
		success: 
			
		function(datal){
			data2 = datal;
			setValues();
		}
	});	
	}
}

function change_content(subject, section, razd_num, task){
	var block = $('.tasks_subject_main_body_content');
	block.html("");
	$(".loading_task").css("display", "block");
	
	if(!ajxIsRun){
	
	if(task === undefined){
		$.ajax({
			url: 'get_content.php',
			type: 'POST',
			cache: 'false',
			data: {'SUBJECT': subject, 'SECTION': section, 'RAZDEL_NUM': razd_num, 'MODE': 1},
			dataType: 'html',
			success: 
			
			function(data){
				block.html(data);
				$(".loading_task").css("display", "none");
			}
		});
    } else {
		$.ajax({
			url: 'get_content.php',
			type: 'POST',
			cache: 'false',
			data: {'SUBJECT': subject, 'SECTION': section, 'RAZDEL_NUM': razd_num, 'MODE': 3, 'TASK': task},
			dataType: 'html',
			success: 
			
			function(data){
				block.html(data);
				$(".loading_task").css("display", "none");
			}
		});
	}
	}
}

function send_anwser(subject, section, razd_num, task, mode){
	if(mode == 1)
		var anwser = $('.anwser_input_radio:checked').val();
	else if(mode == 2)
		var anwser = $('.anwser_input_text').val();
	
	if(!ajxIsRun){
	$.ajax({
			url: 'send_anwser.php',
			type: 'POST',
			cache: 'false',
			data: {'SUBJECT': subject, 'SECTION': section, 'RAZDEL_NUM': razd_num, 'TASK': task, 'ANWSER': anwser},
			dataType: 'html',
			success: 
			
			function(data){
				$(".loading_task").css("display", "none");
				if(data == "success"){
					$(".task_button_div").css("display", "none");
					$(".task_mess_done").html("Правильный ответ.");
					$(".task_mess_done").css("color", "#65CD65");
					$(".task_mess_done").css("display", "block");
				} else if(data == "bad") {
					$(".task_mess_done").html("Неверный ответ.");
					$(".task_mess_done").css("color", "#CD4D3A");
					$(".task_mess_done").css("display", "block");
				} else if(data == "error1") {
					$(".task_mess_done").html("Вы должны авторизоваться, прежде чем выполнять задания!");
					$(".task_mess_done").css("color", "#CD4D3A");
					$(".task_mess_done").css("display", "block");
				} else if(data == "error2") {
					$(".task_mess_done").html("Вы не ввели ответ.");
					$(".task_mess_done").css("color", "#CD4D3A");
					$(".task_mess_done").css("display", "block");
				}
			}
		});
	}
}