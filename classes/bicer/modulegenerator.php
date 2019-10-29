<?php

namespace bicer;

/**
 * Description of modulegenerator
 *
 * @author merly
 */
class modulegenerator {
    function AdminModule($name) {
	$path=APP_PATH.'/modules/admin/'.$name;
    if(!is_dir($path))
    {
	mkdir($path, 0777, true);
		echo "папка админки $path создана";
	chmod($path,0777);
    
    }
    else
    {
		echo "папка админки $path alredy created";
	
    }
    $file=$path."/index.php";
    $content="<?php 
	\$template = 'admin';
	\$mod_name='module $name';
	\$cont_id = @\$this->param[0];
	\$ed = new model\\$name();
	\$ajax = ' ';
	\$f=new bootstrap\\input();
	\$forma= \$f->render_form('$name');
	 /**
	 put you code here
	 */
	include TEMPLATE_DIR . DS . \$template . '.html';";
    
	echo"<br>create admin $file<br>";
    if(file_put_contents($file, $content)) { echo "admin file $file created";} ;
    
    }
    function UserModule(){
    $module=APP_PATH.'/modules/'.$name;	
    $modContent="";
    $mod=$module."/index.php";
        if(!is_dir($module))
    {
	mkdir($path, 0777, true);
		echo "папка админки $module создана";
	chmod($path,0777);
    
    }
    else
    {
		echo "папка $mod alredy created";
	
    }

	echo"<br>create module $file<br>";
    if(file_put_contents($mod, $modContent)) { echo "modile file $file created";} ;
	$module=APP_PATH.'/modules/'.$name;
	
    } 
    
    Function CteateTable(){}
    
    function genModel(){}
}















































