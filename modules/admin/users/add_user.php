<?php

$brouse	 = '';
$lsize	 = '';
if (!$_POST):
    $option		 = '';
    $ol		 = new db();
    $mod_name	 = "добавление пользователя";
//foreach ($ol->get_result("select * from role") as $vl) {
//    $option.='<option value="'.$vl->id.'">'.$vl->name.'</option>';
//}
    /*
     * @var
      `id` int(11) NOT NULL AUTO_INCREMENT,
      `login` varchar(50) NOT NULL,
      `password` varchar(50) NOT NULL,
      `role` int(11) NOT NULL,
      `userPhoto` varchar(50) NOT NULL,
      `name` varchar(50) NOT NULL,
      `sname` varchar(50) NOT NULL,
      `fname` varchar(50) NOT NULL,
      `bio` text
      `veteran` int
      `INN` varchar(50) NOT NULL,
      `phone` varchar(50) NOT NULL,
      `email` varchar(50) NOT NULL,
      `apiKey` text NOT NULL,
      `brith_date` date NOT NULL,
      `latestActivity` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
      `regDate` datetime NOT NULL,
     */
    $context	 = '<form method="post" class="form-horizontal">'
	    . '<fieldset>'
	    . '<div class="form-group col-md-12">
	    <div class="form-group row">
	    <label class="col-md-2 control-label">Логин</label>
	    <div class="col-md-2">
	    <input  name="login" placeholder="Логин" class="form-control input-md" type="text">
	    </div>
	    '
	    . '<label class="col-md-2 control-label" for="textinput">Пароль</label>
	    <div class="col-md-2">
	    <input  name="password" placeholder="Пароль" class="form-control input-md" type="text">
	    </div>
	    '
	    . '<label class="col-md-2 control-label" for="textinput">роль</label>
	    <div class="col-md-2">
	    <select name="role" class="form-control input-md" required="required">
	    <option value="">выберите роль</option>
	    <option value="333">пользователь</option>
	    <option value="601">админ</option>
	    </select>
	    </div>
	    '
	    . '<div class="form-group">
  <div class="col-md-2 pull-right">
    <button class="btn btn-primary" type="submit">Зберегти</button>
  </div>
</div>'
	    . '</fieldset>'
	    . '</form>';








    $template = "admin";

    include TEMPLATE_DIR . $template . ".html";

else:
    $ins = new model\user();
    echo ' <meta charset="UTF-8">
	<pre>';
    print_r($_POST);
    extract($_POST);

    $ins->Insert($login, $password, $role);
    echo '<script>
           window.setTimeout(function(){location.replace("' . WWW_ADMIN_PATH . '/users")},1000);
         </script>';
endif;
