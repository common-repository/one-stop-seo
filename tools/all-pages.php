<div class="wrap">
<h1>One Stop SEO</h1></div>
<?php $ossm_list_of_urls = ossm_print_all_urls();?>
<h2>List of All Available URLs [<?php echo esc_html(count($ossm_list_of_urls));?>]</h2>
<div class="wrapsearch">
<input type="text" class="searchterm" id="search" onkeyup="searchpage()" placeholder="Search for Pages..">
</div>
<table class="styled-table" id="table">
    <thead><td>Type</td><td>URL</td><td>Date Published</td><td>Last Modified</td><td>Edit Page</td><td>Edit Meta</td></thead><tbody>
<?php 

foreach($ossm_list_of_urls as $ossm_data_row){
    $ossm_dataarray = explode(",",$ossm_data_row);
     echo '<tr><td>'.
     esc_html(ucwords($ossm_dataarray[0])).
     '</td><td>'."<a href='".
     esc_url($ossm_dataarray[1]).
     "' target='_blank'>".
     esc_url($ossm_dataarray[1]).
     '</a></td><td>'.
     esc_html($ossm_dataarray[2]).
     '</td><td>'.
     esc_html($ossm_dataarray[3]).
     '</td><td><div class="popup-link"><a href="'.esc_url(OSSM_SITE_URL).'/wp-admin/post.php?post='.
     esc_html($ossm_dataarray[4]).
     '&action=edit" target="_blank">Edit</a></div></td>';
     echo '<td><div class="popup-link"><a href="#'.esc_html($ossm_dataarray[4]).'">Edit Metas</a></div></td></tr>';
     
}
?>
</tbody>
</table>
<?php 
//settings_fields( 'ossm_options' );
//do_settings_sections( 'ossm_options' );
//get_the_title($ossm_dataarray[4]);
//echo '<h1>'.$ossm_dataarray[1].'</h1><h3>Page Title '.$ossm_dataarray[4].'</h3><input type="text" name="pagetitle" value=""><h3>Meta Description</h3><input type="text" name="pagedescription">';
foreach($ossm_list_of_urls as $ossm_data_row){
    $ossm_dataarray = explode(",",$ossm_data_row);
    global $post;
    $title = "";
    $ossm_get_meta_data = get_option('ossm_page_title');
    $ossm_get_meta_data_decoded = json_decode($ossm_get_meta_data,true);
   foreach($ossm_get_meta_data_decoded as $eachdata){
    if($eachdata['id']== $ossm_dataarray[4]){
    $title =  $eachdata['title']; 
    break;
    }}

echo '<form method="post" name="submitform" id="details" data-id="'.$ossm_dataarray[4].'" action="options.php">
<div id="'.esc_html($ossm_dataarray[4]).'" class="popup-container popup-style"><div class="popup-content">
           <a href="#" id="closebtn" class="close">&times;</a>
           <h1>Feature Coming Soon!!!</h1>
           <input name="ossm_robots" type="text" id="title" value="'.$title.'"/>
           <input name="ossm_robots" id="check" type="checkbox" />
           <div class="wrap-input2 validate-input" data-validate="Name is required">
<input class="input2" type="text" name="name">
<span class="focus-input2" data-placeholder="NAME"></span>
</div>
           
  </div>
</div></form>
     ';
     
}
echo '<form method="post" action="options.php"> ';
settings_fields( 'ossm_options_all' );
do_settings_sections( 'ossm_options_all' );
?>
<input id="hidden_data" name="ossm_page_title" type="text"/>
<?php
submit_button();
echo "</form>";
     ?>
 
     <script src="https://code.jquery.com/jquery-3.5.0.js"></script>
<script>

$('.close').click(function(e){
var jsondata = "";   
var pluginArrayArg = new Array();  
  //e.preventDefault();
  var fields = $("[name='submitform']").each(function() {
    var robot = $(this).find('#check').is(':checked');
    var title = $(this).find("#title").val();
    var id = $(this).attr('data-id');
    
    var dataArg = new Object();
    
    dataArg.id = id;
    dataArg.robot = robot;
    dataArg.title = title;
 pluginArrayArg.push(dataArg);

})
console.log("changed inputs", JSON.stringify(pluginArrayArg));
$("#hidden_data").val(JSON.stringify(pluginArrayArg));
});
</script>