<?php

//ini_set("display_errors",1);
//error_reporting(999999);
$template = "restore";
$cont_id = @$this->param[0];
if (!$_POST):
    $content = "<form class='form-horizontal panel-body' style='background-color:#fcfcfc;padding:20px;' method='POST' action='" . WWW_BASE_PATH . "auth/restore' data-toggle='validator'>
                            <fieldset class='' >
                                <!-- Form Name -->
                                <p>Введите e-mail адрес использованный при регистрации. На этот адрес будут высланы инструкции по восстанеовлению пароля</p>
                                <!-- Text input-->
                                <div class='form-group'>
                                    <label class='col-md-3 control-label' for='login'>e-mail</label>  
                                    <div class='col-md-6'>
                                        <input id='mail' name='mail' placeholder='you@mail' pattern='[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$' class='form-control input-md' type='email' data-error='Введите адрес правильно!' required>
                                        <span class='help-block  with-errors'>Введите свой e-mail</span>  
                                    </div>
                                </div>
                                <div class='form-group'>
                                    <label class='col-md-3 control-label' for='login'></label>  
                                    <div class='col-md-6'>
    				<div class='g-recaptcha' data-sitekey='6LdWLiYUAAAAAJPbYtKBaYea7jyTK94SVnK7b7Im' data-callback='enableBtn' data-expired-callback='disableBtn' style='transform:scale(0.70);-webkit-transform:scale(0.70);transform-origin:0 0;-webkit-transform-origin:0 0;'>
				</div>
				</div>
				</div>
				<div class='form-group'>
                               </div>
                                <!-- Button -->
                                <div class='form-group'>
				<label class='col-md-2 control-label'></label>  
				    <div class='col-md-4'>
					<a class='btn btn-info'  href='" . WWW_BASE_PATH . "'>Вернуться на сайт</a>  
				    </div>
				    <div class='col-md-4'>
					<button id='submit_button' name='singlebutton' class='btn btn-primary'>Восстановить пароль</button>
				    </div>
                                </div>

                            </fieldset>
                        </form>";
elseif (empty($this->param[0])):
    $maill = $_POST['mail'];
    $content = '<form>'
            . '<fieldset>'
            . '<div class="center-block"><br>На ваш адрес <strong>'
            . $maill
            . '</strong> отправленна ссылка для восстановления пароля</div><br>'
            . '</fileset>'
            . '</form>';
    $expire = strtotime('now + 48 hours');
    $str = dechex(time()) . md5(uniqid($maill));
    $rest = new db();
    $q = "INSERT INTO `pas_link` (`hashe`, `mail`, `expire`) VALUES ('$str', '$maill', '$expire');";
//print_r($q);
    $rest->query($q);
    $html = "Восстановление пароля "
            . "Здравствуйте, на нашем сайте кто-то сделал запрос на восстановление пароля."
            . " Если запрос сделан вами - перейдите по ссылке " . WWW_BASE_PATH . "auth/chp/$str "
            . " если нет - просто проигнорируйте это сообщение."
            . " Внимание, ссылка действительна 48 часов.";
    $message = pismo("Restore password", $maill, $html);
else:
    $content = "<form class='form-horizontal panel-body' style='background-color:#fcfcfc;padding:20px;' method='POST' action='" . WWW_BASE_PATH . "auth/restore'>
                            <fieldset class='' >
                                <!-- Form Name -->
                                <p>Введите e-mail адрес использованный при регистрации. На этот адрес будут высланы инструкции по восстанеовлению пароля</p>
                                <!-- Text input-->
                                <div class='form-group'>
                                    <label class='col-md-3 control-label' for='login'>e-mail</label>  
                                    <div class='col-md-6'>
                                        <input id='mail' name='mail' placeholder='you@mail' class='form-control input-md' type='text'>
                                        <span class='help-block'>Введите свой e-mail</span>  
                                    </div>
                                </div>

                               
                                <!-- Button -->
                                <div class='form-group'>
                                    <label class='col-md-4 control-label' for='singlebutton'></label>
                                    <div class='col-md-4'>
                                        <button id='singlebutton' name='singlebutton' class='btn btn-primary'>Восстановить пароль</button>
                                    </div>
                                </div>

                            </fieldset>
               </form>";
endif;

include TEMPLATE_DIR . $template . ".html";
