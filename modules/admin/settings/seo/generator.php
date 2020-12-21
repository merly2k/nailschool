<?php
set_time_limit(0);
$brouse	 = '';
$lsize	 = '';
$sitemap = new seo\sitemap();
if(!$_POST){
    echo "new sitemap generation";
    $sitemap->set_ignore(array("javascript:", "#", "malito:", "tg:", "tel:", "viber:", "skype:", ".css", ".js", ".ico", ".jpg", ".png", ".jpeg", ".swf", ".svf", ".gif"));
    $sitemap->get_links(WWW_BASE_PATH);
    print_r($sitemap);
    $arr	 = $sitemap->get_array();
    
    foreach ($arr as $vl) {
        print_r($vl);
    }
}elseif ($_POST['action']) {
    
}else{
//игнорировать ссылки с расширениями:
$sitemap->set_ignore(array("javascript:", "#", "malito:", "tg:", "tel:", "viber:", "skype:", ".css", ".js", ".ico", ".jpg", ".png", ".jpeg", ".swf", ".svf", ".gif"));
//ссылка Вашего сайта:
$sitemap->get_links(WWW_BASE_PATH);
//если нужно вернуть просто массив с данными:
$arr	 = $sitemap->get_array();
//echo "<pre>";
//print_r($arr);
//echo "</pre>";
//header ("content-type: text/xml");
define("FREQUENCY", "weekly");
define("PRIORITY", "0.5");
//$map = $sitemap->generate_sitemap();
$map	 = "<?xml version=\"1.0\" encoding=\"UTF-8\"?>\n"
	. "<?xml-stylesheet type='text/xsl' href='sitemap.xsl'?>"
	. "<!-- Created with MerlinSoft Sitemap Generator v1.0 -->\n"
	. "<!-- Date: " . date("Y-m-d H:i:s") . " -->\n"
	. "<urlset xmlns=\"http://www.sitemaps.org/schemas/sitemap/0.9\"\n"
	. "        xmlns:xsi=\"http://www.w3.org/2001/XMLSchema-instance\"\n"
	. "        xsi:schemaLocation=\"http://www.sitemaps.org/schemas/sitemap/0.9\n"
	. "        http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd\">\n"
	. "  <url>\n"
	. "    <loc>" . WWW_BASE_PATH . "</loc>\n"
	. "    <changefreq>weekly</changefreq>\n"
	. "  </url>\n";
foreach ($arr as $i)
{
    $next_url	 = $i;
    $map		 .= "  <url>\n" .
	    "    <loc>" . htmlentities(rtrim(@$next_url, '/')) . "</loc>\n" .
	    "    <changefreq>" . FREQUENCY . "</changefreq>\n" .
	    "    <priority>" . PRIORITY . "</priority>\n" .
	    "    <lastmod>" . date("Y-m-d") . "</lastmod>\n" .
	    "    <changefreq>weekly</changefreq>\n" .
	    "  </url>\n";
}
$map	 .= '</urlset>';
$fp	 = APP_PATH . "/sitemap.xml";
echo 'save sitemap...';
//file_put_contents($fp, $map);
echo "done!";
echo "<script>document.location.replace('" . WWW_ADMIN_PATH . "settings/seo');</script>";
}
?>
