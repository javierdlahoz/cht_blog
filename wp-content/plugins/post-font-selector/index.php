<?php
/*
Plugin Name: Post-Page Font Selector 
Plugin URI: http://spottedkoi.com/plugins/post-font-selector 
Description: Let's you choose a font for your posts or pages from the admin edit page for your posts or pages.  Will load the styles into the page dynamically as that post or page is displayed.
Author: Matt Bernier 
Author URI: http://spottedkoi.com
Version: 1.0
License: GPL2
*/

/*
Copyright YEAR  PLUGIN_AUTHOR_NAME  (email : PLUGIN AUTHOR EMAIL)

 This program is free software; you can redistribute it and/or modify
 it under the terms of the GNU General Public License, version 2, as 
 published by the Free Software Foundation.

 This program is distributed in the hope that it will be useful,
 but WITHOUT ANY WARRANTY; without even the implied warranty of
 MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 GNU General Public License for more details.

 You should have received a copy of the GNU General Public License
 along with this program; if not, write to the Free Software
 Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/

/*
Version 1.0 - Plugin created
*/

add_action('add_meta_boxes', 'postfont_add_custom_box' );
add_action('save_post', 'postfont_save_postdata' );
add_action('admin_head', 'postfont_admin_head');

function postfont_admin_head() {
$x = WP_PLUGIN_URL.'/'.str_replace(basename( __FILE__),"",plugin_basename(__FILE__));
	?>
<link rel='stylesheet' id='fonts-css'  href='<?php echo $x;?>css/fontSelect.css' type='text/css' media='all' />
	<?php
}
add_action('wp_head', 'postfont_front_css_include');
function postfont_front_css_include() {
		?>
	<link rel='stylesheet' id='fonts-css'  href='<?php echo plugins_url( 'css/frontEndFonts.css' , __FILE__ );?>' type='text/css' media='all' />
		<?php
	global $post;
	if ($post->post_type == 'post' || $post->post_type == 'page') {
		$postOption = get_option( 'fonts-'.($post->post_type == 'post' ? 'post' : 'page').'-content-class', $_POST['post-content-class'] );
		$postFont = get_post_meta($post->ID, 'customFont');

		if ((isset($postOption) && count($postOption) > 0) && (isset($postFont[0]) && count($postFont[0]) > 0)) {
			echo '<style>';
			printf("
			%s{
				font-family: %s !important;
			}", 
			$postOption,
			$postFont[0]);
			echo '</style>';
		}
	}
}

/* Adds a box to the main column on the Post and Page edit screens */
function postfont_add_custom_box() {
    add_meta_box( 
        'postfont_sectionid',
        __( 'Choose Your Post Font', 'postfont_textdomain' ),
        'postfont_inner_custom_box',
        'post' 
    );
    add_meta_box(
        'postfont_sectionid',
        __( 'Choose your Page Font', 'postfont_textdomain' ), 
        'postfont_inner_custom_box',
        'page'
    );
}

/* Prints the box content */
function postfont_inner_custom_box( $post ) {

  // Use nonce for verification
  wp_nonce_field( plugin_basename( __FILE__ ), 'postfont_noncename' );

  // The actual fields for data entry
  echo '<label for="postfont_new_field">';
       _e("Choose the font you would like displayed for your post", 'postfont_textdomain' );
  echo '</label> ';


?>
	<select id="postfont_font" name="postfont_font">
		<option value="null">Select Font...</option>
	<?php
	global $wpdb;
	$q = sprintf("SELECT * FROM %sfonts ORDER BY type ASC, name ASC",
					$wpdb->prefix);
	$fonts = $wpdb->get_results($q);
	
	$family = null;
	$count = 0;
	$option = get_post_meta($post->ID, 'customFont');

	foreach ($fonts as $font) {
		if ($family != $font->type) {
			if ($count > 0) {
				echo $endOptGroup;
			}
			echo '<optgroup label="'.$font->type.'">';
			$count++;
		}
			printf('<option class="%s" %s>%s</option>', 
					str_replace(' ', '', strtolower($font->name)), 
					($font->name == $option[0] ? 'selected="selected"' : ''),
					$font->name);
	}
	?>
		</optgroup>
	</select>
<?php  
}

/* When the post is saved, saves our custom data */
function postfont_save_postdata( $post_id ) {
  // verify if this is an auto save routine. 
  // If it is our form has not been submitted, so we dont want to do anything
  if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) 
      return;

  // verify this came from the our screen and with proper authorization,
  // because save_post can be triggered at other times

  if ( !wp_verify_nonce( $_POST['postfont_noncename'], plugin_basename( __FILE__ ) ) )
      return;

  
  // Check permissions
  if ( 'page' == $_POST['post_type'] ) 
  {
    if ( !current_user_can( 'edit_page', $post_id ) )
        return;
  }
  else
  {
    if ( !current_user_can( 'edit_post', $post_id ) )
        return;
  }

  // OK, we're authenticated: we need to find and save the data

  $myData = $_POST['postfont_font'];
	update_post_meta($post_id, 'customFont', $myData);
  // Do something with $mydata 
  // probably using add_post_meta(), update_post_meta(), or 
  // a custom table (see Further Reading section below)
}

add_action('admin_menu', 'postfont_admin_menu');
function postfont_admin_menu() {
	/* add_menu_page( $page_title, $menu_title, $capability, $menu_slug, $function, $icon_url, $position );*/
	add_menu_page('Choose Post Fonts', 'Choose Post Fonts', 'manage_options', 'postfont-manage', 'postfont_main_admin');

/*	add_submenu_page('postfont-manage', 'Choose Fonts', 'Choost Fonts', 'manage_options', 'postfont-user-progress', 'postfont_user_progress');*/
}

function postfont_main_admin()
{
	global $title;
	global $wpdb;
	//if we have post data and the nonce field matches - then save the data, otherwise we can thrown an error or bitch
	if (isset($_POST['save-fonts']) && check_admin_referer('postfont_main_admin', 'postfont_main_admin_nonce_field')) {
		update_option( 'fonts-post-content-class', $_POST['post-content-class'] );
		update_option( 'fonts-page-content-class', $_POST['page-content-class'] );
		
		$wpdb->query($wpdb->prepare("Update ".$wpdb->prefix.'fonts'." SET selected = 0 WHERE 1"));
		foreach($_POST['font'] as $index=>$font) {
			if ($font == 'on') {
				$wpdb->update( $wpdb->prefix.'fonts', array('selected' => 1), array('id' => $index), array('%d'), array('%d'));
			}
		}
		
		if (isset($_POST['newFont']) && !empty($_POST['newFont'])) {
			$wpdb->query($wpdb->prepare("INSERT INTO ".$wpdb->prefix.'fonts'." (type, name, selected) VALUES ('".$_POST['newFontType']."','".$_POST['newFont']."',1)"));
		}
		
		//write the postFontCSS file
		postfont_writeCssFile();
	}
	
	?>
    <h2><?php echo $title;?></h2>
	<div class="wrap">
		<form method="post" action="/wp-admin/admin.php?page=postfont-manage">
		   <?php wp_nonce_field( 'postfont_main_admin','postfont_main_admin_nonce_field' ); ?>
		<div id="poststuff">
			<div id="post-body">
				<div class="metabox-holder">
					<div id="" class="meta-box-sortables ui-sortable">
						<div class="postbox " id="">
							<div title="Click to toggle" class="handlediv">
								<br>
							</div>
							<h3 class="hndle"><span>What are your content HTML identifiers?</span></h3>
							<div class="inside">
								<table class="form-table">
									<tr valign="top">
										<th scope="row">Post Content Class</th>
										<td><input type="text" name="post-content-class" id="post-content-class" value="<?php echo get_option('fonts-post-content-class');?>" /> <em>The HTML element that holds your content on posts</em></td>
									</tr>
									<tr valign="top">
										<th scope="row">Page Content Class</th>
										<td><input type="text" name="page-content-class" id="page-content-class" value="<?php echo get_option('fonts-page-content-class');?>" /> <em>The HTML element that holds your content on pages</em></td>
									</tr>
								</table>
							</div>
						</div>
					</div>
				</div>
				<div class="metabox-holder">
					
					<div id="" class="meta-box-sortables ui-sortable">
						<div class="postbox " id="">
							<div title="Click to toggle" class="handlediv">
								<br>
							</div>
							<h3 class="hndle"><span>Choose Post/Page Fonts</span></h3>
							<div class="inside">
								<p><em>Fonts may load slowly based on you internet connection, please be patient.</em></p>
								<table class="form-table">
								<?php
		$q = sprintf("SELECT * FROM %sfonts ORDER BY type ASC, name ASC",
						$wpdb->prefix);
		$fonts = $wpdb->get_results($q);

		$family = null;
			foreach ($fonts as $font) {

				if ($family != $font->type) {
					$outputFont = $font->type;
					$family = $font->type;
				} else {
					$outputFont = null;
				}
				printf('<tr valign="top">%s<td class="fontTd"><label for="%s" class="%s"><input name="font[%s]" id="font[%s]" type="checkbox" %s/> %s</label></td></tr>', 
					(is_null($outputFont) ? "<td></td>" : '<th scope="row">'.$outputFont.' &nbsp;&nbsp;</th>'),
					str_replace(' ', '', strtolower($font->name)), 
					str_replace(' ', '', strtolower($font->name)),
					$font->id,
					$font->id,
					($font->selected == 1 ? 'checked="checked"' : ''),
					$font->name);
			}
		?>
			<tr>
				<td><label for="add-new-font">Add Font</label></td>
				<td><select name="newFontType" id="newFontType">
						<option value="serif" style="font-family:serif;">SERIF</option>
						<option value="sans-serif" style="font-family:sans-serif;">Sans-SERIF</option>
						<option value="script" style="font-family:'Brush Script MT';">SCRIPT</option>
					</select><input type='text' name='newFont' id='newFont' value='' placeholder='Font Name From Google' /><em>You can get font names from the <a href="http://www.google.com/webfonts">Google Fonts Repository</a></em><br />Font Reference:<br />&nbsp;&nbsp;&nbsp;<span style="font-family:'Times New Roman', serif">Serif Fonts typically have a small line on the ends of the letters</span><br />&nbsp;&nbsp;&nbsp;<span style="Arial, sans-serif">San-Serif Fonts are smooth, with no accents on the ends of the letters</span><br />&nbsp;&nbsp;&nbsp;<span style="font-family:'Brush Script MT';font-size:14px">Script Fonts look like handwriting</span></td>
			</tr>
			<tr>
				<td></td>
				<td><input class='button-primary' type='submit' name='save-fonts' value='<?php _e('Save Font Selection'); ?>' id='submitbutton' /></td>
			</tr>
								</table>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		</form>
	</div>
    <?php
}
function postfont_manage_menu() {
   /* Output our admin page */
}
function postfont_writeFrontEndCssFile() {
	global $wpdb;

	ob_start();

	$q = sprintf("SELECT * FROM %sfonts WHERE selected=1 ORDER BY type ASC, name ASC",
					$wpdb->prefix);
	$fonts = $wpdb->get_results($q);

	foreach ($fonts as $font) {
		printf("@import url('http://fonts.googleapis.com/css?family=%s');\n",urlencode($font->name));
	}

	$data = ob_get_clean();
	//var_dump(dirname(__FILE__));
	$handle = fopen(dirname(__FILE__).'/css/frontEndFonts.css', 'w');
	fwrite($handle, $data);
	fclose($handle);
}

function postfont_writeCssFile() {
	
	global $wpdb;

	$q = sprintf("SELECT * FROM %sfonts ORDER BY type ASC, name ASC",
					$wpdb->prefix);
	$fonts = $fonts2 = $wpdb->get_results($q);
	ob_start();
	foreach ($fonts as $font) {
		printf("@import url('http://fonts.googleapis.com/css?family=%s');\n",urlencode($font->name));
	}
	$family = null;
	foreach ($fonts2 as $font) {
			printf("
			label.%s{
				font-family: '%s' !important;
			}", str_replace(' ', '', strtolower($font->name)), $font->name);
	}
	?>

	select#postfont_font{
		font-size:30px !important; 
	}

	select#postfont_font optgroup{
		font-weight:bold;
		background:#dfdfdf;
	}

	select#postfont_font option{
		font-weight:normal;
		background:white;
	}

	td.fontTd{
		font-size:18px !important;
	}

	<?php
	$data = ob_get_clean();
	$handle = fopen(dirname(__FILE__).'/css/fontSelect.css', 'w');
	fwrite($handle, $data);
	fclose($handle);
}

function postfont_install() {
   	global $wpdb;
	require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
		
   	$sql = "CREATE TABLE IF NOT EXISTS `".$wpdb->prefix."fonts` (
	  `id` int(11) NOT NULL AUTO_INCREMENT,
	  `type` varchar(25) NOT NULL,
	  `name` varchar(255) NOT NULL,
	  `selected` tinyint(1) NOT NULL DEFAULT '0',
	  PRIMARY KEY (`id`)
	) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;";
   	dbDelta($sql);
	postfont_writeCssFile();
}

function postfont_checkFilePerms() {
	$filename = plugin_dir_path(__FILE__).'css/fontSelect.css';
	$filename2 = plugin_dir_path(__FILE__).'css/frontEndFonts.css';
	
	if (!is_writable($filename)) {
		echo "
    <div id='guide-message' class='updated fade postfont-notify'><p><strong>PostFont Notice: </strong>css/fontSelect.css is not writable. Please make this file writable in order for the postfont plugin to work correctly.</p></div>";
	}
		
	if (!is_writable($filename2)) {
		echo "
    <div id='guide-message' class='updated fade postfont-notify'><p><strong>PostFont Notice: </strong>css/frontEndFonts.css is not writable. Please make this file writable in order for the postfont plugin to work correctly.</p></div>";
	}
}
add_action('admin_notices', 'postfont_checkFilePerms');


function postfont_install_data() {	
   	global $wpdb;
	
	//setup the fonts, preselect a couple
	$query = "
		INSERT INTO `".$wpdb->prefix."fonts` (`id`, `type`, `name`, `selected`) VALUES
		(1, 'serif', 'Signika', 1),
		(2, 'sans-serif', 'Ribeye Marrow', 1),
		(3, 'script', 'Pinyon Script', 1);";
   
	$wpdb->query($wpdb->prepare($query));
}
register_activation_hook(plugin_basename(__FILE__), 'postfont_install');
register_activation_hook(plugin_basename(__FILE__), 'postfont_install_data');

function postfont_add_settings_link($links, $file) {
	$settings_link = '<a href="/wp-admin/admin.php?page=postfont-manage">'."Settings".'</a>';
 	$links['settings'] =  $settings_link;
	return $links;
}
add_filter('plugin_action_links', 'postfont_add_settings_link', 10, 2 );


?>
