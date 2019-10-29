<!DOCTYPE html>
<html lang="en">

    <head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="description" content="">
	<meta name="author" content="">
	<title>invoise</title>
	<!-- Bootstrap core CSS-->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
	<!-- Custom fonts for this template-->
	<link href="<?= WWW_BASE_PATH ?>fonts/fontawesome/css/fontawesome-all.min.css" type="text/css" rel="stylesheet">
	<!-- Custom styles for this template-->

    </head>
    <body>
	<div id="2pdf" class="container">
	    <div class="row">
		<div class="col-1">
		    <img src="<?= WWW_IMG_PATH ?>logo-white.jpg" class="image img-fluid">
		</div>
		<div><h2>Вебмагазин Лисичка.</h2><h3> Украшения и акссесуары ручной работы</h3></div>
	    </div>
	    <?php
	    error_reporting(0);
//print_r($_POST);
	    $order	 = new model\orders();
	    $toc	 = new model\tovar();
//$orderid='';

	    extract($_POST);
	    $ordung	 = join(',', $orderid);
//save order
	    $params	 = array(
		"login"		 => "$login",
		"password"	 => "$password",
		"address"	 => "$address",
		"order_ids"	 => "$ordung"
	    );
	    //print_r($params);
	    $lid	 = $order->SaveOrder($params);
	    
// render output
	    $out	 = '<div class="row">'
		    . '<div class="col-6">'
		    . '<strong>Заказ №</strong>' . $lid . "</div>"
		    . '<div class="col-6">'
		    . '<strong>от:</strong>' . date('d-M-Y') . "</div>"
		    . "</div>"
		    . '<table id="countit" class="table table-bordered">'
		    . '<caption>http://lisi4ka.com.ua</caption>'
		    . '<tr>'
		    . '<th>товар</th>'
		    . '<th>цена за ед.</th>'
		    . '</tr>';
	    foreach ($orderid as $v)
	    {
		$zakaz	 = $toc->SelectById($v);
		$z	 = $zakaz[0];
		$out	 .= "<tr><td>$z->name </td><td class='count-me'>$z->price</td></tr>";
	    }
	    $out .= '     <script language="javascript" type="text/javascript">
            var tds = document.getElementById("countit").getElementsByTagName("td");
            var sum = 0;
            for(var i = 0; i < tds.length; i ++) {
                if(tds[i].className == "count-me") {
                    sum += isNaN(tds[i].innerHTML) ? 0 : parseInt(tds[i].innerHTML);
                }
            }
            document.getElementById("countit").innerHTML += "<tr><th>К оплате</th><td>" + sum + "</td></tr>";
        </script>';
	    echo $out . '</table>';
	    ?>
	    Ващ заказ поступит менеджеру в течении 15 минут. после єтого с вами свяжутся для уточнения деталей заказа
	</div>
	<div class="container" class="my-cart">
	<!--button class="btn btn-outline-success"  onclick="savef()"><i class="fa fa-save"></i> зберегти рахунок</button-->
	    <button class="btn btn-outline-success" id="save_image" onclick="savejpg()"><i class="fa fa-image"></i> save check</button>
	    <a href="<?=WWW_BASE_PATH?>" class="btn btn-outline-info" id="return"><i class="fa fa-upload"></i> Вернуться на сайт</a>
	</div>
    </body>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <script src="https://unpkg.com/jspdf@latest/dist/jspdf.min.js"></script>
    <script src="<?= WWW_JS_PATH; ?>html2canvas.min.js"></script>
    <script type='text/javascript' src="<?=WWW_JS_PATH?>jquery.mycart.js"></script>
    <script>

                function savef() {
                    const filename = 'rahunok_<?= $lid; ?>.pdf';
                    var elem = $('#2pdf').get(0);

                    html2canvas(elem).then(canvas => {
                        let pdf = new jsPDF('p', 'mm', 'a4');
                        pdf.addImage(canvas.toDataURL('image/png'), 'PNG', 0, 0, 211, 100);
                        pdf.save(filename);
                    });
                }
                ;

                function savejpg() {
                    var elem = $('#2pdf').get(0);
                    html2canvas(elem).then(canvas => {
                        //console.log(canvas);
                        saveAs(canvas.toDataURL(), 'rahunok_<?= $lid; ?>.png');
                    });

                }
                ;

                function saveAs(uri, filename) {

                    var link = document.createElement('a');

                    if (typeof link.download === 'string') {

                        link.href = uri;
                        link.download = filename;
                        //Firefox requires the link to be in the body
                        document.body.appendChild(link);
                        //simulate click
                        link.click();
                        //remove the link when done
                        document.body.removeChild(link);
                    } else {

                        window.open(uri);

                    }
                }
var options = {
      currencySymbol: '$',
      classCartIcon: 'my-cart-icon',
      classCartBadge: 'my-cart-badge',
      classProductQuantity: 'my-product-quantity',
      classProductRemove: 'my-product-remove',
      classCheckoutCart: 'my-cart-checkout',
      affixCartIcon: true,
      showCheckoutModal: true,
      numberOfDecimals: 2,
      cartItems: []
};
$(function () {
         $(".my-cart").myCart(options);
     });
    </script>
</html>
