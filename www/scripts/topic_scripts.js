var anwser_id_otvet_global = 0;

function goToTop(){
	$('html, body').animate({
		scrollTop: $('#topic_anwser_block2').offset().top + 'px'
    }, 'fast');
}

$(document).ajaxStart(function(){
    $(".loading_task").css("display", "block");
	$("#forum_body_str").css("display", "none");
});

function setAnwserId(id){
	anwser_id_otvet_global = id;
}

function showAnwserDiv(){
	$('#topic_anwser_block2').hide();
	$('#topic_anwser_block').show();
}

function $_GET(key) {
    var p = window.location.search;
    p = p.match(new RegExp(key + '=([^&=]+)'));
    return p ? p[1] : false;
}

function sendAnwser(){
	var anwser = $('#topic_anwser_block_ta').val();
	var topic = $_GET("topic_id");
	var error = "";
	
	if(anwser == "" || anwser == " ")
		error = "error1";
	else {
		$.ajax({
			url: 'sendAnwser.php',
			type: 'POST',
			cache: 'false',
			data: {'anwser': anwser, 'topic':topic},
			dataType: 'html',
			success: 
			
			function(data){
				location.reload();	
			}
		
		});
	}
}

function showAnwserDiv2(){
	$('#topic_anwser_block').hide();
	$('#topic_anwser_block2').show();
	goToTop();
	var str = '.topic_main_block_messauc[name="blocl_mess_anw' + anwser_id_otvet_global + '"]';
	var text = "<div class='topic_main_author_stc'>" + $(str + " div.topic_main_author_stc").html() + "</div><div class='topic_main_block_messc'>" + $(str + " div.topic_main_block_messc").html() + "</div>";
	$('#selected_mess').html(text);	
}

function sendAnwserOtvet(){
	var str = '.topic_main_block_messauc[name="blocl_mess_anw' + anwser_id_otvet_global + '"]';
	var anwser = "<div class='anwser_pereslat'>" + "<div class='topic_main_author_stc'>" + $(str + " div.topic_main_author_stc").html() + "</div><div class='topic_main_block_messc'>" + $(str + " div.topic_main_block_messc").html() + "</div></div>";
	var anwser2 = $('#topic_anwser_block_ta2').val();
	var anwser3 = anwser + "<div class='resend_mess_this'>" + anwser2 + "</div>";
	var topic = $_GET("topic_id");
	var error = "";
	
	if(anwser2 == "" || anwser2 == " ")
		error = "error1";
	else {
		$.ajax({
			url: 'sendAnwser.php',
			type: 'POST',
			cache: 'false',
			data: {'anwser': anwser3, 'topic':topic},
			dataType: 'html',
			success: 
			
			function(data){
				location.reload();		
			}
		
		});
	}
}

$(document).ready(function(){
	$('#topic_main_block_panel_anw_butt').bind("click", showAnwserDiv);
	$('#topic_anwser_block_butt').bind("click", sendAnwser);
	$('#topic_anwser_block_butt2').bind("click", sendAnwserOtvet);
});


function change_sorting(){
	var selection = $('.select_form_search_main').find(":selected").val();
	$('#forum_body_topics').html("");
	
	$.ajax({
		url: 'sorting.php',
		type: 'POST',
		cache: 'false',
		data: {'TYPE': selection},
		dataType: 'html',
		success: 
			
		function(data){
			$('#forum_body_topics').html(data);
			$(".loading_task").css("display", "none");
			$("#forum_body_str").css("display", "block");
		}
		
	});
}

function search(){
	/*var search_text = $('.input_forum_search').val();
	var selection = $('.select_form_search_main').find(":selected").val();
	*/
	
	alert("Функция поиска находится в разработке.");
	$('.input_forum_search').val("");
	
	/*$.ajax({
		url: 'sorting.php',
		type: 'POST',
		cache: 'false',
		data: {'TYPE': selection, 'SEARCH': search_text},
		dataType: 'html',
		success: 
			
		function(data){
			$('#forum_body_topics').html(data); 	
		}
		
	});*/
}