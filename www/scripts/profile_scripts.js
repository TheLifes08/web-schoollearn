$('textarea').autoResize();

function showContentProfile(a){
	var block1 = $('.profile_main_block');
	var block2 = $('.profile_main_block2');
	var block3 = $('.profile_main_block3');
	var block4 = $('.profile_main_block4');
	var profile_nav_li = $('.profile_nav_li[name="li'+a+'"]');
	$('.profile_nav_li').css('border-top', '1px solid #d8d8d8');
	
	block1.hide();
	block2.hide();
	block3.hide();
	block4.hide();
	
	$('.profile_nav_li[name="li1"] button').css('background-color', '#F4F4F4');
	$('.profile_nav_li[name="li2"] button').css('background-color', '#F4F4F4');
	$('.profile_nav_li[name="li3"] button').css('background-color', '#F4F4F4');
	$('.profile_nav_li[name="li4"] button').css('background-color', '#F4F4F4');
	
	profile_nav_li.css('border-top', '3px solid #65CD65');
	$('.profile_nav_li[name="li'+a+'"] button').css('background-color', 'white');
	
	if(a == 3){
		block3.show();
	} else if(a == 1) {
		block1.show();
	} else if(a == 2) {
		block2.show();
	} else if(a == 4) {
		block4.show();
	}
}

function save_profile(){
	var name = $('.input_edit_profile[name="edit_profile_name"]').val();
	var surname = $('.input_edit_profile[name="edit_profile_surname"]').val();
	var day = $('.select_day_edit_profile').find(":selected").attr("name");
	var month = $('.select_month_edit_profile').find(":selected").attr("name");
	var year = $('.select_year_edit_profile').find(":selected").attr("name");
	var date = year.toString() + '-';;
	
	if(month < 10)
		date = date + '0' + month.toString() + '-';
	else
		date = date + month.toString() + '-';
	
	if(day < 10)
		date = date + '0' + day.toString();
	else
		date = date + day.toString();
	
	var bio = $('.edit_profile_bio').val();
	var school = $('.input_edit_profile[name="edit_profile_school"]').val();
	
	$.ajax({
		url: 'save_profile.php',
		type: 'POST',
		cache: 'false',
		data: {'NAME': name, 'SURNAME': surname, 'DATE': date, 'BIO': bio, 'SCHOOL': school},
		dataType: 'html',
		success: 
			
		function(data){
			
		}
	});
}