$(document).ready(function(){
	/* Следующий код выполняется только после загрузки DOM */
	
	/* Данный флаг предотвращает отправку нескольких комментариев: */
	var working = false;
	
	/* Ловим событие отправки формы: */
	$('#addCommentForm').submit(function(e){
            console.log(e);
 		e.preventDefault();
		if(working) return false;
		
		working = true;
		//$('#submit').val('Занято...');
		$('span.error').remove();
		
		/* Отправляем поля формы в submit.php: */
		$.post('/ajax/submit',$(this).serialize(),function(msg){

			working = false;
			$('#submit').val('Отправить');
			
			if(msg.status){

				/* 
				/	Если вставка была успешной, добавляем комментарий 
				/	ниже последнего на странице с эффектом slideDown
				/*/

				$(msg.html).hide().insertBefore('#addComment').slideDown();
				$('#body').val('');
			}
			else {

				/*
				/	Если есть ошибки, проходим циклом по объекту
				/	msg.errors и выводим их на страницу
				/*/
				
				$.each(msg.errors,function(k,v){
					$('label[for='+k+']').append('<span class="error">'+v+'</span>');
				});
			}
		},'json');

	});
        
        
	
});

           
var working = false;
$(document).on('submit','.replayForm',function(e){
            console.log(e);
 		e.preventDefault();
		if(working) return false;
		
		working = true;
		//$('#submit').val('Занято...');
		$('span.error').remove();
		
		/* Отправляем поля формы в submit.php: */
		$.post('/ajax/submit',$(this).serialize(),function(msg){

			working = false;
			$('#submit').val('Отправить');
			
			if(msg.status){

				/* 
				/	Если вставка была успешной, добавляем комментарий 
				/	ниже последнего на странице с эффектом slideDown
				/*/

				$(msg.html).hide().insertBefore('.replayForm').slideDown();
                                $("#replayForm").remove();
				$('#body').val('');
			}
			else {

				/*
				/	Если есть ошибки, проходим циклом по объекту
				/	msg.errors и выводим их на страницу
				/*/
				
				$.each(msg.errors,function(k,v){
					$('label[for='+k+']').append('<span class="error">'+v+'</span>');
				});
			}
		},'json');

	});

























