<?php

namespace model;

/**
 * @author merly
 */
class blog extends \db {

    public
	    function SelectAll() {
	$q = "SELECT SQL_CALC_FOUND_ROWS *, LEFT(`content`, 256) as `lcontent` FROM `blog` ORDER BY `pdate` DESC,`id` DESC";
	return $this->get_result($q);
    }

    public
	    function getLast($m = 4) {
	$q = "SELECT SQL_CALC_FOUND_ROWS *,LEFT(`content`, 256)as `lcontent` FROM `blog` ORDER BY `pdate` DESC,`id` DESC LIMIT 0,$m";
	return $this->get_result($q);
    }

    public
	    function getBlog($offset = 0, $page_result = 10) {

	$zapros = "SELECT SQL_CALC_FOUND_ROWS *, LEFT(`content`, 320) as `lcontent` FROM `blog` ORDER BY `id` ASC, `pub` ASC limit $offset, $page_result;";
	//echo $zapros;
	return $this->get_result($zapros);
    }

    function Insert($val = array()) {
	foreach ($val as $k => $v)
	{
	    $$k = $v;
	}
	$q = "INSERT INTO `blog` (`link`, `title`,`content`, `postdate`) VALUES ('$link','$title', '$content', '$pdate');";

	$this->query($q);

	return $this->last_id;
    }

    /**
     * @param type $id
     * @param type $params array(fieldName=>fieldValue)
     */
    function Upostdate($params, $id) {
	$q = "UPDATE `blog` SET ";
	foreach ($params as $k => $v)
	{
	    $p[] = "`$k`='$v'";
	}
	$q .= implode(", ", $p) . " WHERE  `id`=$id;";

	$this->query($q);

	return $this->lastState;
    }

    /**
     * @param type $cel - столбец по которому производится удаление (по умолчанию ID)
     * @param type $val - значение по которому производится удаление
     */
    function Delete($val, $cel = 'id') {
	$q = "DELETE FROM `blog` WHERE  `$cel`='$val;'";

	$this->query($q);

	return $this->lastState;
    }

    public
	    function getIds() {
	$q = "SELECT `id` FROM `blog`";
	return $this->get_cols($q);
    }

    /**
     * @param type $cel - столбец по которому производится выборка (по умолчанию ID)
     * @param type $val - значение по которому производится выборка
     */
    function SelectBy($val, $cel = 'id') {
	$q = "SELECT SQL_CALC_FOUND_ROWS * FROM `blog` WHERE  `$cel`='$val';";

	return $this->get_result($q);
    }

    function SelectByURL($usl) {
	$q = "SELECT SQL_CALC_FOUND_ROWS * FROM `blog` WHERE  `link`='$usl';";
	//print_r($q);

	return $this->get_result($q);
    }

}
