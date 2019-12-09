<?php

namespace bootstrap;

class input {

    public
	    function __construct() {
	return;
    }

    public
	    function get_field_type($a) {
	//echo $a . ' ';
	switch ($a)
	{
	    case 'int':
		$tupe	 = 'text';
		break;
	    case 'date':
		$tupe	 = 'datetime-local';
		break;
	    case 'text':
		$tupe	 = 'textarea';
		break;
	    case "enum('Y','N')":
		$tupe	 = 'enum';
		break;
	    case "timestamp":
		$tupe	 = 'now';
		break;
	    default :
		$tupe	 = 'text';
		break;
	}
	return $tupe;
    }

    public
	    function render_form($table) {
	$c	 = 1;
	$out	 = '';
	$db	 = new \db();
	foreach ($db->get_fields($table) as $k => $v)
	{
	    if ($k != 'id')
	    {
		$type = $this->get_field_type($v->type);
		//$out .="$type";
		switch ($type)
		{
		    case 'text':
			if ($v->label != ''):
			    if ($k == 'image')
			    {
				$out .= $this->input("f$c", $v->label, 'file', $k);
			    }
			    else
			    {
				$out .= $this->input("f$c", $v->label, $type, $k);
			    }
			else:
			//$out .= $this->input("f$c", $v->label, 'hidden', $k);
			endif;
			break;
		    case 'textarea':
			$out .= $this->EditorTextarea($v->label, $k, '');
			break;

		    case 'datetime-local':
			$out	 .= $this->input("f$c", $v->label, 'date', $k);
			break;
		    case 'now':
			$out	 .= $this->input("f$c", $v->label, 'date', $k, date('Y-m-d'));
			break;
		    case 'enum':
			$out	 .= $this->checkbox("f$c", $v->label, $k);
			break;
		}
		$c++;
	    }
	}
	return $out;
    }

    function renderFormByData($table, $data = array()) {
	//print_r($data);
	$c	 = 1;
	$out	 = '';
	$db	 = new \db();
	foreach ($db->get_fields($table) as $k => $v)
	{
	    if ($k != 'id')
	    {
		$type = $this->get_field_type($v->type);
		//$out .="$type";
		switch ($type)
		{
		    case 'text':
			if (is_array($data[$k]))
			{
			    //print_r($data[$k]['type']);
			    if (isset($data[$k]['type'])and ( $data[$k]['type'] == 'imglist'))
			    {
				if (isset($data[$k]['selected'])):
				    $out .= $this->imgselect("f$c", $v->label, $k, $data[$k], $data[$k]['selected']);
				else:
				    $out .= $this->imgselect("f$c", $v->label, $k, $data[$k]);
				endif;
			    }
			    else
			    {
				$out .= $this->select("f$c", $v->label, $k, $data[$k]);
			    }
			}
			else
			{
			    if ($v->label != ''):
				if ($k == 'image')
				{
				    $out .= $this->input("f$c", $v->label, 'file', $k,'',$data[$k]);
				}
				else
				{
				    $out .= $this->input("f$c", $v->label, $type, $k, '', htmlspecialchars($data[$k]));
				}
			    else:
				$out .= $this->input("f$c", $v->label, 'hidden', $k, '', $data[$k]);
			    endif;
			}
			break;
		    case 'textarea':
			$out .= $this->EditorTextarea($v->label, $k, $data[$k]);
			break;

		    case 'datetime-local':
			//$out.=$data[$k];
			$out	 .= $this->input("f$c", $v->label, 'date', $k, 'yyyy-mm-dd', $data[$k]);
			break;
		    case 'now':
			$out	 .= $this->input("f$c", $v->label, 'date', $k, 'yyyy-mm-dd', $data[$k]);
			break;
		    case 'enum':

			if ($data[$k] == 'Y')
			{
			    $status = "checked='checked'";
			}
			else
			{
			    $status = "";
			}
			$out .= $this->checkbox("f$c", $v->label, $k, $status);
			break;
		}
		$c++;
	    }
	}
	return $out;
    }

    public
	    function input($id, $label, $type, $name, $placeholder = '', $val = '') {
	$value	 = ($val == '') ? '' : 'value="' . $val . '"';
	$ps	 = ($placeholder == '') ? '' : $placeholder;
	$ap	 = '';
	if ($type == 'file')
	{
	    $ap = '<div id="image-holder">'
		    . '<img src="'.WWW_IMAGE_PATH.$val.'" class="thumb-image">'
		    . '</div>';
	}
	return '<div class="form-group row">
      <label class="control-label col-4" for="' . $id . '">' . $label . ' </label>
      <div class="col-12">
      <input type="' . $type . '" class="form-control" id="' . $id . '" placeholder="' . $placeholder . '"  name="' . $name . '" ' . $value . '>
    </div>
    </div>' . $ap;
    }

    public
	    function checkbox($id, $label, $name, $status = '') {
	//$status='checked'
	return '<div class="form-group">
                 <div class="checkbox-inline">
                  <label><input  id="' . $id . '" type="checkbox" name="' . $name . '" ' . $status . '> ' . $label . '</label>
                 </div>
                </div>';
    }

    public
	    function EditorTextarea($label, $name, $tekst, $rows = 28) {
	return "<label>$label</label>
    <textarea rows='$rows' class='editor' style='display:none' name='$name'>$tekst</textarea>";
    }

    public
	    function Textarea($label, $name, $tekst, $rows = 10) {
	return "<label>$label</label>
    <textarea rows='$rows' style='width:100%' name='$name'>$tekst</textarea>";
    }

    public
	    function imagefile($label, $name, $value, $deg = 50) {
	$img = ($value == '') ? 'https://via.placeholder.com/300?text=no+image' : $value;
	return "<label for='img-btn'>$label</label><div class='form-control'>
    <input id='$name' class='form-control' type='hidden' name='$name' value='$img'/>
    <img id='preview-$name' src='$img' style='width:$deg%'><br>
    <button class='btn imgselect' data-target='$name'>Выбрать/Загрузить</button><br>
</div>";
    }

    public
	    function radio($id, $label, $name, $value, $status = '') {
	return '
                <label class="btn btn-default" for="' . $id . '">' . $label . '</label> 
                    <input type="radio" class="custom-control custom-radio custom-control-inline" ' . $status . ' id="' . $id . '" name="' . $name . '" value="' . $value . '" > 
                
  
';
    }

    public
	    function select($id, $label, $name, $value, $selected = '') {
	$options = '<option value="">выберите из списка</option>';
	foreach ($value as $v)
	{
	    if ($v['value'] = $v['name']):
		$options .= '<option value="' . $v['value'] . '">' . $v['name'] . '</option>';
	    else:
		$options .= '<option>' . $v['name'] . '</option>';
	    endif;
	}
	return '<label class="btn btn-default" for="' . $id . '">' . $label . '</label> '
		. '<select class="custom-select" id="' . $id . '" name="' . $name . '">' . $options . '</select>';
    }

    public
	    function imgselect($id, $label, $name, $value, $selected = '') {
	$options = '<option value="">выберите из списка</option>';
	unset($value['type']);
	unset($value['selected']);
	foreach ($value as $v)
	{
	    if($v['name']==$selected){$ss=" selected='selected' ";}else{$ss='';}
	    $options .= '<option '.$ss.' title="'. $v['name'] 
		    . '" data-content="<img style=\'width:23px\' src=' . WWW_IMAGE_PATH . 'gradients/' . $v['image'] . '>' . $v['name'] . '"'
		    . ' value="' . $v['name'] . '">' . $v['name'] . '</option>';
	}
	return '<label class="btn btn-default" for="' . $id . '">' . $label . '</label> '
		. '<select data-width="auto" class="selectpicker" id="' . $id . '" name="' . $name . '">' . $options . '</select></br>';
    }

}




