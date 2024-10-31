<?php
global $all_data;
global $post;
/* -==========- Hooks -==========- */

// Add Plugin Link in Setting Menu
add_action('admin_enqueue_scripts', 'ossm_css_and_js');
add_action('admin_menu', 'ossm_plugin_options');
add_action( 'admin_menu', 'ossm_sub_menu' );
add_action('admin_bar_menu', 'ossm_add_toolbar_items', 100);

/* -==========- Hooks End -==========- */

/* -==========- Functions -==========- */

// Plugin Page Option 
function ossm_plugin_options() {
    add_menu_page(
                      'One Stop SEO Options',
                      'One Stop SEO', 
                      'manage_options', 
                      'one-stop-seo', 
                      'ossm_setting_page',
                      'dashicons-share-alt',
                      '1'
                    );

}

// Add Sub menu Link to Side bar
function ossm_sub_menu() {
  add_submenu_page(
    'one-stop-seo',
    'All Page',
    'All Pages',
    'manage_options',
    'one-stop-seo-all-pages',
    'ossm_all_pages'
  );
  add_submenu_page(
    'one-stop-seo',
    'Check Status',
    'Check Status',
    'manage_options',
    'one-stop-seo-check-status',
    'ossm_check_status'
  );
  add_submenu_page(
    'one-stop-seo',
    'Site Tools',
    'Site Tools',
    'manage_options',
    'one-stop-seo-site-tools',
    'ossm_site_tools'
  );
}

// Add Link to Top Bar
function ossm_add_toolbar_items($admin_bar){
    $admin_bar->add_menu( array(
        'id'    => 'top-menu',
        'title' => 'One Stop SEO',
        'href'  => '#',
        'meta'  => array(
            'title' => __('One Stop SEO'),            
        ),
    ));
    $admin_bar->add_menu( array(
        'id'    => 'all-pages',
        'parent' => 'top-menu',
        'title' => 'All Pages',
        'href'  => OSSM_SITE_URL .'/wp-admin/admin.php?page=one-stop-seo-all-pages',
        'meta'  => array(
            'title' => __('All Pages'),
            'class' => 'my_menu_item_class'
        ),
    ));
    $admin_bar->add_menu( array(
        'id'    => 'check-status',
        'parent' => 'top-menu',
        'title' => 'Check Status',
        'href'  => OSSM_SITE_URL .'/wp-admin/admin.php?page=one-stop-seo-check-status',
        'meta'  => array(
            'title' => __('Check Status'),
            'class' => 'my_menu_item_class'
        ),
    ));
     $admin_bar->add_menu( array(
        'id'    => 'site-tools',
        'parent' => 'top-menu',
        'title' => 'Site Tools',
        'href'  => OSSM_SITE_URL .'/wp-admin/admin.php?page=one-stop-seo-site-tools',
        'meta'  => array(
            'title' => __('Site Tools'),
            'class' => 'my_menu_item_class'
        ),
    ));
  }



/* -==========- Functions End -==========- */





    function ossm_css_and_js()
    {

    $ossm_current_screen = get_current_screen();


   if ( $ossm_current_screen->id ===  "one-stop-seo_page_one-stop-seo-all-pages") {
        wp_enqueue_style('boot_css', plugins_url('assets/css/all-pages.css',__FILE__ ),array(),null);
        wp_enqueue_script('boot_js', plugins_url('assets/js/all-pages.js',__FILE__ ),array(),date("h:i:s"),true );
    }
    elseif ( $ossm_current_screen->id ===  "one-stop-seo_page_one-stop-seo-check-status") {
        wp_enqueue_style('boot_css', plugins_url('assets/css/check-status.css',__FILE__ ),array(),null);
        wp_enqueue_script('boot_js', plugins_url('assets/js/check-status.js',__FILE__ ),array(),null,true );
        
    }
    elseif ( $ossm_current_screen->id ===  "one-stop-seo_page_one-stop-seo-site-tools") {
        wp_enqueue_style('boot_css', plugins_url('assets/css/site-tools.css',__FILE__ ),array(),null);
        wp_enqueue_script('boot_js', plugins_url('assets/js/site-tools.js',__FILE__ ),array(),null,true );
        
    }
    else {
        return;

        }
    }
    
    

/* -==========- Register OptionSetting  -==========- */

add_action( 'admin_init', 'ossm_register_setting' );
function ossm_register_setting() {
    $args = array(
            'type' => 'string', 
            'sanitize_callback' => 'sanitize_text_field',
            'default' => NULL,
            );
    register_setting( 'ossm_options_all', 'ossm_page_title', $args );
    register_setting( 'ossm_options_check', 'ossm_da_pa', $args );
    register_setting( 'ossm_options_check', 'ossm_speed_score', $args );
    register_setting( 'ossm_options_check', 'ossm_site_canonicalization', $args );
    register_setting( 'ossm_options_tool', 'ossm_checked_status', $args );
    register_setting( 'ossm_options_tool', 'ossm_redirect_url', $args );
    register_setting( 'ossm_options_tool', 'ossm_gtm_tag_checked', $args );
    register_setting( 'ossm_options_tool', 'ossm_gtm_tag', $args );
    register_setting( 'ossm_options_tool', 'ossm_gau_tag_checked', $args );
    register_setting( 'ossm_options_tool', 'ossm_gau_tag', $args );
    register_setting( 'ossm_options_tool', 'ossm_ganew_tag_checked', $args );
    register_setting( 'ossm_options_tool', 'ossm_ganew_tag', $args );
    register_setting( 'ossm_options_tool', 'ossm_gsc_tag_checked', $args );
    register_setting( 'ossm_options_tool', 'ossm_gsc_tag', $args );
} 
/* -==========- Set Title  -==========- */
function ossm_set_title( $title )
{
   
    $ossm_new_title =  $title; 
    $ossm_current_post_id = ossm_get_the_post_ID();
    $ossm_get_meta_data = get_option('ossm_page_title');
    $ossm_get_meta_data_decoded = json_decode($ossm_get_meta_data,true);
   foreach($ossm_get_meta_data_decoded as $eachdata){
    if($eachdata['id']== $ossm_current_post_id){
    $ossm_new_title =  $eachdata['title']; 
    break;
    }}
   
   //$title = $ossm_get_meta_data_decoded[$ossm_current_post_id]->title;
return $ossm_new_title;
}

add_filter( 'pre_get_document_title', 'ossm_set_title' );
function ossm_get_the_post_ID() {
               $post = get_post();
               return ! empty( $post ) ? $post->ID : false;
                }
/* -==========- Set Title  -==========- */                

/* -==========- 404 to Home  -==========- */
if(get_option('ossm_checked_status')=='true'){
add_action('template_redirect','Ossm_Broken_Pages_Redirect');
}
function Ossm_Broken_Pages_Redirect(){
    
    if(is_404()){
        $url = sanitize_text_field(get_option('ossm_redirect_url'));
        if($url ==""){wp_redirect(home_url(),301);}
        else{wp_redirect($url,301);}
        }
    
}

/* -==========- GTM Tag  -==========- */
if(get_option('ossm_gtm_tag_checked')=='true' && !empty(get_option('ossm_gtm_tag'))){
add_action('wp_head','ossm_configure_gtm_tag_head',-1);
add_action('wp_body_open','ossm_configure_gtm_tag_body',-1);
}
function ossm_configure_gtm_tag_head(){
    echo "<!-- Google Tag Manager Added by One Stop SEO-->
<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
})(window,document,'script','dataLayer','".esc_html(get_option('ossm_gtm_tag'))."');</script>
<!-- End Google Tag Manager -->";
    

}
function ossm_configure_gtm_tag_body(){
    echo '<!-- Google Tag Manager (noscript) Added by One Stop SEO-->
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id='.esc_html(get_option('ossm_gtm_tag')).'"
height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<!-- End Google Tag Manager (noscript) -->';
}

/* -==========- GA Universal Tag  -==========- */

if(get_option('ossm_gau_tag_checked')=='true' && !empty(get_option('ossm_gau_tag'))){
add_action('wp_head','ossm_configure_ua_tag_head',-1);
}
function ossm_configure_ua_tag_head(){
    
echo "
<!-- Google tag (gtag.js)  Added by One Stop SEO-->
<script async src='https://www.googletagmanager.com/gtag/js?id=".esc_html(get_option('ossm_gau_tag'))."'></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', '".esc_html(get_option('ossm_gau_tag'))."');
</script>
";    
}

/* -==========- GA4 Tag  -==========- */

if(get_option('ossm_ganew_tag_checked')=='true' && !empty(get_option('ossm_ganew_tag'))){
add_action('wp_head','ossm_configure_ganew_tag_head',-1);
}
function ossm_configure_ganew_tag_head(){
echo "
<!-- Google tag (gtag.js)  Added by One Stop SEO-->
<script async src='https://www.googletagmanager.com/gtag/js?id=".esc_html(get_option('ossm_ganew_tag'))."'></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', '".esc_html(get_option('ossm_ganew_tag'))."');
</script>
<!-- Google tag (gtag.js) -->
";
}


/* -==========- Search Console Verify  -==========- */

if(get_option('ossm_gsc_tag_checked')=='true' && !empty(get_option('ossm_gsc_tag'))){
add_action('wp_head','ossm_configure_gsc_tag_head',-1);
}
function ossm_configure_gsc_tag_head(){
    if(is_front_page()){
echo '
<!-- Google Search Console Verification tag Added by One Stop SEO-->
<meta name="google-site-verification" content="'.esc_html(get_option('ossm_gsc_tag')).'" />
';
}

}

/* -==========- Register OptionSetting  -==========- */

/* -==========- noindex -==========- */
//add_action( 'wp_head', 'ossm_noindex_tag' );
//function ossm_noindex_tag(){
  //  echo '<meta name="robots" content="noindex">';
//}