function supports_html5_storage() {
  try {
    return 'localStorage' in window && window['localStorage'] !== null;
} catch (e) {
    return false;
  }
}

$(function () { 
    if(supports_html5_storage()) {
		
		// восстановление из черновика
		var msg_draft = localStorage.getItem("msg_draft");
		if(typeof msg_draft !== 'undefined' && msg_draft !== null &&  msg_draft !== 'null' && msg_draft !== "" && $("#msg").val() === '') {
			$("#draft-info").show();
			$("#msg").val(msg_draft);
			
			// скрываем сообщение о востановлении по прошествии 15 секунд
			setTimeout(function() {
				$("#draft-info").hide("slow");
			}, 15000);
		} // end if
		
		// чистим локальное хранилище и форму по нажатию на ссылку
		$("a[data-clear-form]").on('click',
			 function(){
			   localStorage.setItem("msg_draft", null);
			   $("#msg").val("");
				$("#draft-info").hide("slow");
			   
			   return false;
		});
		
		// чистим при отправке формы
		$("#post-delimiter-form").on('submit',
			 function(){
			   localStorage.setItem("msg_draft", null);
			   
			   return true;
		});
		
		// сохраняем в случее автозаполнения
		if($("#msg").val() !== '') {
			localStorage.setItem("msg_draft", $("#msg").val());
		} // end if

		// пересохранение черновика при изменении формы
		$("#msg").on('keyup',
			 function(){
			   localStorage.setItem("msg_draft", $("#msg").val());
		});
	
	} // end if
});