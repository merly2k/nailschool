<?php

// Сообщение об ошибке:
error_reporting(E_ALL^E_NOTICE);


/*
/	Выбираем все комментарии и наполняем массив $comments объектами
*/
$data=new db();
$comments = array();
$q="SELECT * FROM comments ORDER BY id ASC";
$result=$data->get_result($q);
//echo $data->lastState;
foreach ($result as $row)
{
	$comments[] = new comment((array)$row);
}

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<link rel="stylesheet" type="text/css" href="<?=WWW_CSS_PATH?>coments.css" />

</head>

<body>

<br><br><br><br><br><br><br><br><br><br><br>
<div id="main">

<?php

/*
/	Вывод комментариев один за другим:
*/

foreach($comments as $c){
	echo $c->markup();
}

?>

<div id="addCommentContainer">
	<p>Добавить комментарий</p>
	<form id="addCommentForm" method="post" action="">
    	<div>
	    <input type="hidden" name="page" value="<?=$link?>"
        	<label for="name">Имя</label>
        	<input type="text" name="name" id="name" />
            
            <label for="email">Email</label>
            <input type="text" name="email" id="email" />
            <label for="body">комментарий</label>
            <textarea name="body" id="body" cols="20" rows="5"></textarea>
            <input type="submit" id="submit" value="Отправить" />
        </div>
    </form>
</div>

</div>

<script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
<script type="text/javascript" src="<?=WWW_JS_PATH?>comment.js"></script>
<script type="text/javascript">
$(".addcomment").on('click',function(e){
$( "#replayForm" ).remove();
var parent=this.id;
var forma="<form id='replayForm' method='post' action=''><div>"
+"<input type='hidden' name='parent_id' value='"+parent+"'>"
+"<label for='name'>Имя</label><input type='text' name='name' id='name' /><br>"
+"<label for='email'>Email</label><input type='text' name='email' id='email' /><br>"
+"<label for='body'>комментарий</label><textarea name='body' id='body' cols='20' rows='5'></textarea>"
+"<input type='submit' id='submit' value='Отправить' /></div></form>";
$(this).html(forma);
})
</script>
</body>
</html>



































