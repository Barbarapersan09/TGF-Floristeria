function valid_datas( f ){
	
	if( f.name.value == '' ){
		jQuery('#form_status').html('<span class="wrong">El nombre no puede estar vacío.</span>');
		notice( f.name );
	}else if( f.email.value == '' ){
		jQuery('#form_status').html('<span class="wrong">El email no puede estar vacío o con un formato incorrecto.</span>');
		notice( f.email );
	//}else if( f.phone.value == '' ){
		//jQuery('#form_status').html('<span class="wrong">Your phone must not be empty and correct format!</span>');
		//notice( f.phone );
	}else if( f.subject.value == '' ){
		jQuery('#form_status').html('<span class="wrong">El asunto no puede estar vacío.</span>');
		notice( f.subject );
	}else if( f.message.value == '' ){
		jQuery('#form_status').html('<span class="wrong">El mensaje no puede estar vacío.</span>');
		notice( f.message );
	}else{
		 jQuery.ajax({
			url: '../../controller/contactoController.php',
			type: 'post',
			data: jQuery('form#fruitkha-contact').serialize(),
			success: function(data) {
                console.log("entra aqui")
                location.href = "http://floristeria.kesug.com/";
				jQuery('#form_status').html(data.responseText);
				jQuery('#fruitkha-contact').find('input,textarea').attr({value:''});
				jQuery('#fruitkha-contact').css({opacity:1});
				jQuery('#fruitkha-contact').remove();
			}
		});
		jQuery('#form_status').html('<span class="loading">Enviando tu mensaje...</span>');
		jQuery('#fruitkha-contact').animate({opacity:0.3});
		jQuery('#fruitkha-contact').find('input,textarea,button').css('border','none').attr({'disabled':''});
	}
	
	return false;
}

function notice( f ){
	jQuery('#fruitkha-contact').find('input,textarea').css('border','none');
	f.style.border = '1px solid red';
	f.focus();
}function valid_datas( f ){
	
	if( f.name.value == '' ){
		jQuery('#form_status').html('<span class="wrong">El nombre no puede estar vacío.</span>');
		notice( f.name );
	}else if( f.email.value == '' ){
		jQuery('#form_status').html('<span class="wrong">El email no puede estar vacío o con un formato incorrecto.</span>');
		notice( f.email );
	//}else if( f.phone.value == '' ){
		//jQuery('#form_status').html('<span class="wrong">Your phone must not be empty and correct format!</span>');
		//notice( f.phone );
	}else if( f.subject.value == '' ){
		jQuery('#form_status').html('<span class="wrong">El asunto no puede estar vacío.</span>');
		notice( f.subject );
	}else if( f.message.value == '' ){
		jQuery('#form_status').html('<span class="wrong">El mensaje no puede estar vacío.</span>');
		notice( f.message );
	}else{
		 jQuery.ajax({
			url: '../../controller/contactoController.php',
			type: 'post',
			data: jQuery('form#fruitkha-contact').serialize(),
			complete: function(data) {
				jQuery('#form_status').html(data.responseText);
				jQuery('#fruitkha-contact').find('input,textarea').attr({value:''});
				jQuery('#fruitkha-contact').css({opacity:1});
				jQuery('#fruitkha-contact').remove();
			}
		});
		jQuery('#form_status').html('<span class="loading">Enviando tu mensaje...</span>');
		jQuery('#fruitkha-contact').animate({opacity:0.3});
		jQuery('#fruitkha-contact').find('input,textarea,button').css('border','none').attr({'disabled':''});
	}
	
	return false;
}

function notice( f ){
	jQuery('#fruitkha-contact').find('input,textarea').css('border','none');
	f.style.border = '1px solid red';
	f.focus();
}