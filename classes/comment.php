<?php

class comment extends db {

    private
	    $data = array();

    public
	    function __construct($row) {
	/*
	  /	Конструктор
	 */

	$this->data = $row;
    }

    public
	    function avatar($letter, $bcolor) {
	//$color	 = '#' . dechex(rand(7000000, 10000000));
	$color = '#fff';
	//$bcolor	 = '#' . dechex(rand(115, 7000000));
	return "<div style=' display: flex; justify-content: center; border:1px solid $bcolor; line-height:0.5;
  align-items: center;color:$color;background:$bcolor;text-align: center; width: 50px;  height: 50px; border-radius: 50%;-moz-border-radius: 50%; -webkit-border-radius: 50%;-khtml-border-radius: 50%;'>"
		. "<strong style='font-size: 36px;font-variant-caps: all-petite-caps;font-weight: 800;'>$letter</strong>"
		. "</div>";
    }

    public
	    function markup($bcolor='#ff6666') {
	/*
	  /	Данный метод выводит разметку XHTML для комментария
	 */

	// Устанавливаем псевдоним, чтобы не писать каждый раз $this->data:
	$d = &$this->data;

	$link_open	 = '';
	$link_close	 = '';

	if ($d['url'])
	{

	    // Если был введн URL при добавлении комментария,
	    // определяем открывающий и закрывающий теги ссылки

	    $link_open	 = '<a href="' . $d['url'] . '">';
	    $link_close	 = '</a>';
	}

	// Преобразуем время в формат UNIX:
	$d['dt'] = strtotime($d['dt']);

	// Нужно для установки изображения по умолчанию:

	if ($_SESSION['lang'] == 'UA')
	{
	    $ansver = 'Відповісти';
	}
	else
	{
	    $ansver = 'Ответить';
	}

	if (@$_SESSION["role"] >= 600):
	    $button = '<div class="cfoot"><a href="#' . $d['id'] . '" id="' . $d['id'] . '" class="replay btn btn-warning btn-sm px-3">' . $ansver . '</a></div>';
	else:
	    $button = '';
	endif;
	return '

			<div class="comment media mt-5">
				' . $link_open . '<div style="padding:4px;">'
		. $this->avatar(firstChar($d['name']), $bcolor) . '</div>'
		//. '<img class="mr-2 rounded-circle" src="http://www.gravatar.com/avatar/' . md5($d['email']) . '?size=50&amp;default=' . urlencode($url) . '" />'
		. $link_close . '
			    <div class="media-body">
				    <h5 class="mt-0"><b>' . $link_open . $d['name'] . $link_close . '</b> • <span class="date" title="Added at ' . date('H:i \o\n d M Y', $d['dt']) . '"><small>' . date('d M Y', $d['dt']) . '</small></span></h5>

					<p class="cbody">' . $d['body'] . '</p>
				' . $button . '
				</div>
			</div>
		';
    }

    public static
	    function validate(&$arr) {
	/*
	  /	Данный метод используется для проверки данных отправляемых через AJAX.
	  /
	  /	Он возвращает true/false в зависимости от правильности данных, и наполняет
	  /	массив $arr, который преается как параметр либо данными либо сообщением об ошибке.
	 */

	$errors	 = array();
	$data	 = array();

	// Используем функцию filter_input, введенную в PHP 5.2.0

	if (!($data['email'] = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL)))
	{
	    $errors['email'] = 'Пожалуйста, введите правильный Email.';
	}

	if (!($data['url'] = filter_input(INPUT_POST, 'url', FILTER_VALIDATE_URL)))
	{
	    // Если в поле URL был введн неправильный URL,
	    // действуем так, как будто URL не был введен:

	    $url = '';
	}

	// Используем фильтр с возвратной функцией:

	if (!($data['body'] = filter_input(INPUT_POST, 'body', FILTER_CALLBACK, array('options' => 'Comment::validate_text'))))
	{
	    $errors['body'] = 'Пожалуйста, введите текст комментария.';
	}

	if (!($data['name'] = filter_input(INPUT_POST, 'name', FILTER_CALLBACK, array('options' => 'Comment::validate_text'))))
	{
	    $errors['name'] = 'Пожалуйста, введите имя.';
	}

	if (!empty($errors))
	{

	    // Если есть ошибки, копируем массив $errors в $arr:

	    $arr = $errors;
	    return false;
	}

	// Если данные введены правильно, подчищаем данные и копируем их в $arr:

	foreach ($data as $k => $v)
	{
	    $arr[$k] = strip_tags($v);
	}

	// email дожен быть в нижнем регистре:

	$arr['email'] = strtolower(trim($arr['email']));

	return true;
    }

    private static
	    function validate_text($str) {
	/*
	  /	Данный метод используется как FILTER_CALLBACK
	 */

	if (mb_strlen($str, 'utf8') < 1)
	    return false;

	// Кодируем все специальные символы html (<, >, ", & .. etc) и преобразуем
	// символ новой строки в тег <br>:

	$str = nl2br(htmlspecialchars($str));

	// Удаляем все оставщиеся символы новой строки
	$str = str_replace(array(chr(10), chr(13)), '', $str);

	return $str;
    }

}
?>






















