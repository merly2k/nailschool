<?php

namespace model;

/**
 * @author merly
 */
class blog extends \db {

    public
	    function SelectAll() {
	$q = "SELECT SQL_CALC_FOUND_ROWS *, LEFT(`content_ru`, 256) as `lcontent_ru` ,LEFT(`content_ua`, 256) as `lcontent_ua` FROM `blog` ORDER BY `pdate` DESC,`id` DESC";
	return $this->get_result($q);
    }

    public
	    function getLast($m = 4) {
	$q = "SELECT SQL_CALC_FOUND_ROWS *,LEFT(`content_ru`, 256) as `lcontent_ru` ,LEFT(`content_ua`, 256) as `lcontent_ua` FROM `blog` ORDER BY `pdate` DESC,`id` DESC LIMIT 0,$m";
	return $this->get_result($q);
    }

    public
	    function getBlog($offset = 0, $page_result = 10) {

	$zapros = "SELECT SQL_CALC_FOUND_ROWS *, LEFT(`content_ru`, 400) as `lcontent_ru` ,LEFT(`content_ua`, 400) as `lcontent_ua` FROM `blog` ORDER BY `id` ASC, `pub` ASC limit $offset, $page_result;";
	//echo $zapros;
	return $this->get_result($zapros);
    }

    function Insert($param) {
	extract($param);
	$q = "INSERT INTO `blog` (`link`, `title_ua`,`content_ua`,`title_ru`,`content_ru`,`image`,`tags`, `pdate`) VALUES ('$link','$title_ua', '$content_ua','$title_ru','$content_ru','$image','$tags', '$pdate');";
	//echo $q;
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

    function search($termin,$lang) {
        $content="content_".$lang;
        $title="content_".$lang;
$q = "SELECT `title`, `$content`, `link`,
(
    MATCH(`$title`) AGAINST('$termin') * 10 OR
    MATCH(`$content`) AGAINST('$termin')*5
) AS `relev`
FROM `blog` WHERE
MATCH(`title`) AGAINST('$termin' WITH QUERY EXPANSION)>0
OR
MATCH(`$content`) AGAINST('$termin' WITH QUERY EXPANSION)>0
ORDER BY `relev` DESC";
        //echo $q;
	//echo $q;SELECT * FROM `articles` WHERE MATCH (title,body) AGAINST ('database');
	return $this->get_result($q);
    }

   /**
     function getTags() {
	$out	 = '';
	$needle	 = array('@\.@', '@\,@', '@\(@', '@\:@', '@\;@', '@\)@', '@\"@', '@\'@', '@\!@');
	$q	 = 'select content_ua as tg FROM blog';
	foreach ($this->get_result($q) as $tg)
	{

	    $out .=preg_replace('/<[^>]*>/', ' ', $tg->tg);// strip_tags($tg->tg);
	}
	$out		 = preg_replace($needle, ' ', $out);
	$tuo		 = array_count_values(explode(' ', $out));
	$stopWords	 = array('и', 'в', 'а', 'с', 'к', 'о', '-','0','1','2','д',
	    'из', 'их', 'вы', 'на', 'от', 'На', 'за', 'под', 'над', 'не', 'но',
	    'что', 'как', 'все', 'она', 'так', 'его', 'только', 'мне', 'было', 'вот',
	    'меня', 'еще', 'нет', 'ему', 'теперь', 'когда', 'даже', 'вдруг', 'если',
	    'уже', 'или', 'быть', 'был', 'него', 'вас', 'нибудь', 'опять', 'вам', 'ведь',
	    'там', 'потом', 'себя', 'может', 'они', 'тут', 'где', 'есть', 'надо', 'ней',
	    'для', 'тебя', 'чем', 'была', 'сам', 'чтоб', 'без', 'будто', 'чего', 'раз',
	    'тоже', 'себе', 'под', 'будет', 'тогда', 'кто', 'этот', 'того', 'потому',
	    'этого', 'какой', 'ним', 'этом', 'один', 'почти', 'мой', 'тем', 'чтобы',
	    'нее', 'были', 'куда', 'зачем', 'всех', 'можно', 'при', 'два', 'другой',
	    'хоть', 'после', 'над', 'больше', 'тот', 'через', 'эти', 'нас', 'про', 'них',
	    'какая', 'много', 'разве', 'три', 'эту', 'моя', 'свою', 'этой', 'перед',
	    'чуть', 'том','он', 'такой', 'более', 'всю', '', ' ', '&nbsp', 'одно', '/', 1, 2, 3, 4, 5, 6, 7, 8, 9, 0
	);
	foreach ($stopWords as $stopword)
	{
	    unset($tuo[$stopword]);
	}
	natsort($tuo);
	return array_reverse($tuo);
    }
    
*/
     function getTags() {
         $q="select `tags` , `link` FROM `blog`";
         foreach($this->get_result($q) as $k=>$tl){
             $tag["$tl->link"]= $tl->tags;
         }
         return $tag;
}
}