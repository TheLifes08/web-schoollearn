/*//////////////////////////////////////////////////*/
/*//                                              //*/
/*//   Основные скрипты на сайте SchoolLearn.ru   //*/
/*//             (by Rodion Kolovanov)            //*/
/*//                                              //*/
/*//////////////////////////////////////////////////*/

var menu_switch = false;

function slide_menu(){
	menu_switch = !menu_switch;
	
	if(menu_switch == true){
		$('.slide_menu_profile_ul').slideDown(110);
		$('#arr_img_profile').rotate({
		angle: 0,
		animateTo: -180
	});
	} else {
		$('.slide_menu_profile_ul').slideUp(110);
		$('#arr_img_profile').rotate({
		duration: 250,
		angle: 180,
		animateTo: 0
	});
	}
}

$(document).ready(function () {
	$('.slide_menu_profile').bind("click", slide_menu);
});

function close_topic(id){
	alert(id);
	$.ajax({
		url: 'close_topic.php',
		type: 'POST',
		cache: 'false',
		data: {'TOPIC_ID': id },
		dataType: 'html',
		success: 
			
		function(data){
			alert(data);
		}
	});
}