// Создаем слайдер из всех картинок внутри id
    function makeSlider(id, speed, title, scroll_dir, delay, cells)
    {
        // id, speed = 500, title = false, scroll_dir = "right", delay = 5000, cells = 3
        var imgs = $("#" + id).find("img[src!='/img/mag_glass.png']");
        $("#" + id).find("img:first").replaceWith("<div id=\"" + id + "eventCarousel\"></div>");
        $("#" + id).find("img").unwrap();
        $("#" + id).find("img").remove();
        $("#" + id + "eventCarousel").append("<div class=\"jcarousel-scroll\"><a href=\"javascript:void(0);\" class=\"mycarousel-prev fccarousel_prev\"></a><a href=\"javascript:void(0);\" class=\"mycarousel-next fccarousel_next\"></a><ul></ul></div>")
                
        $(imgs).each(function()
        {
            img = this.outerHTML;
            $("#" + id + "eventCarousel").find("ul").append("<li>" + img + "</li>");                    
        })
                
        $("#" + id + "eventCarousel").fcCarousel(
        {
            speed: speed,
            title: title,
            auto_scroll:
            {
                dir: dir,
                delay: delay
            },
            //buttons: false,
            cells: cells
        });        
    }

// Авторизация через социалку
    function socialAuth(user)
    {     
        var param = "do_soc_auth=&network=" + user.network + "&uid=" + user.id + "&current_project_id=" + JsGlobalCurrentProjectId + "&current_language=" + JsGlobalCurrentLanguage + "&uin=" + JsGlobalCurrentUserSession + "&script_file=modules_www/checkme.inc";
        ajaxCall(param);  
    }

// Попытка привязать / отвязать социалку к аккаунту
    function trySocialAuth(user)
    {
        var param = "create_soc_auth=&network=" + user.network + "&uid=" + user.id + "&current_project_id=" + JsGlobalCurrentProjectId + "&current_language=" + JsGlobalCurrentLanguage + "&uin=" + JsGlobalCurrentUserSession + "&script_file=modules_www/register.inc";
        ajaxCall(param);   
    }

// Архив опросов. Вывод данных
    function ShowVoteDetails(obj, id, label)
    {
        if($([id^='ArchivePoll']).length > 0)
        {
            $("[id^='ArchivePoll']").remove();        
        }
        $(obj).after("<div id=\"ArchivePoll" + id + "\" style=\"margin: 5px 0 5px 0\">" + label + "</div>");
        var param = "get_poll=" + id + "&current_project_id=" + JsGlobalCurrentProjectId + "&current_language=" + JsGlobalCurrentLanguage + "&uin=" + JsGlobalCurrentUserSession + "&script_file=modules_www/vote.inc";
        ajaxCall(param);            
    }   

// ПРОСТЕЙШИЙ показ полноразмерного фото
	function SimpleImgFullsize(img)
	{
        $("#FullSizeImgWindow").remove();
        var src = $(img).attr("src");
        
        rExp = /max_height=(\d{1,})/gi;
		src = src.replace(rExp, "full_size&amp;screen_width=" + $(window).width() + "&amp;screen_height=" + $(window).height());        

        WaitingFor();

		$("body").append("<div id=\"FullSizeImgWindow\"></div>");
        
		$("#FullSizeImgWindow")
        .css("display", "none")
        .css("background-color", "#ffffff")
        .css("border", "#999999 1px solid")
        .css("margin", "0 auto")
		.css("position", "fixed")
        .css("width",  + "px")
        .css("z-index", "11")
        .append("<div style=\"position: absolute; right: -30px; top: 0;\"><a href=\"javascript:void(0);\" onclick=\"$('#FullSizeImgWindow').remove(); CreateOverlay(0);\"><img src=\"/img/close.png\" alt=\"\" border=\"0\" /></a></div>");
    	
        CreateOverlay();
        
        $("#FullSizeImgWindow")
        .append("<img onload=\"createFullImgField($(this))\" src=\"" + src + "\" style=\"display: block;\" border=\"0\" />");
    }

// Создание самого поля под простейшую полноразмерку    
    function createFullImgField(obj)
    {
        WaitingFor(0); 
        var clone = obj.clone();
        clone.css("visibility", "hidden");
        $("body").append(clone);
        var width = clone.outerWidth();
        var height = clone.outerHeight();
        clone.remove();

        $("#FullSizeImgWindow")
        .css("width", width + "px")
        .css("height", height + "px")
        .css("top", ($(window).height() / 2  - height / 2) + "px")
        .css("left", ($(window).width() / 2  - width / 2) + "px")
        .delay(100)
        .fadeIn(300);

        ResizeOverlay();
    }

// Показ полноразмерного фото (для кропированных)
	function ImgFullsize(img)
	{
        
var data = /(.*)_(\d{1,})_(\d{1,})_(\d{1,})_(\d{1,}x\d{1,})_(\d{1,}x\d{1,})_\.(.+?)(\?.+?)?$/gi.exec($(img).attr("src"));
        
        var filename = data[1] + "_" + data[2] + "." + data[7];
        filename = /^(.*)files\/image\/cache\/(.+?)$/gi.exec(filename);
        var domain = filename[1];
        filename = filename[2];
        
        var rand = data[2];
        var x1 = data[3];
        var y1 = data[4];
        mini_size = /(\d{1,})x(\d{1,})/gi.exec(data[5]);
        var mini_w = mini_size[1];
        var mini_h = mini_size[2];
        full_size = /(\d{1,})x(\d{1,})/gi.exec(data[6]);
        var full_w = full_size[1];
        var full_h = full_size[2];
        
        var path = domain + "projects/crop.php?filename=" + filename + "&mini_w=" + mini_w + "&mini_h=" + mini_h + "&x1=" + x1 + "&y1=" + y1 + "&sel_w=" + full_w + "&sel_h=" + full_h + "&rand=" + rand;        

        $("#FullSizeImgWindow").remove();
        var src = path;
        var subs = $(img).attr("title") != undefined ? $(img).attr("title") : false;
        var id = $(img).attr("id");
        var arrayNum = -1;

        var Forward, Back;

    // Ищем соседей по ротации, формируем массив ротируемых картинок
        for(var i = 0; i < pic_array_hash.length; i++)
        {
            var key = $.inArray(id, pic_array_hash[i]);
            
            if(key != -1)
            {
            // найдено: теперь знаем индекс массива в списке массивов                
                arrayNum = i;
                break;    
            }
        }
        
        if(pic_array_hash[i] && pic_array_hash[i].length > 1)
        {
            Forward = "<div style=\"position: absolute; right: -30px; top: 44px;\"><a href=\"javascript:void(0);\" onclick=\"rollForvard(" + arrayNum + ", '" + id + "')\"><img src=\"/img/right.png\" alt=\"\" border=\"0\" /></a></div>";
            Back = "<div style=\"position: absolute; right: -30px; top: 66px;\"><a href=\"javascript:void(0);\" onclick=\"rollBack(" + arrayNum + ", '" + id + "')\"><img src=\"/img/left.png\" alt=\"\" border=\"0\" /></a></div>";
        }
        else
        {
            Forward = "";
            Back = "";            
        }
        
        rExp = /prop_w=(\d{1,})/gi;
        var found = rExp.exec(src);

        if(found && found[1] != 0)
        {
            rExp = /prop_w=(\d{1,})/gi;
    		width = rExp.exec(src);
            rExp = /prop_h=(\d{1,})/gi;
    		height = rExp.exec(src);
        }    
        else
        {
            rExp = /sel_w=(\d{1,})/gi;
    		width = rExp.exec(src);
            rExp = /sel_h=(\d{1,})/gi;
    		height = rExp.exec(src);
        }

        width = width[1];
        height = height[1]; 

        //rExp = /procent=(\d{1,})/gi;
		//src = src.replace(rExp, 'procent=100');

        if(width > $(window).width() - 100 || height > $(window).height())
        {
            var new_size = ResizeFullImg(width, height, src);
            width = new_size[0];
            height = new_size[1];
            src = new_size[2];  
        }       

        rExp = /mini_w=(\d{1,})/gi;
		src = src.replace(rExp, 'mini_w=' + width);
        rExp = /mini_h=(\d{1,})/gi;
		src = src.replace(rExp, 'mini_h=' + height);

        CreateOverlay();
        WaitingFor();

		$("body").append("<div id=\"FullSizeImgWindow\"></div>");
        
		$("#FullSizeImgWindow").css("display", "none")
        .css("background-color", "#ffffff")
        .css("border", "#999999 1px solid")
        .css("margin", "0 auto")
		.css("position", "fixed")
        .css("width", width + "px")
        .css("height", height + "px")
        .css("z-index", "11")
        .append("<div style=\"position: absolute; right: -30px; top: 0;\"><a href=\"javascript:void(0);\" onclick=\"$('#FullSizeImgWindow').remove(); CreateOverlay(0);\"><img src=\"/img/close.png\" alt=\"\" border=\"0\" /></a></div>")
        .append(Forward)
        .append(Back);        
        
        if(pic_array_hash[i] && pic_array_hash[i].length > 1)
        $("div#FullSizeImgWindow")
        .append("<a href=\"javascript:void(0);\" onclick=\"rollForvard(" + arrayNum + ", '" + id + "')\"><img onload=\"WaitingFor(0); $('div#FullSizeImgWindow').delay(100).fadeIn(300); ResizeOverlay();\" src=\"" + src + "\" style=\"display: block;\" border=\"0\" /></a>");        
        else
        $("div#FullSizeImgWindow")
        .append("<img onload=\"WaitingFor(0); $('div#FullSizeImgWindow').delay(100).fadeIn(300); ResizeOverlay();\" src=\"" + src + "\" style=\"display: block;\" border=\"0\" />");

        $("div#FullSizeImgWindow")
        .css("top", ($(window).height() / 2  - height / 2) + "px");
	    
        $("div#FullSizeImgWindow")
        .css("left", ($(window).width() / 2  - width / 2) + "px");

        if(subs != false)
        {
        	$("div#FullSizeImgWindow")
            .append("<div class=\"subscribe\">" + subs + "</div>");
        }
	}

// Подгонка размера изображения под величину экрана
    function ResizeFullImg(width, height, src)
    {
        if(width >= $(window).width() - 100)
        {
            new_width = $(window).width() - 140;
            new_height = (new_width / width * height).toFixed();
            procent = (new_width * 100 / width).toFixed();
        }

        if(height >= $(window).height())
        {
            new_height = $(window).height() - 40;
            new_width = (new_height / height * width).toFixed();
            procent = (new_height * 100 / height).toFixed(); 
        }        

        rExp = /procent=100/gi;
 		src = src.replace(rExp, 'procent=' + procent);            

        return [new_width, new_height, src];        
    }

// Прокрутка фоток вперед
    function rollForvard(arrayNum, id)
    {
        var imgArray = pic_array_hash[arrayNum];
        
        for(var k in imgArray)
        {
            if(imgArray[k] == id)
            {
                if(imgArray[parseInt(k) + 1])
                {
                    img = $("#" + imgArray[parseInt(k) + 1]);
                    ImgFullsize(img);
                    break;
                }
                else
                {
                    img = $("#" + imgArray[0]);
                    ImgFullsize(img);
                    break;
                }
            }    
        }
    }

// Прокрутка фоток назад
    function rollBack(arrayNum, id)
    {
        var imgArray = pic_array_hash[arrayNum];

        for(var k in imgArray)
        {
            if(imgArray[k] == id)
            {
                if(imgArray[parseInt(k) - 1])
                {
                    img = $("#" + imgArray[parseInt(k) - 1]);
                    ImgFullsize(img);                    
                    break;
                }
                else
                {
                    img = $("#" + imgArray[hashLength(imgArray) - 1]);
                    ImgFullsize(img);                    
                    break;
                }
            }    
        }
    }

// Длина хэша
    function hashLength(hash)
    {
        var counter = 0;
        for( var k in hash )
        counter++;
        return counter;
    }
    
// Показ подменю редактирования профилей разных разделов
    function showSub(obj)
    {
        var offset = $(obj).offset();             
        var left =  parseInt(offset.left);
        var top =  parseInt(offset.top) + parseInt($(obj).height());
        ShowHideObject('EditOwnProfilesSubMenu');          
    }

// Ввод только цифр
	function OnlyDigitType(e)
	{
		if ((e.keyCode < 48) || (e.keyCode > 57))
		{
	   		var code = e.keyCode ? e.keyCode : e.charCode;
           	if ( !( code == 8  ||  // Backspace
            code == 9  ||  // Tab
            code == 33 ||  // PageUP
            code == 34 ||  // PageDown
            code == 35 ||  // End
            code == 36 ||  // Home
            code == 37 ||  // LeftArrow
            code == 39 ||  // RightArrow
            code == 45 ||  // Insert
            code == 46 ||  // Delete
            ( code >= 48) && (code <= 57) ) )
	    	{
			    if ( (code < 48) || (code > 57) )
				{
			        e.cancelBubble = true;
			        if (e.stopPropagation)
					{
			            e.stopPropagation();
			        }
			        if (e.preventDefault)
					{
			            e.preventDefault();
			        }
					else
					{
			            e.returnValue = false;
			        }
			        return false;
			    }
		 	}
		}
	}

// Создание нового модального окошка
    function makePopupWin(id, w, h, caption, context, noclose)
    {
        if(h == null)
        h = "auto";
        else
        h = h + "px";
        
        //CreateOverlay();
		$("body").append("<div id=\"" + id + "\" style=\"display: none;\"><div class=\"modal_win_panel_auto\"><span class=\"modal_win_caption\">" + caption + "</span><div class=\"modal_win_field_oform\">" + context + "</div></div></div>");
        $("#" + id).css("position", "fixed");
    	$("#" + id).css("background-color", "#ffffff");
    	$("#" + id).css("width", w + "px");
    	$("#" + id).css("height", h);
    	$("#" + id).css("z-index", "11");
        $("#" + id).css("top", "40px");
    	$("#" + id).css("left", parseInt(($(window).width() - $("#" + id).width()) / 2 - 10) + "px");
        
        if(h != "auto")
        {
            $("div#" + id).find(".modal_win_field_oform").css("height", parseInt($("div#" + id).height() - 60) + "px");
            $("div#" + id).find(".modal_win_field_oform").css("overflow-y", "auto");
        }
        
        $("div#" + id).delay(300).fadeTo( 300, 1 ); 
        
        if(noclose == false)
        {
            $("#" + id).append("<div id=\"" + id + "Close\" class=\"close\" onclick=\"$('#" + id + "').remove(); CreateOverlay(0);\"></div>");   
        }         
         
        $(window).on("resize", function()
        {
       	    $("#" + id).css("top", "40px");
    	    $("#" + id).css("left", parseInt(($(window).width() - $("#" + id).width()) / 2 - 10) + "px");
        });                     
    }

// Конвертирование слоя в модальное окошко
    function convertToPopupWin(id, w, h, context, noclose)
    {
        
    // Режим преобразования сущестувующего слоя в окошко
        if(h == null)
        h = "auto";
        else
        h = h + "px";

        if($("#" + id).length == 1)
        {
    		$("#" + id).css("position", "fixed");
            $("#" + id).css("display", "none");
    		$("#" + id).css("background-color", "#ffffff");
    		$("#" + id).css("width", w + "px");
    		$("#" + id).css("height", h);
    		$("#" + id).css("z-index", "11");
        	$("#" + id).css("top", "40px");
    	    $("#" + id).css("left", parseInt(($(window).width() - $("#" + id).width()) / 2 - 10) + "px"); 
        }

        if(h != "auto")
        {
            $("div#" + id).find(".modal_win_field_oform").css("height", parseInt($("div#" + id).height() - 60) + "px");
            $("div#" + id).find(".modal_win_field_oform").css("overflow-y", "auto");
        }

        $("div#" + id).delay(300).fadeTo( 300, 1 );

        if(noclose == false)
        {
            $("div#" + id).append("<div id=\"" + id + "Close\" class=\"close\" onclick=\"HideModal('" + id + "');\"></div>");
        }        
        
        $(window).on("resize", function()
        {
       	    $("#" + id).css("top", "40px");
    	    $("#" + id).css("left", parseInt(($(window).width() - $("#" + id).width()) / 2 - 10) + "px");
        });
    }

// Создаем окно для скачивания защищенного файла
	function CreateDownloadFileWin(own_user_session, caption, file, src, lang, allow)
	{
        CreateOverlay();
        makePopupWin("DownloadFileWindow", 320, null, caption, "<iframe style=\"background-color: transparent\" src=\"" + src + "/download.php?allow=" + allow + "&lang=" + lang + "&own_user_session=" + own_user_session + "&file=" + file + "\" frameborder=\"0\" class=\"download_frame\" ></iframe>", false);
	}

// Очистка формы
	function ResetForm(id)
	{
        $("form#" + id).find("input[type='checkbox']").removeAttr("checked");
        
        var text = $("form#" + id).find(" input[ type != 'hidden' ]");
        
        for(var i = 0; i < text.length; i++)
        {
            if($(text).eq(i).attr("readonly") != "readonly")
            $(text).eq(i).val("");
        }
        
		$("form#" + id).find("textarea").val('');
	}

// Показать модалку
    $.fn.fcModal = function(options)
    {
        var options = $.extend(
        {
            width: 396                          
        },
        options);

        return this.each(function()
        {
            CreateOverlay();
            var captcha = $(this).find("img[src^='/picgen.php']").attr("id");
            if(captcha)
            RefreshImg(captcha);
            convertToPopupWin($(this).attr("id"), options.width, null, $(this).html(), false);
        });
    }

// Убрать (скрыть) модальное окно
    function HideModal(id)
    {
        $("#" + id + "Close").remove();
	    $("#" + id).hide();
	    CreateOverlay(0);
    }

// Убрать (удалить) модальное окно
    function RemoveModal(id)
    {
	    $("#" + id + "Close").remove();
	    $("#" + id).remove();
	    CreateOverlay(0);
    }

// Обновление капчи
	function RefreshImg(captcha_id)
	{
		var min_random = 0;
		var max_random = 999999999;
		max_random++;
		var range = max_random - min_random;
		var n = Math.floor(Math.random()*range) + min_random;
		$("#" + captcha_id + "image_reg").html("<img id=\"" + captcha_id + "\" style=\"vertical-align: middle\" width=\"125\" height=\"50\" src=\"/picgen.php?param=" + n + "\" border=\"0\">");
        $("#" + captcha_id + "Chislo").val("");
	}

	function ShowHideObject(id)
	{
        if($("#" + id).css("display") == "block")
		$("#" + id).hide(300);
		else
		$("#" + id).show(300);
	}

// Добавление данных в контейнер в конец, div, textarea, input и т.д.
	function appendDataInContainer(data, container)
	{
		rExp = /::::/gi;
		data = data.replace(rExp, "\r\n");
		data = htmlspecialchars_decode(data);
		$("#" + container).append(data);
	}

// Добавление данных в контейнер в начало, div, textarea, input и т.д.
	function prependDataInContainer(data, container)
	{
		rExp = /::::/gi;
		data = data.replace(rExp, "\r\n");
		data = htmlspecialchars_decode(data);
		$("#" + container).prepend(data);
	}

	function insertDataInContainer(data, container)
	{
        rExp = /::::/gi;
		data = data.replace(rExp, "\r\n");
		data = htmlspecialchars_decode(data);
		$("#" + container).html(data);
	}

// Безопасная вставка вернувшихся данных 
	function safeInsertData(data, cont)
	{
        var id = Math.floor(Math.random() * (100000 - 1 + 1)) + 1;
       
        $("body").append("<div id=\"" + id + "\" style=\"display: none\"></div>");
        $("#" + id).html(data);

        $("#" + id).find("textarea").each(function()
        {
            var txt = convertHTML($(this).val());
            $(this).val(txt);
        });
      
        $(cont).html($("#" + id).html());
        $("#" + id).remove();
	}

    function convertHTML(txt)
    {
        rExp = /<br.+?>/gi;
	    txt = txt.replace(rExp, "\r\n");
        txt = htmlspecialchars_decode(txt);
        return txt;        
    }

// Декодирование
	function htmlspecialchars_decode(string)
	{
   		rExp = /&amp;/gi;
   		string = string.replace(rExp, "&");
   		rExp = /&gt;/gi;
   		string = string.replace(rExp, ">");
   		rExp = /&lt;/gi;
   		string = string.replace(rExp, "<");
   		rExp = /&#39;/gi;
   		string = string.replace(rExp, "\'");
   		rExp = /&#039;/gi;
   		string = string.replace(rExp, "\'");
   		rExp = /&quot;/gi;
   		string = string.replace(rExp, '\"');
	    return string;
	}
 