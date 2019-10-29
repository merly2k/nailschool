<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace model;

/**
 * Description of grid
 *
 * @author merly
 */
class grid extends \db {
        
    
    
public
 function getTovar($param,$filter='') {
    
}

public	function render($param) {
    $t=new \model\tovar();
    
    $out='';
    foreach ($t->getAll() as $row)
    {
	$out.='<div class="card"> 
<article class="itemlist">
	<div class="row row-sm">
		<aside class="col-sm-3">
			<div class="img-wrap"><img src="images/tovar/{{IMG}}" class="img-md"></div>
		</aside> <!-- col.// -->
		<div class="col-sm-6">
			<div class="text-wrap">
				<h4 class="title"> Ut wisi enim ad minim veniam  </h4>
				<p> Lorem ipsum dolor sit amet, consectetuer adipiscing elit, Lorem ipsum dolor sit amet, consectetuer adipiscing elit, Ut wisi enim ad minim veniam </p>
				<p class="rating-wrap my-0 text-muted">
					<span class="label-rating">132 reviews</span>
					<span class="label-rating">154 orders </span>
				</p> <!-- rating-wrap.// -->
			</div> <!-- text-wrap.// -->
		</div> <!-- col.// -->
		<aside class="col-sm-3">
			<div class="border-left pl-3">
				<div class="price-wrap">
					<span class="h3 price"> $56 </span><del class="price-old"> $98</del>
				</div> <!-- info-price-detail // -->
				<p class="text-success">Free shipping</p>
				<p> 
				<a href="#" class="btn btn-warning"> Buy now </a>
				<a href="#" class="btn btn-light"> Details  </a> </p>
			</div> <!-- action-wrap.// -->
		</aside> <!-- col.// -->
	</div> <!-- row.// -->
</article> <!-- itemlist.// -->

<article class="itemlist">
	<div class="row row-sm">
		<aside class="col-sm-3">
			<div class="img-wrap"><img src="images/items/2.jpg" class="img-md"></div>
		</aside> <!-- col.// -->
		<div class="col-sm-6">
			<div class="text-wrap">
				<h4 class="title"> Here goes heading of product  </h4>
				<p> Lorem ipsum dolor sit amet, consectetuer adipiscing elit, Lorem ipsum dolor sit amet, consectetuer adipiscing elit, Ut wisi enim ad minim veniam </p>
				<p class="rating-wrap my-0 text-muted">
					<span class="label-rating">132 reviews</span>
					<span class="label-rating">154 orders </span>
				</p> <!-- rating-wrap.// -->
			</div> <!-- text-wrap.// -->
		</div> <!-- col.// -->
		<aside class="col-sm-3">
			<div class="border-left pl-3">
				<div class="price-wrap">
					<span class="h3 price"> $56 </span> <del class="price-old"> $98</del>
				</div> <!-- info-price-detail // -->
				<p class="text-success">Free shipping</p>
				<p>
					<a href="#" class="btn btn-warning"> Buy now </a>
					<a href="#" class="btn btn-light"> Details  </a>
				</p>
			</div> <!-- action-wrap.// -->
		</aside> <!-- col.// -->
	</div> <!-- row.// -->
</article> <!-- itemlist.// -->
</div> <!-- card.// -->';
    }
}
    
}
