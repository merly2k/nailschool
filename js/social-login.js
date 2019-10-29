

    var timere2e919f93f8336fa06c8d3228868513d, 
    infowine2e919f93f8336fa06c8d3228868513d, 
    readyListe2e919f93f8336fa06c8d3228868513d = [], 
    infoe2e919f93f8336fa06c8d3228868513d;

// Функция авторизации
    function authVia(network, callback, color, opacity)
    {
        var color = color || false;
        var opacity = opacity || false;
        var url = false; 

        var params = {"current_url": location.href, "callback": callback}
        params = JSON.stringify(params);           
        var rExp = new RegExp("&", 'gi');
        params = params.replace(rExp, '[ampersande2e919f93f8336fa06c8d3228868513d]'); 

        params = escape(params);

        switch(network)
        {
        // Facebook   
            case "facebook":
            {
                url = "https://www.facebook.com/dialog/oauth?display=popup&client_id=124154574596545&redirect_uri=http://socloginner.standarta.net/networks/facebook/auth.php&response_type=code&state=" + params;
                createWindow(url, color, opacity);
                break;    
            }  
        // вКонтакте    
            case "vkontakte":
            {
                url = "http://oauth.vk.com/authorize?client_id=5036007&redirect_uri=http://socloginner.standarta.net/networks/vk/auth.php&response_type=code&state=" + params;
                createWindow(url, color, opacity);
                break;    
            }   
        // Одноклассники
            case "odnoklassniki":
            {
                url = "http://www.odnoklassniki.ru/oauth/authorize?client_id=1150608640&redirect_uri=http://socloginner.standarta.net/networks/odnoklassniki/auth.php&response_type=code&state=" + params;
                createWindow(url, color, opacity);
                break;
            }
        // Яндекс
            case "yandex":
            {
                url = "https://oauth.yandex.ru/authorize?response_type=code&client_id=7a143999655548a88a604aa20b31835b&display=popup&state=" + params;
                createWindow(url, color, opacity);
                break;
            }            
        // Google
            case "google":
            {
                url = "https://accounts.google.com/o/oauth2/auth?redirect_uri=http://socloginner.standarta.net/networks/google/auth.php&response_type=code&client_id=1074114663649-n8iqrc2ie2j0p7kpohm6r8f3ib7vmfss.apps.googleusercontent.com&scope=https://www.googleapis.com/auth/userinfo.email https://www.googleapis.com/auth/userinfo.profile&state=" + params;
                createWindow(url, color, opacity);
                break;
            }
        // Mail
            case "mail":
            {
                url = "https://connect.mail.ru/oauth/authorize?client_id=736870&response_type=code&redirect_uri=http://socloginner.standarta.net/networks/mail/auth.php&state=" + params;
                createWindow(url, color, opacity);
                break;
            }
        // Twitter
            case "twitter":
            {
                createWindow("http://socloginner.standarta.net/networks/twitter/auth.php", color, opacity);
                
                function makeXMLRequest() 
                {
                    var xmlhttp = new XMLHttpRequest();
                    xmlhttp.onreadystatechange = function() 
                    {
                        if(xmlhttp.readyState == 4) 
                        {
                            var decode_token = JSON.parse(xmlhttp.responseText); 
                            url = "https://api.twitter.com/oauth/authorize?oauth_token=" + decode_token;
                            infowine2e919f93f8336fa06c8d3228868513d.location.href = url;
                        }
                    }
                    
                    var loc = location.href;
                    var rExp = new RegExp("\\s{1,}", 'gi');
                    loc = loc.replace(rExp, '%20');                     
                    xmlhttp.open("GET", "http://socloginner.standarta.net/networks/twitter/get_token.php?current_url=" + loc + "&callback=" + callback, true);
                    xmlhttp.send();
                    return;
                }

                makeXMLRequest()
                
                break;
            }
        }
    }
    
    function createWindow(url, color, opacity)
    {
        if((typeof(infowine2e919f93f8336fa06c8d3228868513d) == 'undefined' || infowine2e919f93f8336fa06c8d3228868513d.closed) && url != false)
        { 
            makeOverlay(true, color, opacity);
            infowine2e919f93f8336fa06c8d3228868513d = window.open(url, "NetworkUserInfo", "toolbar=no, width=1000px, height=600px, status=no, resizable=no");
            
            timere2e919f93f8336fa06c8d3228868513d = setInterval(function()
            {
               checkInfoWin()
            }, 2000); 
             
        // Постоянная проверка существования окна 
            function checkInfoWin()
            {
                try
                {
                    if(!infowine2e919f93f8336fa06c8d3228868513d || infowine2e919f93f8336fa06c8d3228868513d.closed)
                    {
                        makeOverlay(false);
                        clearInterval(timere2e919f93f8336fa06c8d3228868513d);
                    }
                }
                catch(e)
                {

                }
            }
        } 
        else 
        { 
            infowin.focus();
        }           
    }
    
// Забираем данные из url, если вернулся info - передаем на обработку 
    function getDataFromUrl() 
    {
        var url = location.href;
        url = decodeURIComponent(url);
        var rExp = new RegExp("socloginneride2e919f93f8336fa06c8d3228868513d=(.+?)&socloginnernamee2e919f93f8336fa06c8d3228868513d=(.+?)&socloginnerpice2e919f93f8336fa06c8d3228868513d=(.+?)&socloginnernetworke2e919f93f8336fa06c8d3228868513d=(.+?)&socloginnercallbacke2e919f93f8336fa06c8d3228868513d=(.*)$", 'gi');
        var found = rExp.exec(url);

        if(found) 
        {
           var params = {"id": found[1], "name": found[2], "pic": found[3], "network": found[4]}
           window.close();
           processResult(params, found[5])
        }
    }

// Обработка
    function processResult(infoe2e919f93f8336fa06c8d3228868513d, callback)
    {
        if(eval("opener." + callback + " != false && typeof(opener." + callback + ") == 'function'"))
        {
            eval('opener.' + callback + '(infoe2e919f93f8336fa06c8d3228868513d)')
        }
        else
        {
            alert("Объявленная Callback-функция не существует, либо внутри нее есть ошибка синтаксиса")
        }
        
        return true;
    }
    
// Оверлей 
    function makeOverlay(status, color, opacity)
   	{
        var color = color || false;
        var opacity = opacity || false;
        
        if(status != false)
        {
            
            var div = document.createElement("div");
            div.id = "socloginnerTotalOverlay";
            div.style.width = "100%";
            div.style.height = "100%";
            div.style.color = "white";

            
	    //if(document.getElementById("CmsTotalOverlay"))
            //div.style.background = "transparent";
            //else
            //{                        
                if(color != false)
                div.style.background = color;
                else
                div.style.background = "black";
            //}            
                
            div.style.position = "fixed";
            div.style.top = "0";
            div.style.left = "0";
            
            if(opacity != false)
            div.style.opacity = opacity;
            else
            div.style.opacity = "0.9";
            
            div.onclick = function()
            {
                infowine2e919f93f8336fa06c8d3228868513d.focus()
            }
            document.body.appendChild(div);	
        } 
        else
        {
            var elem = document.getElementById("socloginnerTotalOverlay");
            elem.parentNode.removeChild(elem);    
            elem = document.getElementById("CmsTotalOverlay");
            elem.parentNode.removeChild(elem);
        }
   	}  

    getDataFromUrl();
    