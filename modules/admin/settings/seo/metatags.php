<?php

ini_set("max_execution_time", 0);
$tpl		 = 'admin';
$context	 = '';
$nt		 = '';
$toc		 = '';
$brouse		 = '';
$lsize		 = '';
$mod_name	 = "SEO/Метатеги сайта по страницам";
$tags		 = new model\seobase();
$list		 = new seo\sitemap();
//$list->get_links(WWW_BASE_PATH);
$list->set_ignore(array("javascript:", "#", "malito:", "tg:", "tel:", "viber:", "skype:", ".css", ".js", ".ico", ".jpg", ".png", ".jpeg", ".swf", ".gif"));
$list->get_links(WWW_BASE_PATH);
//$list->set_ignore(array("javascript:", "malito:","(#*.)","chat", "tel:", "viber:", "skype:", ".css", ".js", ".ico", ".jpg", ".png", ".jpeg", ".swf", ".gif"));
$real		 = $list->get_array();
$realz		 = array();
foreach ($real as $ur)
{

    $ra	 = preg_split("#/#", $ur);
    $va	 = array_reverse(array_splice($ra, 2));
    $f	 = count($va);
    for ($a = $f; $a >= 0; $a--)
    {
	if (isset($va[$a]) and @ $va[$a] != '')
	{

	    $realz[$va[$a]] = "['" . @$va[$a] . "', '" . @$va[$a + 1] . "','" . $ur . "']";
	    //array('cur'=>@$va[$a],'par'=>@$va[$a+1]);
	}
    }
}
//$realz['valet.merlinsoft.pp.ua']=["valet.merlinsoft.pp.ua", '',WWW_BASE_PATH];
//  print_r($realz);

$jdat = (implode(',', $realz));
//$jdat= $realz;
//echo $jdat;
$context .= "<div id='chart_div' style='overflow: auto;'></div>"
	. "<div id='form_div'></div>"
	. "</div>"
	. "
<script type=\"text/javascript\" src=\"https://www.gstatic.com/charts/loader.js\"></script>

<script>
google.charts.load('current', {packages:[\"orgchart\"]});
google.setOnLoadCallback(drawChart);

function drawChart() {
    var data = new google.visualization.DataTable();
    data.addColumn('string', 'Name');
    data.addColumn('string', 'Manager');
    data.addColumn('string', 'ToolTip');
    data.addRows([
         $jdat
    ]);

        // Create the chart.
    var chart = new google.visualization.OrgChart(document.getElementById('chart_div'));

    var runonce = google.visualization.events.addListener(chart, 'ready', function() {
        // set up + sign event handlers
        var previous;
        $('#chart_div').on('click', 'td.google-visualization-orgchart-node', function () {
            var selection = chart.getSelection();

            var row;
            if (selection.length == 0) {
                row = previous;
            }
            else {
                row = selection[0].row;
                previous = row;
            }
            var turl='" . WWW_ADMIN_PATH . "'+'settings/seo/former/'+sanitizeUrl(this.title);
            updateElement('#form_div',turl);
        });

        google.visualization.events.removeListener(runonce);

        // collapse all nodes
    });

    chart.draw(data, {
        allowHtml: true
    });
}


</script>


      ";
include TEMPLATE_DIR . DS . $tpl . ".html";
