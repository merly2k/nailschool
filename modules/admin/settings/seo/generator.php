<?php
set_time_limit(0);
$brouse	 = '';
$lsize	 = '';
$sitemap = new seo\sitemap();
    
//игнорировать ссылки с расширениями:
$sitemap->set_ignore(array("javascript:", "#", "malito:", "tg:", "tel:", "viber:", "skype:", ".css", ".js", ".ico", ".jpg", ".png", ".jpeg", ".swf", ".svf", ".gif"));
//ссылка Вашего сайта:
$sitemap->get_links(WWW_BASE_PATH);

$art=$sitemap->generate_sitemap();

$map	 = $art;

$fp	 = APP_PATH . "/sitemap.xml";
echo 'save sitemap...';
file_put_contents($fp, $map);
echo "done!";
echo "<script>document.location.replace('" . WWW_ADMIN_PATH . "settings/seo');</script>";
?>
