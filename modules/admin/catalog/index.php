<?php

$brouse		 = '';
$lsize		 = '';
$template	 = "admin";
$mod_name	 = 'Управление товарами';
$langua		 = '';
$langru		 = '';
$langen		 = '';
$context	 = '';

$cont_id = @$this->param[0];
$ed	 = new model\tovar();
$ajax	 = " ";
$cat	 = new model\category();
foreach ($cat->getAll() as $v)
{
    //print_r($v->id);
    //stdClass Object ( [id] => 68437647 [parent] => 0 [name] => Подставки под чашки, бокалы и тарелки [ru] => Подставки под чашки, бокалы и тарелки [en] => Подставки под чашки, бокалы и тарелки )
    $cats[$v->id] = $v->name;
}

$f	 = new bootstrap\input();
$forma	 = $f->render_form('products');
if ($_POST)
{
    //print_r($_POST);
    extract($_POST);
    $params = array(
	'article'	 => $article,
	'name'		 => $name,
	'meta'		 => $meta,
	'deckription'	 => $deckription,
	'type'		 => $type,
	'price'		 => $price,
	'valut'		 => $valut,
	'otg'		 => $otg,
	'min_obs'	 => $min_obs,
	'opt_price'	 => $opt_price,
	'min_opt'	 => $min_opt,
	'img'		 => $img,
	'show'		 => $show,
	'sklad'		 => $sklad,
	'category'	 => $category,
	'postavka'	 => $postavka,
	'brand'		 => $brand,
	'country'	 => $country,
	'discount'	 => $discount,
	'comment'	 => $comment,
	'fulURL'	 => $fulURL,
	'YelowLabel'	 => $YelowLabel
    );
    //print_r($params);
    if ($cont_id == 'new')
    {
	$ed->Insert($params);
    }
    elseif ($cont_id == 'update')
    {
	$id = $this->param[1];
	$ed->Update($params, $id);
    }
    if ($ed->lastState)
    {
	$message = $ed->lastState;
    }
    else
    {
	$message = "сохранено";
	echo "<script>setTimeout(function() { location.replace('" . WWW_ADMIN_PATH . "catalog'); }, 900)</script>";
    }
}

if ($cont_id == 'new')
{

    $context .= "<form method='post'>$forma"
	    . "<button type='submit' class='btn btn-info'>Опубликовать</button>"
	    . "</form>";
}
elseif (is_numeric($cont_id))
{
    $data	 = $ed->SelectById($cont_id);
    //print_r($data);
    $form	 = $f->renderFormByData('products', (array) $data[0]);
    $context .= "<form method='post' action='update/$cont_id'>$form"
	    . "<button type='submit' class='btn btn-info'>Опубликовать</button>"
	    . "</form>";
}
else
{
    $langua .= '<a class="btn btn-info" href="' . WWW_ADMIN_PATH . 'catalog/new">добавить товар</a>
                                <table class="table DataTable table-striped table-bordered table-hover" >
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Товар</th>
                                            <th>Каталог</th>
                                            <th>действие</th>
                                        </tr>
                                    </thead>
                                    <tbody>
				    ';

    foreach ($ed->getAll() as $row)
    {

	$langua .= "<tr><td>" . $row->id
		. "</td><td>" . $row->name
		. "</td><td>" . $cats[$row->category]
		. "</td>"
		. "<td class='panel'>"
		. "<a href='" . WWW_ADMIN_PATH . "catalog/" . $row->id . "'>
		    <i class='fa fa-pencil'></i></a>
		    &nbsp;&nbsp;
                    <a href='" . WWW_ADMIN_PATH . "catalog/del_content/" . $row->id . "'>
		    <i class='fa fa-trash-o'></i></a>"
		. "</td>"
		. "</tr>
		";
    };
    $langua .= "</tbody></table>
	    ";
}
$langen = '';


//ru
$langru = '';

$context .= '<div class="tab-pane container active" id="ua"><h3>ua</h3>' . $langua . '</div>'
	. '<div class="tab-pane container fade" id="ru"><h3>ru</h3>' . $langru . '</div>'
	. '<div class="tab-pane container fade" id="en"><h3>en</h3>' . $langen . '</div>'
	. '</div';



include TEMPLATE_DIR . DS . $template . ".html";
?>













