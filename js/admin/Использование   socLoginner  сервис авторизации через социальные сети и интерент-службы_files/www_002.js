    function ShowForm(id)
    {
        $("#OrderedGoodForm, #BuyerAuthForm, #ShopPayForm").hide();
        $("#" + id).show();        
    }

// Функция создания заказа
    function makeOrder()
    {
        CreateOverlay();
        WaitingFor();
        var totalParams = $('#BuyerAuthForm').serialize() 
        + "&alias=" 
        + $("#ShopAlias").val() 
        + "&current_project_id=" 
        + JsGlobalCurrentProjectId 
        + "&current_language=" 
        + JsGlobalCurrentLanguage 
        + "&" + $('#OrderedGoodForm').serialize() 
        + "&script_file=modules/shop/actions.inc&CreateOrderButton=CreateOrderButton";        
        ajaxCall(totalParams);
    }

// Функция обновления заказа (обновляем тип доставки и дату) 
    function updateOrder(orderid, paymentgate)
    {
        CreateOverlay();
        WaitingFor();
        var totalParams = $('#PaymentGateForm').serialize() 
        + "&alias=" 
        + $("#ShopAlias").val() 
        + "&current_project_id=" 
        + JsGlobalCurrentProjectId 
        + "&current_language=" 
        + JsGlobalCurrentLanguage 
        + "&orderid="
        + orderid
        + "&paymentgate=" + paymentgate
        + "&script_file=modules/shop/actions.inc&UpdateOrderButton=UpdateOrderButton";
        
        ajaxCall(totalParams);
    }

// Корзина, авторизация: выслать на e-mail проверочный код
    function sendCode(obj)
    {
        var counter = $("#RetryLater").find("span");
        $(obj).hide();
        $("#RetryLater").show();
                    
        var interval = setInterval(function()
        {
            $(counter).html( $(counter).html() - 1  ); 
            if($(counter).html() == 0)
            {
                $(counter).html('15');
                clearInterval(interval); 
                $("#RetryLater").hide();
                $(obj).show();  
            }
        }, 
        1000);
        ajaxCall("email_ver_code=" + $("#NewBuyerEmail").val() + "&domain=" + JsGlobalDomain + "&current_project_id=" + JsGlobalCurrentProjectId + "&current_language=" + JsGlobalCurrentLanguage + "&uin=" + JsGlobalCurrentUserSession + "&script_file=modules/shop/actions.inc");
    }

// Корзина: ротация блоков "свой покупатель" / "новый покупатель"                 
    function RotateBuyerBlocks(id)
    {
        if(id == "BlockOwnBuyer")
        {
            $("#OwnBuyerLogin, #OwnBuyerPassword").removeAttr("disabled");
            $("#NewBuyerName, #NewBuyerLogin, #NewBuyerEmail, #NewBuyerPassword, #NewBuyerEmailCode").attr("disabled", "disabled");
            $("#BlockNewBuyer").hide();
            $("#BlockOwnBuyer").show();
            $("input[name='BuyerType']").val(2);   
        }
        else if(id == "BlockNewBuyer")
        {
            $("#OwnBuyerLogin, #OwnBuyerPassword").attr("disabled", "disabled");
            $("#NewBuyerName, #NewBuyerLogin, #NewBuyerEmail, #NewBuyerPassword, #NewBuyerEmailCode").removeAttr("disabled");
            $("#BlockNewBuyer").show();
            $("#BlockOwnBuyer").hide();  
            $("input[name='BuyerType']").val(3); 
        }
    }   
    
// Добавить товар к сравнению
    function AddToCompare(type, id)
    {
        CreateOverlay();
        WaitingFor();
        ajaxCall("add_to_compare_id=" + id + "&type=" + type + "&current_language=" + JsGlobalCurrentLanguage + "&current_project_id=" + JsGlobalCurrentProjectId + "&uin=" + JsGlobalCurrentUserSession + "&script_file=modules/shop/actions.inc");
    }

// Удалить товар из сравнения    
    function removeCompareGood(obj, type_id, good_id)
    {
        $(obj).closest(".compare_row").remove();
        ajaxCall("remove_compare_id=" + good_id + "&type=" + type_id + "&current_language=" + JsGlobalCurrentLanguage + "&current_project_id=" + JsGlobalCurrentProjectId + "&uin=" + JsGlobalCurrentUserSession + "&script_file=modules/shop/actions.inc");
    }

// Добавить товар в корзину
    function AddInCart(good_id, kolvo, price)
    {
        CreateOverlay();
        WaitingFor();
        ajaxCall("add_in_cart=&current_project_id=" + JsGlobalCurrentProjectId + "&current_language=" + JsGlobalCurrentLanguage + "&uin=" + JsGlobalCurrentUserSession + "&good_id=" + good_id + "&kolvo=" + kolvo + "&price=" + price + "&script_file=modules/shop/actions.inc");
    }

// Обновить корзину
    function RefreshCart()
    {
        ajaxCall("get_goods_num=&current_project_id=" + JsGlobalCurrentProjectId + "&current_language=" + JsGlobalCurrentLanguage + "&uin=" + JsGlobalCurrentUserSession + "&script_file=modules/shop/actions.inc");
    }
/*
// Окошко корзины
    function CreateOrderWindow(shop_alias, caption)
    {
        var id = "OrderWindow";
        var w = $(window).width() - 100;
        var h = $(window).height() - 80;
        CreateOverlay();
        
        makePopupWin(id, w, h, caption, "", false);
        
        $("#" + id)
        .find(".modal_win_field_oform")
        .html("<div id=\"" + id + "ContextField\" style=\"width: 100%; height: 100%;\"><img src=\"/img/preloaders/loader7.gif\" style=\"margin-left: " + (w / 2 - 90) + "px; margin-top: " + (h / 2 - 90) + "px\"></div>");

        setTimeout(function()
        {
            ajaxCall("step=1&alias=" + shop_alias + "&domain=" + JsGlobalDomain + "&current_project_id=" + JsGlobalCurrentProjectId + "&current_language=" + JsGlobalCurrentLanguage + "&uin=" + JsGlobalCurrentUserSession + "&script_file=modules/shop/actions.inc");
        }, 
        300);
    }

// Окошко платежного шлюза для отложенного заказа
    function CreateNonpaymentOrderWindow(alias, order_id)
    {
        var id = "OrderWindow";
        var w = $(window).width() - 100;
        var h = $(window).height() - 80;
        makePopupWin(id, w, h, "", "", false);
        $("#" + id).find(".modal_win_field_oform").html("<div id=\"" + id + "ContextField\" style=\"width: 100%; height: 100%;\"><img src=\"/img/preloaders/loader7.gif\" style=\"margin-left: " + (w / 2 - 90) + "px; margin-top: " + (h / 2 - 90) + "px\"></div>");
        setTimeout(function()
        {	        
            ajaxCall("get_order_id=" + order_id + "&alias=" + alias + "&domain=" + JsGlobalDomain + "&current_project_id=" + JsGlobalCurrentProjectId + "&current_language=" + JsGlobalCurrentLanguage + "&uin=" + JsGlobalCurrentUserSession + "&script_file=modules/shop/actions.inc");        
        }, 
        300);
    }
*/
// Увеличить на 1 товар
    function IncreaseQuantity(price, id)
    {
        var new_q = parseInt($("input[name='SelectedGoodKolvo" + id + "']").val()) + 1;
        $("input[name='SelectedGoodKolvo" + id + "']").val( new_q );
        var new_summ = parseFloat($("input[name='SelectedGoodTotalSumm']").val()) + parseFloat(price);
        $("input[name='SelectedGoodTotalSumm']").val( new_summ );
        $("#CartTotalSumm").html( new_summ );
        $("#CurrentQuantity" + id).html( new_q );
    }    

// Уменьшить на 1 товар    
    function DecreaseQuantity(price, id)
    {
        if(parseInt($("input[name='SelectedGoodKolvo" + id + "']").val()) > 1)
        {
            var new_q = parseInt($("input[name='SelectedGoodKolvo" + id + "']").val()) - 1;
            $("input[name='SelectedGoodKolvo" + id + "']").val( new_q );
            var new_summ = parseFloat($("input[name='SelectedGoodTotalSumm']").val()) - parseFloat(price);
            $("input[name='SelectedGoodTotalSumm']").val( new_summ );
            $("#CartTotalSumm").html( new_summ );
            $("#CurrentQuantity" + id).html( new_q );
        }
    }  

// Удаление из корзины
    function RemoveFromCart(obj)
    {
        var id = $(obj).closest(".cart_row").find("input[name^='SelectedGoodId']").attr("value");
        var kolvo = $(obj).closest(".cart_row").find("input[name^='SelectedGoodKolvo']").attr("value");
        var ed_price = $(obj).closest(".cart_row").find("input[name^='SelectedGoodPrice']").attr("value");
        var total_summ = $("#CartTotalSumm").html();
        var kolvo_counter = $("#CartGoodQuantity").html();
        var minus_summ = kolvo * ed_price;
        $("#CartGoodQuantity").html(kolvo_counter - 1);
        total_summ = total_summ - minus_summ;
        $("#CartTotalSumm").html(total_summ);
        $("#SelectedGoodTotalSumm").val(total_summ);
        $(obj).closest(".cart_row").remove();
        ajaxCall("remove_good=&current_project_id=" + JsGlobalCurrentProjectId + "&current_language=" + JsGlobalCurrentLanguage + "&uin=" + JsGlobalCurrentUserSession + "&good_id=" + id + "&script_file=modules/shop/actions.inc");       
    }  

// Специфические функции для текущего проекта