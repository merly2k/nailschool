<?php

/*
 * этот файл распространяется на условиях коммерческой лицензии
 * по вопросам приобретения кода обращайтесь merly2k at gmail.com
 */

/**
 * Description of crud
 *
 * @author Лосев-Пахотин Руслан Витальевич <merly2k at gmail.com>
 */
class crud extends db {

    public $classname = __CLASS__;

    function __construct() {
	parent::__construct();

    }

    public function tblList(){
	$q="SHOW TABLES from ".DB_NAME.";";
	$cor="Tables_in_".DB_NAME;
	$out="<form method='POST'>"
	    ."<select name='table' onChange='this.form.submit();'>"
	    . "<option>select Table</option>";
	$this->get_rows($q);
	foreach ($this->result as $value) {
	    extract($value);	    
	    $out.="<option>${$cor}</option>";
	}
	$out.="</select></form>";
	return $out;
    }

    protected function getInfo($table) {
	$q = "SHOW COLUMNS FROM $table";
	$this->get_rows($q);
	$struct = $this->result;
	$this->clRes();
	return $struct;
    }
    
    public function buildManageModule($table) {
	
    }

    public function buildAddForm($table) {
	$formdata = self::getInfo($table);
	$out="";
	foreach ($formdata as $key => $value) {
	    extract($value);
	    $out.= $this->field($Field, $Type, $Extra) . "<br />";
	}

	parent::close();
	return $out;
    }

    public function show_data($table, $headers = array()) {

	$out = '';
	$thead = $this->getInfo($table);

	foreach ($thead as $fields) {
	    $out.="<th>" . $fields['Field'] . "</th>";
	}
	$out.='<th>действия</th>';
	parent::close();

	$out.=$this->load_data($table);


	echo $out;
    }

    private function load_data($table) {
	$q = 'select * from ' . $table . ';';
	$ss = $this->get_rows($q);

	foreach ($this->result as $key => $value) {
	    print_r($value);
	}
    }

    private function field($name, $tupe, $extra) {
	$out = '';
	if (preg_match('@enum\(\'(.*)\'\)@', $tupe, $mat)) {
	    $out.="<label for='$name'>$name</label><select name='$name'>";
	    $lister = explode("','", $mat[1]);
	    foreach ($lister as $ke => $va) {
		$out.="<option value='$va'>$va</option>";
	    }
	    $out.="</select>\n\r";
	} elseif (preg_match('@set\(\'(.*)\'\)@', $tupe, $mat)) {
	    $out.="<label for='$name'>$name</label><select name='$name'>";
	    $lister = explode("','", $mat[1]);
	    foreach ($lister as $ke => $va) {
		$out.="<option value='$va'>$va</option>";
	    }
	    $out.="</select>\n\r";
	} elseif (preg_match("@text@", $tupe)) {
	    $out.="<label for='$name'>$name</label><textarea name='$name'></textarea>\n\r";
	} else {
	    if ($extra == 'auto_increment') {
		$out = '';
	    } else {
		$out.="<label for='$name'>$name</label><input name='$name' placeholder='$name' />\n\r";
	    }
	}

	return $out;
    }

}

?>
