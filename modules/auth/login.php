<?php

$_SESSION['message'] = '';
if (!$_POST):
    header('Location:' . WWW_BASE_PATH . 'autch/');
else:
    //print_r($_POST);
    $login = stripslashes($_POST['login']);
    $password = md5(stripslashes($_POST['password']));

    $user = new model\user();
    $loged = $user->auch($login);
    print_r($loged);
    if ($loged->password == $password):

        $_SESSION["loged"] = 1;
        //$user = $loged->user;
        $_SESSION['id'] = $loged->id;
        $_SESSION['login'] = $loged->login;
        $_SESSION['role'] = $loged->role;

        switch ($loged->role) {
            case 601:
                header('Location:' . WWW_ADMIN_PATH);

                break;
            case 333:
                header('Location:' . WWW_ADMIN_PATH);

                break;
            default :

                header("Location:" . WWW_BASE_PATH . "auth/");

                break;
        };

    else:

        $message = 'error';
        $_SESSION['message'] = $message;

        session_start();
        header('Location:' . WWW_BASE_PATH . 'auth/');


    endif;
endif;
?>