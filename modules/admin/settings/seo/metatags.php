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
$list->set_ignore(array("javascript:", "#", "malito:", "tg:", "tel:", "viber:", "skype:", ".css", ".js", ".ico", ".jpg", ".png", ".jpeg", ".swf", ".gif", "curse/"));
$list->get_links(WWW_BASE_PATH);

$real	 = $list->get_array();
$real	 = array_pad($real, -1, WWW_BASE_PATH);
$realz	 = array();

foreach ($real as $ur)
{
    $ned	 = array('#http://#', '#https://#');
    $ned1	 = array('#http://#', '#https://#', '#/#');
    $ra	 = array_filter(preg_split("#/#", preg_replace($ned, '', $ur)));
    $va	 = array_reverse($ra);
    if ($va[0] == 'curses')
    {
	$va[1] = preg_replace($ned, '', WWW_BASE_PATH);
    }
    $jdat[] = "['" . $va[0] . "', '" . @$va[1] . "','" . $ur . "']";
}
$jdat[] = "['curses', '" . preg_replace($ned1, '', WWW_BASE_PATH) . "','" . WWW_BASE_PATH . "curses']";


$r	 = ",
";
$jdat	 = implode($r, $jdat);

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
