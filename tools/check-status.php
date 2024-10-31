<div class="wrap">
<h1>Website's Health Checkup</h1></div>

<?php 
/**
* @version 2.3.0
  One Stop SEO
*/
settings_fields( 'ossm_options_check' );
do_settings_sections( 'ossm_options_check' );

// Sitemap
$ossm_sitemapvalue = ossm_check_sitemap_status(OSSM_SITE_URL);
$ossm_sitemap = explode(',',$ossm_sitemapvalue);

// Robots
$ossm_robotsvalue = ossm_check_robots_status(OSSM_SITE_URL);
$ossm_robots = explode(',',$ossm_robotsvalue);

// Canonicalizaiton
$ossm_status_result;
if(empty(get_option('ossm_site_canonicalization')) || isset($_POST['checkstatus'])){
    $ossm_status_result = ossm_check_url_canonicalization(OSSM_SITE_URL);
    update_option('ossm_site_canonicalization',$ossm_status_result);
}else{
    $ossm_status_result = get_option('ossm_site_canonicalization');
}
$ossm_status = explode(',',$ossm_status_result);

// Speed Score
$ossm_speedscore;
if(empty(get_option('ossm_speed_score'))  || isset($_POST['checkscore'])){
$ossm_speedscore = ossm_get_page_speed_score(OSSM_SITE_URL);
update_option('ossm_speed_score',$ossm_speedscore);
}else{
    $ossm_speedscore = get_option('ossm_speed_score');
}
$ossm_speedscore_all = explode(',',$ossm_speedscore);


// Domain Authority

$ossm_da_data;
if(empty(get_option('ossm_da_pa'))  || isset($_POST['checkda'])){
$ossm_da_data = ossm_fetch_da(OSSM_SITE_URL);
update_option('ossm_da_pa',$ossm_da_data);    
}
else{
    $ossm_da_data = get_option('ossm_da_pa');
   
}
$ossm_domain_da_pa = explode(',',$ossm_da_data); 

?>

<table class="styled-table" id="table">
<thead><td>Service</td><td>Status</td><td>Link</td><td>Date Checked</td><td>Recheck</td><!--td>Re-Check</td--></thead>
    <tbody>
        <tr>
            <td rowspan="3">Moz DA/PA</td>
            
            <tr><td>Domain Authority</td><td><span class="container" style="display:inline-block;"><span class="skill" style="width:<?php echo esc_html($ossm_domain_da_pa[0])?>%;display:inline-block;"><?php echo esc_html($ossm_domain_da_pa[0])?></span></span></td>
            <td rowspan="2"><?php echo esc_html($ossm_domain_da_pa[2])?></td>
            <td rowspan="2"><form method="post"><input type="submit" name="checkda" value="Check"></form></td>
            </tr>
            <tr><td>Page Authority</td><td><span class="container" style="display:inline-block;"><span class="skill" style="width:<?php echo esc_html($ossm_domain_da_pa[1])?>%;display:inline-block;"><?php echo esc_html($ossm_domain_da_pa[1])?></span></span></td></tr>
            
        </tr>
        <tr>
            <td rowspan="3">Speed Score</td>
            <tr><td>Desktop Score</td><td><?php echo esc_html($ossm_speedscore_all[0])?></td>
            <td rowspan="2"><?php echo esc_html($ossm_speedscore_all[2])?></td>
            <td rowspan="2"><form method="post"><input type="submit" name="checkscore" value="Check"></form></td>
            </tr>
            <tr><td>Mobile Score</td><td><?php echo esc_html($ossm_speedscore_all[1])?></td></tr>
        </tr>
        <tr>
            <td rowspan="5">Canonicalization</td>
            <tr><td><?php echo esc_html($ossm_status[1]);?></td><td><?php echo esc_html($ossm_status[0]);?></td>
            <td rowspan="4"><?php echo esc_html($ossm_status[8]);?></td>
            <td rowspan="4"><form method="post"><input type="submit" name="checkstatus" value="Check"></form></td>
            </tr>
            <tr><td><?php echo esc_html($ossm_status[3]);?></td><td><?php echo esc_html($ossm_status[2]);?></td></tr>
            <tr><td><?php echo esc_html($ossm_status[5]);?></td><td><?php echo esc_html($ossm_status[4]);?></td></tr>
            <tr><td><?php echo esc_html($ossm_status[7]);?></td><td><?php echo esc_html($ossm_status[6]);?></td></tr>
            
        </tr>
         <tr>
            <td>Robots.txt</td>
            <td><?php echo esc_html($ossm_robots[0])?></td>
            <td><?php echo esc_html($ossm_robots[1])?></td>
        </tr>
        <tr>
            <td>Sitemap.xml</td>
            <td><?php echo esc_html($ossm_sitemap[0])?></td>
            <td><?php echo esc_html($ossm_sitemap[1])?></td>
            <!--td><input id="recheck" type="button" value="Recheck Sitemap" onclick="checksitemap();" /></td-->
        </tr>

        
        

</tbody>
</table>
