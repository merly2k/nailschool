<?php
$otherTown='';
if(isset($_SESSION['lang'])){
$lang=mb_strtolower(@$_SESSION['lang']);
}else{$lang="ua";}
$tpl="kurses";
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
$randAction='';
$townItem='';
$video='';
$fidOut='';
$tfut='';
$aza='';
$acsia='';
$curMistoLink=$link;
$otherTown.='<a class="dropdown-item" href="'.WWW_BASE_PATH.'curses/'.$r->link.'/">'.$r->$mlang.'</a>';
$item='';                        
}

	    foreach ($curses->getALL($curMistoLink) as $curs){
		//print_r($curs);
		$name='name_'.$lang;
		$anonce='anonce_'.$lang;
    $item.='<a class="course__item" href="'.WWW_BASE_PATH.'curses/curse/'.$curMistoLink.'/'.$curs->link.'">
                    <div>
			<h2 class="course__headline"><strong>'.$curs->$name.'</strong></h2>
                        <p class="course__title">'.$curs->$anonce.'</p>
                    </div>
                    <div class="course__price">
							<div class="course__price__price">
								<strong>'.$curs->coast.'</strong> грн <div class="pod"></div></div>
                        <span class="course__price__day">
								<strong>'.$curs->finish.'</strong> дней</span>
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
						Стоимость всех пакетов по отдельности:</span>
                        <span>
                        <strong class="alone-price_delete">'.$totalcoast.'</strong>грн
                    </span>
                    </p>
                </div>
                <div class="package-price">
                    <p class="package-price__title">
                        Стоимость пакета с учетом скидки: </p>
                    <div class="package-price__price"><strong>'.$k->coast.'</strong>грн</div>
                    <div class="package-price__price">
                        <strong>
                            ЭКОНОМИЯ </strong>
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
