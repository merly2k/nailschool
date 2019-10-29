<?php

/*
 * этот файл распространяется на условиях коммерческой лицензии
 * по вопросам приобретения кода обращайтесь merly2k at gmail.com
 */

/**
 * Description of user
 *
 * @author Лосев-Пахотин Руслан Витальевич <merly2k at gmail.com>
 */
class user extends db{

    public $classname = __CLASS__;
    public $name;
    public $acl;
    
    function __construct() {
	parent::__construct();
        $this->name=  self::getName();
	
    }
    
    function auch($login){
        $q="SELECT * FROM user WHERE `login`='$login' LIMIT 1;";
        //echo $q;
	$user=$this->get_result($q);
        
	$curuser=@$user[0];
	return $curuser;
	
    }
    function updateReg($id){
	$q="UPDATE `user` SET `activated`='1' WHERE `id`='".$id."';";
	$user=$this->query($q);
	return 1;
    }

    public function getName() {
        if(!isset ($_SESSION['login'])){
            $this->name='guest';
            }else{
            $this->name=$_SESSION['login'];
            }
            
        return $this->name;
    }
    public function GetUser($login){
        
        $user=$this->get_result("SELECT * FROM user WHERE `login`='$login' LIMIT 1;");
	$curuser=$user[0];
	return $curuser;
    }

    
}

?>
