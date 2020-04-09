<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of bildfaqo
 *
 * @author merly
 */
class bildfaqo {

    function getFAQO($misto, $lang) {
	$d	 = new model\faqo();
	$out	 = '';
	foreach ($d->getAll($misto) as $k => $qa)
	{
	    if ($k != 0)
	    {
		$collapse = "N";
	    }
	    else
	    {
		$collapse = "Y";
	    }
	    $qwestion	 = $qa->{'question_' . $lang};
	    $ansver		 = $qa->{'ansver_' . $lang};
	    $out		 .= $this->render($qa->id, $qwestion, $ansver, $collapse);
	}
	return $out;
    }

    function render($id, $qwestion, $ansver, $collapse = 'Y') {
	if ($collapse == 'Y')
	{
	    $collapsed	 = 'collapsed';
	    $aria		 = "true";
	    $show		 = 'show';
	}
	else
	{
	    $collapsed	 = '';
	    $aria		 = "false";
	    $show		 = '';
	}
	$q = '<div class="card">
	<div id="heading' . $id . '" class="card-header">
	<h5 class="mb-0">
	<button class="btn btn-link ' . $collapsed . '" data-toggle="collapse" data-target="#collapse' . $id . '" aria-expanded="' . $aria . '" aria-controls="collapse' . $id . '">
	' . htmlspecialchars_decode($qwestion) . '
	</button>
	</h5>
	</div>
	    <div id="collapse' . $id . '" class="collapse ' . $show . '" aria-labelledby="heading' . $id . '" data-parent="#accordion" style="">
		<div class="card-body">' . htmlspecialchars_decode($ansver) . '
		</div>
	    </div>
	</div>';
	return $q;
    }

}

