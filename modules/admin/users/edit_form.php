<?php
function buildParent($name,$optionsArray) {
        $op="<select name='$name' onChange='updateElement('span#$name',urls)'>";
        $op.="<option selected='selected'>выберите значение</option>";
        foreach ($array as $key=>$value) {
            if(!empty($value)){
            $op.="<option value='$value'>$key</option>";
            } else {
            $op.="<option value='$key'>$key</option>";
            }
        }
        $op.="</select><span id='$name'></span>";
        return $op;
    }
?>
