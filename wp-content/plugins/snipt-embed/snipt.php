<?php
/*
Plugin Name: Snipt.net code embed plugin
Plugin URI: http://blog.clearskys.net/plugins/snipt-code-embedding-plugin/
Description: Enables easy embedding of <a href='http://snipt.net/'>Snipt.net</a> code samples into your post and page content. Displays a place marker when in the WYSIWYG editor so that you know where your code is placed.<br/><em>This plugin is not affiliated with or authorised by snipt.net</em>
Author: Barry at clearskys.net
Version: 0.2
Author URI: http://blog.clearskys.net/
License: GPL
*/


function snipt_shortcode($atts, $content = null) {
	extract(shortcode_atts(array("code" => ''), $atts));
	
	if(!empty($code)) {
		return "<script type='text/javascript' src='http://snipt.net/embed/$code'></script>";
	}
	
}

function snipt_adminheader() {
	$directories = explode(DIRECTORY_SEPARATOR,dirname(__FILE__));
	$mydir = $directories[count($directories)-1];
	
	wp_enqueue_script('snipt.js', WP_PLUGIN_URL . "/" . $mydir . "/js/snipt.js", array());
}

function snipt_addbuttons() {
   // Don't bother doing this stuff if the current user lacks permissions
   if ( ! current_user_can('edit_posts') && ! current_user_can('edit_pages') )
     return;
 
   // Add only in Rich Editor mode
   if ( get_user_option('rich_editing') == 'true') {
     add_filter("mce_external_plugins", "add_snipt_tinymce_plugin");
     add_filter('mce_buttons', 'register_snipt_button');
   }
	
   add_action('admin_footer', 'snipt_add_quicktags');
}

function snipt_add_quicktags() {
echo '
<script type="text/javascript">
<!--
	if(sniptToolbar = document.getElementById("ed_toolbar")){
';

echo <<<EOT
		
		var sniptNr, sniptBut, sniptStart, sniptEnd;							
		sniptStart = '';
		sniptEnd = '';
		sniptNr = edButtons.length;
		edButtons[sniptNr] = new edButton('ed_snipt','',sniptStart, sniptEnd,'');
		var sniptBut = sniptToolbar.lastChild;
		while (sniptBut.nodeType != 1){
			sniptBut = sniptBut.previousSibling;
		}
		sniptBut = sniptBut.cloneNode(true);
		sniptToolbar.appendChild(sniptBut);
		sniptBut.value = 'snipt';
		sniptBut.title = sniptNr;
		sniptBut.onclick = function () {edInsertSniptCode();}
		sniptBut.id = "ed_snipt";					
EOT;

echo <<<EOT
	}
//-->
</script>
EOT;

}
 
function register_snipt_button($buttons) {
   array_push($buttons, "separator","snipt");
   return $buttons;
}
 
// Load the TinyMCE plugin : editor_plugin.js (wp2.5)
function add_snipt_tinymce_plugin($plugin_array) {
	$directories = explode(DIRECTORY_SEPARATOR,dirname(__FILE__));
	$mydir = $directories[count($directories)-1];
	
	if(!defined('WP_PLUGIN_URL')) {
		$plugin_array['snipt'] = get_option('siteurl') . "/wp-content/plugins/" . $mydir . "/js/snipteditor.js";
	} else {
		$plugin_array['snipt'] = WP_PLUGIN_URL . "/" . $mydir . "/js/snipteditor.js";
	}
   	return $plugin_array;
}
 
// init process for button control
add_action('init', 'snipt_addbuttons');

add_shortcode("snipt", "snipt_shortcode");
add_action('init', 'snipt_adminheader');


?>