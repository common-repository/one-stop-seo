<div class="wrap">
<h1>One Stop SEO</h1></div>

<h2>1- List of All Available URLs</h2>
<ol>
<?php 

$ossm_list_of_urls = ossm_print_all_urls();
foreach($ossm_list_of_urls as $ossm_url){
echo '<li>'.esc_url($ossm_url).'</li>';
}
?>
</ol>

<h2>2- Sitemap Status</h2>
<p><?php echo esc_html(ossm_check_sitemap_status(OSSM_SITE_URL));?></p>
<h2>3- Robots Status</h2>
<p><?php echo esc_html(ossm_check_robots_status(OSSM_SITE_URL));?></p>
<h2>4- Canonicalization Status</h2>
<?php 
$ossm_status_result = ossm_check_url_canonicalization(OSSM_SITE_URL);
          
          echo '<ol><li>' . esc_html($ossm_status_result[0]) . '</li>';
	      echo '<li>' . esc_html($ossm_status_result[1]) . '</li>';
	      echo '<li>' .esc_html($ossm_status_result[2]) . '</li>';
	      echo '<li>' . esc_html($ossm_status_result[3]) . '</li></ol>';

?>