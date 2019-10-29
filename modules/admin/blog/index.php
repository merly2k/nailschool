<?php
$template = "admin";
$mod_name='Управление блогом';
$langua='';
$langru='';
$langen='';
$context='';

$cont_id = @$this->param[0];
$ed = new model\blog();
$ajax = " ";


$f=new bootstrap\input();
$forma= $f->render_form('blog');
    if($_POST){
    extract($_POST);
    if(!isset($id)){$id=$this->param[1];}
    $params=array(
	'id'=>$id,
	'title'=>$title,
	'content'=>$content,
	'pdate'=>$pdate,
	'image'=>$image,
	'pub'=>$pub
	
    );
    if($cont_id=='new'){
     $ed->Insert($params);}
    elseif ($cont_id=='update') {
	$id=$this->param[1];
    $ed->Upostdate($params, $id);
}
    if ($ed->lastState) {
	echo $ed->lastState;
    } else {
	$message = "сохранено";
	 //echo "<script>setTimeout(function() { location.replace('" . WWW_ADMIN_PATH . "blog/'); }, 900)</script>";
    }
    }
    
if ($cont_id=='new') {
    
    $context.="<form method='post'>$forma"
	    . "<button type='submit' class='btn btn-info'>Опубликовать</button>"
	    . "</form>";
    
}

elseif (is_numeric($cont_id)) {
    $data=$ed->SelectBy($cont_id);
    //print_r($data);
    $form=$f->renderFormByData('blog',(array)$data[0]);
    $context.="<form method='post' action='update/$cont_id'>$form"
	    . "<button type='submit' class='btn btn-info'>Опубликовать</button>"
	    . "</form>";
}
else {
    $context.='<a class="btn btn-info" href="'.WWW_ADMIN_PATH.'blog/new">добавить статью</a>
                                <table class="table DataTable table-striped table-bordered table-hover" >
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Заголовок</th>
                                            <th>Статья</th>
                                            <th>действие</th>
                                        </tr>
                                    </thead>
                                    <tbody>
				    ';
    
    foreach ($ed->SelectAll() as $row) {
	
	$context.="<tr><td>".$row->id
	    ."</td><td>".$row->title
	    ."</td><td>".strip_tags($row->lcontent)
	    ."</td>"
	    . "<td class='panel'>"
		. "<a href='".WWW_ADMIN_PATH."blog/".$row->id."'>
		    <i class='fa fa-pencil'></i></a>
		    &nbsp;&nbsp;
                    <a href='".WWW_ADMIN_PATH."blog/del_content/".$row->id."'>
		    <i class='fa fa-trash-o'></i></a>"
	    ."</td>"
	. "</tr>
		";
    };
    $context.="</tbody></table>
	    ";
    
    
}



include TEMPLATE_DIR . DS . $template . ".html";
?>




















































































