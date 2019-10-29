<?php
set_time_limit(490);
$tpl		 = 'admin';
$mod_name	 = 'Пакеты курсов';
$context	 = '<pre>';
$town=@$this->param[0];
$nav=' <ul class="nav nav-tabs">';
$f=new bootstrap\input();
$forma= $f->render_form('cursses');
$packets= new model\packets();
$tt= new model\misto();
$out='<a href="add" class="btn btn-primary">Создать пакет курсов</a><hr>'
	. '<table class="table DataTable"><thead><tr>'
	. '<th>пакет</th>'
	. '<th>цена</th>'
	. '<th>Длительность</th>'
	. '<th>Действие</th>'
	. '</tr>'
	. '</thead>';
foreach ($tt->getAll() as $t){
    //print_r($t);
    if($town==$t->link){$active='active';$mod_name="Пакеты : $t->name_ua";}else {$active='';}
    $nav.='<li class="nav-item"><a class="nav-link '.$active.'" href="'.WWW_ADMIN_PATH.'packets/'.$t->link.'">'.$t->name_ua.'</a></li> ';
    }
    $nav.="</ul>";
    if(isset($town)):
    foreach($packets->getPackets($town)as $cl){
	print_r($cl);
	$out.="<tr>"
		. "<td>$cl->name_ua</td>"
		. "<td>$cl->coast</td>"
		. "<td>$cl->dayz</td>"
		. "<td><a href='edit/$cl->id'><i class='fa fa-edit'> </a></td>"
		. "</tr>";
    }
    else:
	$out="выберите город";
    endif;
    
    

    $nav.='</ul> ';
$context.=$nav.$out;

include TEMPLATE_DIR . DS . $tpl . ".html";








































































































































































































