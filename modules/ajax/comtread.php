<?php
$coment=new model\comments();
$latest=$coment->getLatest(6);
$out='';
foreach($latest as $bid){
    //print_r($bid);
    $ago= time_elapsed_string($bid->dt,1);
    $out.='<li>
<div class="container">
    <div class="panel panel-default">
        <div class="panel-heading">
            <strong>'.$bid->name.'</strong>'
            . '<span class="text-muted">написал(а) в '.$bid->page.'<br> '.$ago.'</span>
        </div>
        <div class="panel-body">
        <span class="btn btn-primary btn-circle"><i class="ti-user"></i></span>
        '.$bid->body.'
        </div><!-- /panel-body -->
        <div class="panel-footer">
        <span class="btn-toolbar" role="toolbar" aria-label="Toolbar with button groups">
        <a class="btn btn-light" href="'.WWW_ADMIN_PATH.'moderation/editid/'.$bid->id.'"><i class="fa fa-edit"></i></a>
        <a class="btn btn-light" href="'.WWW_ADMIN_PATH.'moderation/del/'.$bid->id.'"><i class="fa fa-trash-o"></i></a>
            </span>
        </div>
    </div><!-- /panel panel-default -->
</div>                                            
</li>
';
}
echo $out;

function time_elapsed_string($datetime, $full = false) {
    $now = new DateTime;
    $ago = new DateTime($datetime);
    $diff = $now->diff($ago);

    $diff->w = floor($diff->d / 7);
    $diff->d -= $diff->w * 7;

    $string = array(
        'y' => 'год',
        'm' => 'мес.',
        'w' => 'нед.',
        'd' => 'дн.',
        'h' => 'ч'
        
    );
    foreach ($string as $k => &$v) {
        if ($diff->$k) {
            $v = $diff->$k . ' ' . $v . ($diff->$k > 1 ? 's' : '');
        } else {
            unset($string[$k]);
        }
    }

    if (!$full) $string = array_slice($string, 0, 1);
    return $string ? implode(', ', $string) . ' ago' : 'just now';
}