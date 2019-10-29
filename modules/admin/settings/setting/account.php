<?php

$tpl = 'admin';
$content = '';
$modal_name = '';
$modal_content = '';
$mod_name = "Настройки доступа";
$content .= "<div class='col-12'>";


$user = new model\user();
if ($_POST) {
    extract($_POST);
    $content .= $user->editUser($id, $login, $password, $role);
}
foreach ($user->getUsers() as $row) {
    $sun = array(333 => '', 601 => '');
    $sun[$row->role] = "selected";
    $content .= "<div class='card'>"
            . "<div class='card-body'>";
    $content .= '<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb" crossorigin="anonymous">

<form method="post">
<div class="row">
  <div class="form-group col-3">
    <label for="login">login</label> 
    <div class="input-group">
      <div class="input-group-addon">
        <i class="fa fa-address-card"></i>
      </div> 
      <input id="login" name="login" class="form-control here" type="text" value="' . $row->login . '">
      <input name="id" type="hidden" value="' . $row->id . '">
    </div>
  </div>
  <div class="form-group col-3">
    <label for="passwoed">password</label> 
    <div class="input-group">
      <div class="input-group-addon">
        <i class="fa fa-key"></i>
      </div> 
      <input id="password" name="password" class="form-control here" type="text">
    </div>
  </div>
  <div class="form-group col-3">
    <label for="role">Права</label> 
    <div>
      <select id="role" name="role" required="required" class="custom-select">
        <option value="601" ' . $sun['601'] . '>Администратор</option>
        <option value="333" ' . $sun['333'] . '>Сотрудник</option>
      </select>
    </div>
  </div> 
  </div> 
  <div class="form-group">
    <button name="submit" type="submit" class="btn btn-primary">ок</button>
  </div>
</form>';
    $content .= "</div>";
    $content .= "</div>";
}
$content .= "</div>";
$content .= "</div>";
include TEMPLATE_DIR . DS . $tpl . ".html";
