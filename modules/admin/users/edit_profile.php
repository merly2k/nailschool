<?php

$template	 = "admin/admin"; //"index";
$mod_name	 = 'Профиль пользователя';
$brouse		 = '';
$lsize		 = '';
$userdata	 = new model\user();
$roles		 = array(
    "user"	 => "333",
    "admin"	 => "601"
);
$optlist	 = '';
if (!$_POST):
    $uid	 = $this->param[0];
    $pf	 = $userdata->getUserByID($uid);
    $qr	 = $pf[0];
    foreach ($roles as $k => $v)
    {
	if ($v == $qr->role)
	{
	    $optlist .= "<option value='$v' selected='selected'>$k</option>";
	}
	else
	{

	    $optlist .= "<option value='$v'>$k</option>";
	}
    }
    $context = '<div class="well">
      	<hr>
	<div class="row">
      <div class="col-md-6 personal-info">
        <form class="form-horizontal" role="form" method="post" action="' . WWW_ADMIN_PATH . 'users/edit_profile">
          <div class="form-group">
            <label class="col-lg-3 control-label">login:</label>'
	    . '<div class="col-lg-8">'
	    . '<input name="login" value="' . $qr->login . '"/>'
	    . '<input type="hidden" name="pk" value="' . $uid . '"/>'
	    . '</div>
          </div>
	  <div>
            <label class="col-lg-3 control-label">роль:</label>'
	    . '<div class="col-lg-8">'
	    . '<select name="role">'
	    . $optlist
	    . '</select>'
	    . '</div>
          </div>
	  <div class="form-group">
            <label class="col-lg-3 control-label">password:</label>'
	    . '<div class="col-lg-8">'
	    . '<input name="password" value=""/>'
	    . '</div>
          </div>
          <button class="btn btn-info" type="submit">save</button>
        </form>
      </div>
    <div class="col-md-6 .bg-light">
    ВНИМАНИЕ: если вы не хотите менять пароль пользователя - оставте поле пароля пустым!
    </div>
  </div>
</div>
<hr>'
	    . '';


    include TEMPLATE_DIR . $template . ".html";
else:
    $login		 = $_POST['login'];
    $password	 = $_POST['password'];
    $rid		 = $_POST['pk'];
    $role		 = $_POST['role'];
    echo $userdata->editUser($rid, $login, $password, $role);
    echo "<script>setTimeout(function() { location.replace('" . WWW_ADMIN_PATH . "users'); }, 900)</script>";
endif;
?>









































