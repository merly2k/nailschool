<?php
$template ="starter-page-order"; //uncomment this string if not use default template
$lang	 = mb_strtolower(@$_SESSION['lang']);
$context = '';
$catMnu	 = '';
$gr	 = '';
$ttr	 = new \model\translation();
$spmenu	 = new spmenu();
$menu	 = $spmenu->render($lang);
//print_r($_POST);
$context='';
$tgreed='';
$total=0;
$tovars=0;
$orderfield='';
foreach ($_POST as $row){
extract($row);
$orderfield.="<input type='hidden' name='orderid[]' value='$id' />";
$total=$total+$price;
$tovars++;
$tgreed.='<tr>
	<td>
<figure class="media">
	<div class="img-wrap"><img src="'.$image.'" class="img-thumbnail img-sm"></div>
	<figcaption class="media-body">
		<h6 class="title text-truncate">'.$name.'</h6>
		
	</figcaption>
</figure> 
	</td>
	<td> 
	'.$quantity.'
	</td>
	<td> 
		<div class="price-wrap"> 
			<var class="price">'.$price.'</var> 
		</div> <!-- price-wrap .// -->
	</td>
	
</tr>';
}

include TEMPLATE_DIR . DS . $template . ".html";
