<?php
$otherTown='';
if(isset($_SESSION['lang'])){
$lang=mb_strtolower(@$_SESSION['lang']);
}else{$lang="ua";}
$tpl="courses";
$link=$this->param[0];
$km=new model\misto();
$currentMisto=($km->getByName($link));
$mlang='name_'.$lang;
$curses=new model\curses();
$packs= new model\packets();
$bc['ua']='Курси у ';
$bc['ru']='Курсы в ';
$vidminnik= array('ua'=> array(
'dnipro'=>'Дніпрі',    
'kyiv'=>'Київі',    
'zaporizhzhya'=>'Запоріжжї',    
'nicolaev'=>'Миколаєві',    
),
'ru'=> array(
'dnipro'=>'Днепре',    
'kyiv'=>'Киеве',    
'zaporizhzhya'=>'Запорожье',    
'nicolaev'=>'Николаеве',       
)
    );
foreach ($km->getall($link)as $r){
    //print_r($r);

$curMistoLink=$link;
$otherTown.='<li><a class="" href="'.WWW_BASE_PATH.'curses/'.$r->link.'/">'.$r->$mlang.'</a></li>';
$item='';                        
}

$misto='<a id="choseCity" class="dropdown-toggle chose-city__current">'
                       .$currentMisto->$mlang.'
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="choseCity">'
                     .$otherTown
                    .'</ul>';
	    foreach ($curses->getALL($curMistoLink) as $curs){
		//print_r($curs);
		$name='name_'.$lang;
		$anonce='anonce_'.$lang;
		if ($lang=='ua')
		{
		$ddey=numberof($curs->finish, ' д', array('ень', 'ні', 'нів'))    ;
		}
		else
		{
		$ddey=numberof($curs->finish, ' д', array('ень', 'ня', 'ней'))    ;
		}
		if($curs->ac_coast>0){$price=$curs->ac_coast;}else{$price=$curs->coast;}
    $item.='<a class="course__item" href="'.WWW_BASE_PATH.'curses/curse/'.$curMistoLink.'/'.$curs->link.'">
                    <div>
			<h2 class="course__headline"><strong>'.$curs->$name.'</strong></h2>
                        <p class="course__title">'.$curs->$anonce.'</p>
                    </div>
                    <div class="course__price">
							<div class="course__price__price">
								<strong>'.$price.'</strong> грн <div class="pod"></div></div>
                        <span class="course__price__day">
								<strong>'.$curs->finish.'</strong>'.$ddey.'</span>
                    </div>
                </a>';
}

$packets='';
$packets=' <section class="course-package-outer">
<h2 class="section-title">'.l('z4').'</h2>';
foreach ($packs->getPackets($link) as $k){
    //print_r($k);
    $kcount=0;
    $kurses=new model\curses();
    $cursesblosk='';
    $totalcoast=0;
    for ($index = 1; $index < 7; $index++)
    {
    $kurs='kurs'.$index.'_id';
	if($k->$kurs!=0){
	    $r=$kurses->getCurseById($k->$kurs);
	    //print_r($r[0]);
	    //echo"<br>";
	    //$rr=$r[0];
	    $cursesblosk.='<li class="course-package-list__item">
                        <span class="course-package-list__name">
                          <strong>'.$r->$mlang.'</strong></span>
                            <span class="course-package-list__price">
                          <strong>'.$r->coast.'</strong> грн</span>
                        </li>';
	    $totalcoast+=$r->coast;
	    $kcount++;
	}
    }
    $econ=($lang=='ua')? 'ЕКОНОМІЯ' : 'ЭКОНОМИЯ';
    $vcon=($lang=='ua')? 'Вартість з урахуванням знижки' : 'Стоимость пакета с учетом скидки';
    $dcon=($lang=='ua')? 'Вартість всіх пакетів окремо' : 'Стоимость всех пакетов по отдельности';
    
    
$filename=WWW_BASE_PATH."svggen/$kcount/$k->dayz/$lang";
$svgimg=file_get_contents($filename);
$packets.='<div class="container">
            <div class="course-package">
                
		<div class="svg-container">'.$svgimg.'</div>    
                <div class="course-package_mid">
                    <ul class="course-package-list">
                        <li class="course-package__headline">«'.$k->$name.'»</li>'
                        .$cursesblosk.'
                    </ul>
                    <p class="alone-price">
                    <span>
						'.$dcon.':</span>
                        <span>
                        <strong class="alone-price_delete">'.$totalcoast.'</strong>грн
                    </span>
                    </p>
                </div>
                <div class="package-price">
                    <p class="package-price__title">
                        '.$vcon.': </p>
                    <div class="package-price__price"><strong>'.$k->coast.'</strong>грн</div>
                    <div class="package-price__price">
                        <strong>'.$econ.'
                        </strong>
                        <span class="package-price__price_alert">
                        <strong>'.($totalcoast-$k->coast).'</strong>грн
                    </span>
                    </div>
                    <a class="sale__btn" href="'.WWW_BASE_PATH.'pakets/'.$link.'/'.$k->id.'">
                        '.l('z3').' </a>
                </div>
            </div>
';
}
    $packets.='</section>';
$cc=$bc[$lang].$vidminnik[$lang][$link];


include TEMPLATE_DIR . DS . $tpl . ".html";
