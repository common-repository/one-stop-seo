<?php

function ossm_check_url_canonicalization($ossm_data){
  $ossm_url = str_replace("www.","",parse_url($ossm_data,PHP_URL_HOST));
  
  $ossm_http_non_www = "http://" . $ossm_url; 
  $ossm_http_www = "http://www." . $ossm_url;
  $ossm_https_non_www = "https://" . $ossm_url;
  $ossm_https_www = "https://www." . $ossm_url;
  $ossm_url_versions = array($ossm_https_non_www,$ossm_https_www,$ossm_http_non_www,$ossm_http_www);
  $ossm_results = "";
    foreach($ossm_url_versions as $url ){
        $status_code;
        $headers = @get_headers($url);
        if(!$headers){
            $status_code = "404";
        }
        elseif(strpos($headers[0], "HTTP/1") !== false)
        { 

            $status_code = substr($headers[0], 9, 3);
        }
        
        $ossm_results .= $url.",".$status_code.",";
    }
    return $ossm_results.date('d-m-Y');
}

function ossm_check_sitemap_status($ossm_data){
      $ossm_headers1 = @get_headers($ossm_data . '/sitemap.xml');
      $ossm_headers2 = @get_headers($ossm_data . '/sitemap_index.xml');
      if($ossm_headers1 && strpos( $ossm_headers1[0], '200')) { 
          return sanitize_text_field('Available,'.$ossm_data.'/sitemap.xml');
      } elseif ($ossm_headers2 && strpos( $ossm_headers2[0], '200')) {
        return sanitize_text_field('Available,'.$ossm_data.'/sitemap_index.xml');
      }
      else { 
          return sanitize_text_field("Not Available,N/a");
      } 
}
function ossm_check_robots_status($ossm_data){
      $ossm_headers = @get_headers($ossm_data . '/robots.txt');
      if($ossm_headers && strpos( $ossm_headers[0], '200')) { 
          return sanitize_text_field('Available,'.$ossm_data.'/robots.txt');
      } 
      else { 
          return sanitize_text_field("Not Available,N/a");
      } 
}

function ossm_print_all_urls(){

  $ossm_all_posts = new WP_Query('post_type=any&posts_per_page=-1&post_status=publish&orderby=modified&order=desc');
  $ossm_all_posts = $ossm_all_posts->posts;
  $ossm_list_of_urls = array();
  foreach($ossm_all_posts as $ossm_post) {
        switch ($ossm_post->post_type) {
          case 'revision':
          case 'nav_menu_item':
              break;
          case 'page':
              $ossm_permalink = OSSM_SITE_URL.'/'. get_page_uri($ossm_post->ID).'/';
              break;
          case 'post':
              $ossm_permalink = get_permalink($ossm_post->ID);
              break;
          case 'attachment':
              $ossm_permalink = get_attachment_link($ossm_post->ID);
              break;
          default:
              $ossm_permalink = get_post_permalink($ossm_post->ID);
              break;
      }
      //$ossm_postdata = get_post($ossm_post->ID);
      //echo "<pre>";
      //var_dump($ossm_postdata);
      $ossm_list_of_urls[] = $ossm_post->post_type.
                             ",".
                             $ossm_permalink.
                             ",".
                             date('d-m-Y', strtotime($ossm_post->post_date)).
                             ",".
                             date('d-m-Y', strtotime($ossm_post->post_modified)).
                             ",".
                             $ossm_post->ID;

  }
  return $ossm_list_of_urls;
}
function ossm_fetch_da($site){
    $ossm_domain_data = file_get_contents("https://fahadbinzafar.com/pluginapi.php?domain=".$site);
    $contents = json_decode($ossm_domain_data,true);
    return $contents['results'][0]['domain_authority'].",".$contents['results'][0]['page_authority'].",".date('d-m-Y');
}
function ossm_get_page_speed_score($site) {
   $desktop_fetch = "";
    $mobile_fetch = "";
    $score_results = "";
    #initialize
    $use_cache = false;
    //$apc_is_loaded = extension_loaded('apc');

    #set $use_cache
    //if($apc_is_loaded) {
      //  apc_fetch("thumbnail:".$site, $use_cache);
    //}

    if(!$use_cache) {
        $desktop_fetch = file_get_contents("https://www.googleapis.com/pagespeedonline/v5/runPagespeed?key=AIzaSyDKIz7bBbt7WWIkTvY1zPTz6L4bupjVDqc&locale=en_US&url=$site&strategy=desktop");
        $desktop_fetch = json_decode($desktop_fetch, true);
        $desktop_score = $desktop_fetch['lighthouseResult']['categories']['performance']['score'];
        $desktop_score = $desktop_score*100;
        
        $mobile_fetch = file_get_contents("https://www.googleapis.com/pagespeedonline/v5/runPagespeed?key=AIzaSyDKIz7bBbt7WWIkTvY1zPTz6L4bupjVDqc&locale=en_US&url=$site&strategy=mobile");
        $mobile_fetch = json_decode($mobile_fetch, true);
        $mobile_score = $mobile_fetch['lighthouseResult']['categories']['performance']['score'];
        $mobile_score = $mobile_score *100;
        
        $score_results= $desktop_score.','.$mobile_score.','.date('d-m-Y');

     
    }
    return $score_results;
}
