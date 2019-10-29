
// Сбор данных формы по сабмиту

	function beforeSend(form_id, script_file, loader_type, obj) // [loader_type + obj] - необязательные но только в связке: тип прелодера + объект, который его вызвал 
	{
        switch(loader_type)
        {
        // Вариант 1: "колесико" после obj, оверлея нет    
            case 1:
            {
                $("<img src=\"/img/preloaders/loader5.gif\" id=\"ImgLoader\" style=\"vertical-align: middle; margin-left: 5px;\"/>").insertAfter($(obj));  
                break;
            }
        // Вариант по умолчанию (без пришедших параметров): оверлей + "колесико" по центру
            default:
            {
                CreateOverlay();
                WaitingFor();
                break;
            }
        }

		var SubmitId = $("#" + form_id).find("button[type='submit']").attr("id");
        var SubmitName = $("#" + form_id).find("button[type='submit']").attr("name");
        var rExp = new RegExp("(.+?)/(([0-9_]+)?[a-z0-9_]+([0-9_]+)?)/(([0-9]+/){1,})?(\\w{1,}\.html)?((\\d{1,})\.html)?$", "gi");
        var found = rExp.exec(window.location.href);
        
        var alias = null;

        if(found)
        alias = found[2];

        var param = $('#' + form_id).serialize() + "&alias=" + alias + "&current_project_id=" + JsGlobalCurrentProjectId + "&current_language=" + JsGlobalCurrentLanguage + "&script_file=" + script_file + "&" + SubmitId + "=" + SubmitId;        

        ajaxCall(param);
	}

// Сам ajax запрос
	function ajaxCall(param)
	{
    //4 параметра для правильного запроса: &alias=&current_project_id=" + JsGlobalCurrentProjectId + "&current_language=" + JsGlobalCurrentLanguage + "&script_file= 
        
        setTimeout(function() 
        { 
            ScriptPath = "/ajax.php";
       		$.ajax(
    		{
    			url: ScriptPath,
    			cache: false,
    			type: "post",
                async: false,
    			data: param,
    			success: function(data, textStatus)
    			{
                    var result = $.parseJSON( data );

                    if(result[0])
                    {
                        WaitingFor(0);
                        eval(result[0]);
                        
                    }
    			}
    		});
        }, 
        400);
	}

// Убираем модальное окно и оверлей
	function remWaitAndOverlay()
	{
    	WaitingFor(0);
	    CreateOverlay(0);
	}

// Создаем алерт
	function doAlert(caption, txt, callback)
    {
        $("<div>")
        .attr("id", "alertBlock")
        .css("display", "none")
        .append("<div id=\"alertWindow\" class=\"modal_win_panel_auto\"><span class=\"modal_win_caption\">" + caption + "</span><div class=\"modal_win_field_oform\"><div style=\"min-height: 60px; color: black;\"><p>" + txt + "</p><button class=\"modal_win_button\" name=\"AlertOk\" style=\"width: 50px; margin-top: 10px;\">OK</button></div></div></div>")
        .appendTo("body");
        
        $("#alertBlock button[name='AlertOk']").on("click", function()
        {
            $("#alertBlock").fadeTo( 250, 0, function()
            {
                $(this).remove();
                if(callback)               
                callback();
            });
            
            return false;
        });  
        
        $("#alertBlock").fcModal();
        
        return false;      
    }
// Создаем конфирм
	function doConfirm(caption, txt, yes, no, callback)
    {
        $("<div>")
        .attr("id", "confirmBlock")
        .css("display", "none")
        .append("<div id=\"confWindow\" class=\"modal_win_panel_auto\"><span class=\"modal_win_caption\">" + caption + "</span><div class=\"modal_win_field_oform\"><div style=\"min-height: 60px; color: black;\"><p>" + txt + "</p><button class=\"modal_win_button\" name=\"ConfirmOk\" style=\"width: 50px; margin-top: 10px;\">" + yes + "</button> <button name=\"ConfirmCancel\" class=\"modal_win_button\" style=\"width: 50px; margin-top: 10px;\">" + no + "</button></div></div></div>")
        .appendTo("body");

        $("#confirmBlock button[name='ConfirmOk']").on("click", function()
        {
            WaitingFor();
            $("#confirmBlock").remove();
            callback();
        });

        $("#confirmBlock button[name='ConfirmCancel']").on("click", function()
        {
            $("#confirmBlock").remove();
            remWaitAndOverlay(); 
        });

        $("#confirmBlock").fcModal();

        return false;
    }    

// Создаем оверлей
	function CreateOverlay(status)
	{
        if(status != 0)
		{
			if($("#CmsTotalOverlay").length == 0)
            {
                var docHeight = $(document).height() - 1;
    			
                $("body").append("<div id=\"CmsTotalOverlay\"></div>");
    
    			$("#CmsTotalOverlay")
    				.height(docHeight)
    				.css(
    			{
    				'display' : "none",
    		        'position': 'fixed',
    		        'top': 0,
    		        'left': 0,
    				'background-color': 'black',
    				'overflow': 'hidden',
    		        'width': '100%',
    		        'z-index': '9'
    			}).fadeTo( 250, 0.9 );
            }
		}
		else
		{
			$("div#CmsTotalOverlay").fadeTo( 250, 0, function()
            {
                $(this).remove();
            });
		}
	}

    var JSGlobalTimeout;

// Окошко ожидания
	function WaitingFor(status, id)
	{
        var time = 30000;
        
        switch(status)
        {
            case 0:
            {
                clearTimeout(JSGlobalTimeout);
    	        $("div#WaitingTrackBar").remove();
                if($("#ImgLoader").length == 1)
                $("#ImgLoader").remove();                  
                break;
            }
        // Прелоадер ПОСЛЕ
            case 1:
            {
                break;
            }
        
        // Прелоадер ВНУТРЬ
            case 2:
            {
                //$("#" + id).html("..")
                break;
            }
            
            default:
            {
                $("body")
                .append("<div id=\"WaitingTrackBar\"><span class=\"preloader4\"></span></div>");
                
    			$("div#WaitingTrackBar")
                .hide()
    			.css("width", "30px")
                .css("height", "30px")
    	        .css("background-color", "transparent")
    			.css("position", "fixed")
    			.css("border", "none")
    			.css("padding", "10px")
    			.css("text-align", "center")
        		.css("top", parseInt($(window).height() / 2 - $("div#WaitingTrackBar").height() / 2) + "px")
    		    .css("left", (($(window).width() - $("div#WaitingTrackBar").outerWidth()) / 2) + "px")
        	    .css("z-index", "15")
                .fadeIn();
    
               	JSGlobalTimeout = setTimeout(waitingForChecker, time);                
                break;
            }
        }

		function waitingForChecker()
		{
			if($("div#WaitingTrackBar").length)
			{
				doAlert("Уведомление", "Сервер не ответил. Возможно это связано с низкой скоростью Вашего Интернета или с повышенной нагрузкой на сервер. Пожалуйста, повторите попытку", function()
                {
    				clearTimeout(JSGlobalTimeout);
	   			    remWaitAndOverlay();
                });
			}
		}	
    }
