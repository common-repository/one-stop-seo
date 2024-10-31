<div class="wrap">
<h1>Site Tools</h1></div>
<form method="post" action="options.php"> 
<table class="styled-table" id="table">
    <thead><td>Type</td><td>Enable</td><td>Details</td><td>Extra</td></thead><tbody>



<?php 
settings_fields( 'ossm_options_tool' );
do_settings_sections( 'ossm_options_tool' );
?>
    <!-- 404 Page Redirection-->
       <tr><td><label for="Student">Redirect All 404 Pages</label></td>
       <td><input name="ossm_checked_status" type="checkbox" value="true" <?php checked( 'true', get_option( 'ossm_checked_status' ) ); ?> /></td>
       <td><label for="Student">Leave Empty to redirect to home or specify desired URL</label></td>
       <td>Specific URL: <input name="ossm_redirect_url" type="input" value="<?php echo esc_html(get_option( 'ossm_redirect_url' )) ?>" /></td></tr>
       
    <!--Tag Manager Configure-->   
       <tr><td><label for="Student">Google Tag Manager</label></td>
       <td><input name="ossm_gtm_tag_checked" type="checkbox" value="true" <?php checked( 'true', get_option( 'ossm_gtm_tag_checked' ) ); ?> /></td>
       <td><label for="Student">Provide Tag Manager code e.g. 'GTM-XXXXXXX'</label></td>
       <td>Enter Code: <input name="ossm_gtm_tag" type="input" value="<?php echo esc_html(get_option( 'ossm_gtm_tag' )) ?>" /></td></tr>

        <!--GA4  Configure-->   
       <tr><td><label for="Student">Google Analytics [GA4]</label></td>
       <td><input name="ossm_ganew_tag_checked" type="checkbox" value="true" <?php checked( 'true', get_option( 'ossm_ganew_tag_checked' ) ); ?> /></td>
       <td><label for="Student">Provide GA4 Analytics code e.g. 'G-XXXXXXXXX'</label></td>
       <td>Enter Code: <input name="ossm_ganew_tag" type="input" value="<?php echo esc_html(get_option( 'ossm_ganew_tag' )) ?>" /></td></tr>
       
        <!--GA universal Configure-->   
       <tr><td><label for="Student">Google Analytics [UA]</label></td>
       <td><input name="ossm_gau_tag_checked" type="checkbox" value="true" <?php checked( 'true', get_option( 'ossm_gau_tag_checked' ) ); ?> /></td>
       <td><label for="Student">Provide Univesal Analytics code e.g. 'UA-XXXXXX-X'</label></td>
       <td>Enter Code: <input name="ossm_gau_tag" type="input" value="<?php echo esc_html(get_option( 'ossm_gau_tag' )) ?>" /></td></tr>   

        <!--GSC Site Verification Configure-->   
       <tr><td><label for="Student">Google Search Console</label></td>
       <td><input name="ossm_gsc_tag_checked" type="checkbox" value="true" <?php checked( 'true', get_option( 'ossm_gsc_tag_checked' ) ); ?> /></td>
       <td><label for="Student">Provide GSC Verification code e.g. 'XXXXXXXXXXXXXX'</label></td>
       <td>Enter Code: <input name="ossm_gsc_tag" type="input" value="<?php echo esc_html(get_option( 'ossm_gsc_tag' )) ?>" /></td></tr>   
<?php
submit_button();
?>
</tbody>
</table>
</form>
</div>