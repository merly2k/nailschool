<?php
namespace model;

/**
 * Description of clients
 *
 * @author merly
 */
class clients extends \db{
    function getAll() {
	$q="select * from clients";
        return $this->get_result($q);
    }
    
    function getByName($name) {
	
    }
    function getByFname($name) {
	
    }
    function getById($id){
        $q="select * from clients where id='$id';";
        return $this->get_result($q);
    }
    function Add($param) {
	$recomended='off';
	extract($param);
	$fio=$fname."". $name."".$sname;
	$q="INSERT INTO `clients` ("
		. "`dd`,"
		. " `name`,"
		. " `sname`,"
		. " `fname`,"
		. " `fio`,"
		. " `berstday`,"
		. " `phone`,"
		. " `addres`,"
		. " `house`,"
		. " `appartment`,"
		. " `qveshion`,"
		. " `resultat`,"
		. " `recomended`,"
		. " `annotation`)"
		. " VALUES ("
		. "'$dd 00:00:00', "
		. "'$name',"
		. "'$sname', "
		. "'$fname', "
		. "'$fio', "
		. "'$berstday', "
		. "'$phone', "
		. "'$addres', "
		. "'$house', "
		. "'$appartment', "
		. "'$qveshion', "
		. "'$resultat', "
		. "'".checkbox2field($recomended)."', "
		. "'$annotation');";
	//echo $q;
	$this->query($q);
	return $this->lastState;
    }
    function edit($param) {
	$recomended='off';
	extract($param);
	$fio=$fname."". $name."".$sname;
	$q="UPDATE `clients` SET"
		. "`dd`='$dd 00:00:00', "
		. " `name`='$name',"
		. " `sname`='$sname',"
		. " `fname`='$fname',"
		. " `fio`='$fname $name $sname',"
		. " `berstday`='$berstday',"
		. " `phone` = '$phone',"
		. " `addres`='$addres',"
		. " `house`='$house',"
		. " `appartment`='$appartment',"
		. " `qveshion`='$qveshion',"
		. " `resultat`='$resultat',"
		. " `recomended`='".checkbox2field($recomended)."',"
		. " `annotation`='$annotation'"
                . "where `id`='$id';";
	//echo $q;
	$this->query($q);
	return $this->lastState;
    }
    
}
