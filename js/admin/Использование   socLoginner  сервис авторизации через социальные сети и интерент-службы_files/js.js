
// Перерисовка оверлея
    function ResizeOverlay()
    {
        $('#CmsTotalOverlay').css('height', $(document).height() + 'px');            
    }    

// Специфические функции для текущего проекта можно писать ниже

    var userInfo = function(user)
    {
    // user.id - id пользователя
    // user.name - имя пользователя
    // user.network - название сети, через которую проходит авторизация
    // user.pic - ссылка на аватарку юзера в этой соцсети
    
        $("#ReturnInfo").html(
        "ID: " + user.id + "<br />" + 
        "Имя: " + user.name + "<br />" + 
        "Сервис авторизации: " + user.network + "<br />" +  
        "Картинка: <img src=\"" + user.pic + "\" alt=\"Это я :)\" title=\"Это я :)\" /><br />"     
        );
    
    }