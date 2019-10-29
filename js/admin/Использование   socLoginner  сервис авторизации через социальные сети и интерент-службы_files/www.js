  
    function beginUserUpload(form_id, attempts, ext, upload_dir_path, uin, fname)
    {
        var uf = $('#' + form_id);
        var fd =  new FormData(uf[0]);
        var url = "/upload.php?uin=" + uin + "&upload_dir_path=" + upload_dir_path + "&fname=" + fname + "&project_id=" + JsGlobalCurrentProjectId + "&language=" + JsGlobalCurrentLanguage + "&allow_ext=" + ext;
        var status = false;
          
        $.ajax(
        {
            type: "POST",
            url: url,
            data: fd,
            async: false,
            processData: false,
            contentType: false,
            attempts: attempts,
            
            success: function(data, textStatus)
 			{
                result = $.parseJSON(data);
            },
            
            complete: function()
            {
                status = result;  
            },
                        
            error: function(xhr, status) 
            {
                this.attempts--;

            // попытки пока не кончились
                if(this.attempts != 0) 
                {
                     beginUserUpload(form_id, this.attempts, ext, upload_dir_path, uin, fname);
                }
                
                status = false;
            }                                
        });

        return status; 
    }

// Удаление загруженного файла
    function deleteForumUploadFile(alias, autor_uin, theme_id, file)
    { 
        $("#ForumThemeBlock").hide();
        WaitingFor();         
        
        var param = "delete_forum_uploaded_file=&current_project_id=" + JsGlobalCurrentProjectId + "&current_language=" + JsGlobalCurrentLanguage + "&script_file=modules/forum/actions.inc&theme_id=" + theme_id + "&alias=" + alias + "&autor_uin=" + autor_uin +"&file=" + file;
        ajaxCall(param); 
		
        var rExp = "filename=" + file;

        $("#ForumThemeBody")
        .find("img")
        .filter(function() 
        {
            return $(this).attr("src").match(rExp);
        })
        .closest("span")
        .fadeOut(300, function()
        {
            $(this).remove();    
        });     
    }

// Проверка разрешенных расширений
	function CheckUploadFile(allow_bytesize, allow_ext, wrong_ext_txt, wrong_size_txt)
	{
        if($("#UploadFileSelectedImage").val() == "")
        return false;

        var myfile = $("#UploadFileSelectedImage").val();
        var reg_exp = /(.*)\.(.+?)$/;
		var found = myfile.match(reg_exp); 
    
        var file_size = document.getElementById("UploadFileSelectedImage").files[0].size;
        var ext = allow_ext.split(";");
        var exist = false;

        if(found)
        myext = found[2].toLowerCase();

        for(var i = 0; i < ext.length; i++) 
        { 
            if(ext[i] == myext)
            { 
                exist = true;
                break;
            } 
        } 

    // 1. Проверяем расширение
        if(exist == false) 
        {
            alert(wrong_ext_txt); 
            $('#ForumUploadFilePath').val(''); 
            $('#UploadFileSelectedImage').val('');
			return false;                     
        }  

    // 2. Проверяем размер
        if(file_size > allow_bytesize)
        {
            alert(wrong_size_txt + Math.round(allow_bytesize / 1024) + " kb"); 
            $('#ForumUploadFilePath').val(''); 
            $('#UploadFileSelectedImage').val('');
			return false;                     
        } 
        
        $("#ForumUploadFilePath").val($('#UploadFileSelectedImage').val());   
	}

// Создать цитату
    function getCitate(id, caption, button_title)
    {
        var parentEl = null, sel;

        if (window.getSelection) 
        {
            sel = window.getSelection();
            if (sel.rangeCount) 
            {
                parentEl = sel.getRangeAt(0).commonAncestorContainer;
                if (parentEl.nodeType != 1) 
                {
                    parentEl = parentEl.parentNode;
                }
            }
        } 
        else if((sel = document.selection) && sel.type != "Control") 
        {
            parentEl = sel.createRange().parentElement();
        }
        
        if(
        $(parentEl).closest("#_ForumMessageTxt_" + id).length == 1 
        || $(parentEl).closest("#_ForumMessageCaption_" + id).length == 1
        || $(parentEl).closest("#_ForumThemeCaption_" + id).length == 1
        || $(parentEl).closest("#_ForumThemeTxt_" + id).length == 1
        )
        {
            $("#ForumAnswerText")
            .val("[citate]" + sel + "[/citate]\n")
            .focus();

            $("#ForumAnswerAgreeRules")
            .removeAttr("checked");

            $("#ForumAgreeRules")
            .removeAttr("checked");

            $("#ForumAnswerBlock")
            .find(".modal_win_caption")
            .html(caption);
            
            $("#ForumAnswerBlock")
            .find("button[type='submit']")
            .attr("name", "ForumAnswerCreate")
            .attr("id", "ForumAnswerCreate")
            .attr("disabled", "disabled")
            .html(button_title);       
           
            CreateOverlay(); 
            RefreshImg('ForumAnswerCaptcha'); 
            convertToPopupWin('ForumAnswerBlock', 600, null, null, false);
        }
        else
        {
            CreateOverlay();
            
            setTimeout( function()
            { 
                alert("Выделите текст");
                CreateOverlay(0); 
            }, 500); 
        }    
    }

// Подача жалобы    
    function doComplaint(message_id, compliant_user_session, forum_id)
    {
        CreateOverlay();
        $("#ForumCompliantForumId").val(forum_id);
        $("#ForumCompliantMessageId").val(message_id);
        RefreshImg('ForumCompliantCaptcha'); 
        convertToPopupWin("ForumCompliantBlock", 600, null, null, false);
    }

// Новая форма темы
    function callNewThemeForm(caption, button_title)
    {
        CreateOverlay();
        
        $("#ForumThemeBlock")
        .find(".modal_win_caption")
        .html(caption);
        
        $("#ForumThemeBlock")
        .find("button[type='submit']")
        .attr("name", "ForumThemeCreate")
        .attr("id", "ForumThemeCreate")
        .attr("disabled", "disabled")
        .html(button_title);
        
        $('#ForumThemeBlock')
        .find('#ForumExistUploadedFile')
        .html("")
        .hide();
        
        $('#ForumThemeBlock')
        .find('#ForumUploadFileField')
        .show();
        
        $("#ForumAgreeRules")
        .parent()
        .show();
        
        $('#ForumAgreeRules').prop('checked', false); 
        
        RefreshImg('ForumThemeCaptcha'); 
        convertToPopupWin('ForumThemeBlock', 600, null, null, false);   
        
        ResizeOverlay(); 
    }
    
    function forumAgreeChbox(obj)
    {
        if($(obj).is(':checked') != false)
        { 
            $(obj)
            .closest("form")
            .find("button[type='submit']")
            .removeAttr('disabled');
        } 
        else
        { 
            $(obj)
            .closest("form")
            .find("button[type='submit']")
            .attr('disabled', 'disabled');             
        } 
    }

// Новая форма ответа    
    function callNewAnswerForm(caption, button_title)
    {
        CreateOverlay(); 
        
        $('#ForumAnswerAgreeRules').prop('checked', false); 
        
        $("#ForumAnswerBlock")
        .find(".modal_win_caption")
        .html(caption);
        
        $("#ForumAnswerBlock")
        .find("button[type='submit']")
        .attr("name", "ForumAnswerCreate")
        .attr("id", "ForumAnswerCreate")
        .attr("disabled", "disabled")
        .html(button_title);        

        $('#ForumAnswerBlock')
        .find('#ForumAnswerCaption').val(''); 
        
        $('#ForumAnswerBlock')
        .find('#ForumAnswerText').val('');
         
        $("#ForumAnswerAgreeRules")
        .parent()
        .show();
        
        RefreshImg('ForumAnswerCaptcha'); 
        convertToPopupWin('ForumAnswerBlock', 600, null, null, false);          

        ResizeOverlay();

    }

// Заполняем окно редактирвоания текста    
    function fillEditForumForm(id, alias, allow_ext, current_user_uin, type)
    {
        CreateOverlay();
        WaitingFor();
        var param = "get_own_text=&current_project_id=" + JsGlobalCurrentProjectId + "&current_language=" + JsGlobalCurrentLanguage + "&script_file=modules/forum/actions.inc&allow_ext=" + allow_ext + "&type=" + type + "&id=" + id + "&alias=" + alias + "&user_uin=" + current_user_uin;
        ajaxCall(param); 
		return false;                
    }

// Окошко с Правилами форума    
    function ShowForumRules(parent_win_id)
    {
        var child_win_id = "ForumRulesBlock";
        $("#" + parent_win_id).fadeOut(300, function()
        {
            convertToPopupWin(child_win_id, 600, 600, null, true); 
            $("#ForumSwitchBackToWin")
            .attr("onclick", "ForumSetFocusOnWindow('" + parent_win_id + "', '" + child_win_id + "')");             
        });
    }

// Окошко с аватарками    
    function ShowAvatarsSet(parent_win_id, caption, rubric_id)
    {
        var child_win_id = "ForumAvatarWin";
        $("#" + parent_win_id).hide();
        var avatars = "";
        
   		$.ajax(
		{
			url: "/ajax.php",
			cache: false,
			type: "post",
			data: "current_project_id=" + JsGlobalCurrentProjectId + "&current_language=" + JsGlobalCurrentLanguage + "&rubric_id=" + rubric_id + "&script_file=modules/forum/actions.inc&getAvatars=",
			success: function(data, textStatus)
			{
                var result = jQuery.parseJSON( data );
                if(result)
                {
                    makePopupWin(child_win_id, 600, 400, caption, result[0], false);
                    $("#" + child_win_id)
                    .find("#" + child_win_id + "Close")
                    .attr("onclick", "ForumSetFocusOnWindow('" + parent_win_id + "', '" + child_win_id + "'); $('#" + child_win_id + "').remove(); ");
                    
                }
   			},
			error: function()
			{
				alert('Error');
			}
		});        
    }  
    
// Применение изменения аватарки
    function ApplyAvatarChange(path, file, rubric_id)
    {
        var d = new Date();
        $('#ForumAvatarWin').remove();
        $("#_ForumEditProfileAvatar" + rubric_id).find("img").attr("src", path + file + "?" + d.getTime());
        $("#ForumEditProfileForm" + rubric_id).find("input[name='Avatar']").val(file);
        $("#ForumProfileBlock" + rubric_id).show();
        //$("#_ForumEditProfileAvatar" + rubric_id).find("img").reload();
    }
    
    function ForumSetFocusOnWindow(parent_id, child_id)
    {
        $("#" + child_id).fadeOut(300, function()
        {
           $("#" + parent_id).delay(100).fadeIn(300);
        });
    }

// Окошко профиля    
    function ShowForumUserProfile(user_id, rubric_id)
    {
        CreateOverlay();
        WaitingFor();
        var param = "&current_project_id=" + JsGlobalCurrentProjectId + "&current_language=" + JsGlobalCurrentLanguage + "&script_file=modules/forum/actions.inc&rubric_id=" + rubric_id + "&user_id=" + user_id + "&GetUserProfile=";
        ajaxCall(param); 
		return false;
    }    
    
// Окошко редактирования профиля    
    function GetForumUserProfileChangeForm(caption, user_uin, rubric_id)
    {
        CreateOverlay();
        WaitingFor();
        var param = "&current_project_id=" + JsGlobalCurrentProjectId + "&current_language=" + JsGlobalCurrentLanguage + "&script_file=modules/forum/actions.inc&rubric_id=" + rubric_id + "&user_uin=" + user_uin + "&GetChangeFormUserProfile=";
        ajaxCall(param); 
		return false;
    }    
// Подписка / отписка на тему    
    function CurrThemeSubscribe(theme_id)
    {
        CreateOverlay();
        WaitingFor();
        var param = "set_subscribe_status=&current_project_id=" + JsGlobalCurrentProjectId + "&current_language=" + JsGlobalCurrentLanguage + "&script_file=modules/forum/actions.inc&theme_id= " + theme_id;
        ajaxCall(param); 
		return false;
    }
    
// Смайлы
    function insertSmile(img_obj, img_src, file, textarea_id)
    {
        var cursorPos = $('#' + textarea_id).prop('selectionStart');
        var v = $('#' + textarea_id).val();
        var textBefore = v.substring(0,  cursorPos );
        var textAfter  = v.substring( cursorPos, v.length );
        $('#' + textarea_id).val( textBefore + "[" + file + "]" + textAfter );        
        $(img_obj).parent("div").find("img").animate({opacity : 0.5}, 1);
        $(img_obj).animate({opacity : 1}, 1);        
    }
    