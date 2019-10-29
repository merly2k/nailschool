<?php
$template = "admin"; //"index";
$mod_name = 'Профиль пользователя';
$userdata=new model\user();
if(!$_POST):
$uid=$this->param[0];
$pf=$userdata->getUserByID($uid);
$qr=$pf[0];
$context='<div class="well">
      	<hr>
	<div class="row">
      <div class="col-md-6 personal-info">
        <form class="form-horizontal" role="form" method="post" action="'.WWW_ADMIN_PATH.'users/edit_profile">
          <div class="form-group">
            <label class="col-lg-3 control-label">login:</label>'
	    .'<div class="col-lg-8">'
	    . '<input name="login" value="'.$qr->login.'"/>'
	    . '<input type="hidden" name="pk" value="'.$uid.'"/>'
            . '</div>
          </div>
	  <div class="form-group">
            <label class="col-lg-3 control-label">password:</label>'
	    .'<div class="col-lg-8">'
	    . '<input name="password" value=""/>'
            . '</div>
          </div>
          <button class="btn btn-default" type="submit">save</button>
        </form>
      </div>
    <div class="col-md-6 .bg-light">
    ВНИМАНИЕ: если вы не хотите менять пароль пользователя - оставте поле пароля пустым!
    </div>
  </div>
</div>
<hr>'
	. '';


include TEMPLATE_DIR.$template.".html";
else:
  $login=$_POST['login'];
  $password=$_POST['password'];
$rid=$_POST['pk'];
echo $userdata->editUser($rid, $login, $password);
echo "<script>setTimeout(function() { location.replace('" . WWW_ADMIN_PATH . "users'); }, 900)</script>";
endif;

?>





































