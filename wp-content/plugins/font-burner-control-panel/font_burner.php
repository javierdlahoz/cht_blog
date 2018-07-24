<?php
/* 
Plugin Name: Font Burner
Plugin URI: http://www.fontburner.com/the-font-burner-wordpress-plugin/
Version: v1.0
Author: <a href="http://adrian3.com/">Adrian3</a>
Description: The Font Burner Plugin allows you to easily add <a href="http://fontburner.com/">Font Burner</a> Fonts to your site through Wordpress.

*/  
   
/*
Hacked and Frankensteined into a plugin by Adrian Hanft http://adrian3.com/
*/

/**
* Guess the wp-content and plugin urls/paths
*/
// Pre-2.6 compatibility
if ( ! defined( 'WP_CONTENT_URL' ) )
      define( 'WP_CONTENT_URL', get_option( 'siteurl' ) . '/wp-content' );
if ( ! defined( 'WP_CONTENT_DIR' ) )
      define( 'WP_CONTENT_DIR', ABSPATH . 'wp-content' );
if ( ! defined( 'WP_PLUGIN_URL' ) )
      define( 'WP_PLUGIN_URL', WP_CONTENT_URL. '/plugins' );
if ( ! defined( 'WP_PLUGIN_DIR' ) )
      define( 'WP_PLUGIN_DIR', WP_CONTENT_DIR . '/plugins' );


if (!class_exists('fntburnr')) {
    class fntburnr {
        //This is where the class variables go, don't forget to use @var to tell what they're for
        /**
        * @var string The options string name for this plugin
        */
        var $optionsName = 'fntburnr_options';
        
        /**
        * @var string $localizationDomain Domain used for localization
        */
        var $localizationDomain = "fntburnr";
        
        /**
        * @var string $pluginurl The path to this plugin
        */ 
        var $thispluginurl = '';
        /**
        * @var string $pluginurlpath The path to this plugin
        */
        var $thispluginpath = '';
            
        /**
        * @var array $options Stores the options for this plugin
        */
        var $options = array();
        
        //Class Functions
        /**
        * PHP 4 Compatible Constructor
        */
        function fntburnr(){$this->__construct();}
        
        /**
        * PHP 5 Constructor
        */        
        function __construct(){
            //Language Setup
            $locale = get_locale();
            $mo = dirname(__FILE__) . "/languages/" . $this->localizationDomain . "-".$locale.".mo";
            load_textdomain($this->localizationDomain, $mo);

            //"Constants" setup
            $this->thispluginurl = PLUGIN_URL . '/' . dirname(plugin_basename(__FILE__)).'/';
            $this->thispluginpath = PLUGIN_PATH . '/' . dirname(plugin_basename(__FILE__)).'/';
            
            //Initialize the options
            //This is REQUIRED to initialize the options when the plugin is loaded!
            $this->getOptions();
            
            //Actions        
            add_action("admin_menu", array(&$this,"admin_menu_link"));
            add_action("wp_head", array(&$this,"fntburnrstart"));
			add_action("wp_head", array(&$this,"addfntburnrh1"));
			add_action("wp_head", array(&$this,"addfntburnrh2"));
			add_action("wp_head", array(&$this,"addfntburnrh3"));
			add_action("wp_head", array(&$this,"addfntburnrh4"));
            add_action("wp_head", array(&$this,"addfntburnrcss"));            
            add_action("wp_head", array(&$this,"fntburnrend"));
            /*
            add_action("wp_head", array(&$this,"add_css"));
            add_action('wp_print_scripts', array(&$this, 'add_js'));
            */
            
            //Filters
            /*
            add_filter('the_content', array(&$this, 'filter_content'), 0);
            */
        }
        
        
        
 function fntburnrstart() {
echo '
<!-- Font Burner -->
<link rel="stylesheet" href="';
	echo get_bloginfo('wpurl'); 
	echo '/wp-content/plugins/font-burner-control-panel/css/fontburner.css" type="text/css" media="screen" />
<link rel="wpurl" href="';
	echo get_bloginfo('wpurl'); 
	echo '/wp-content/plugins/font-burner-control-panel/css/fontburner_print.css" type="text/css" media="print" />
<script src="';
	echo get_bloginfo('wpurl'); 
	echo'/wp-content/plugins/font-burner-control-panel/js/fontburner.js" type="text/javascript"></script>';
}


function addfntburnrh1() {
         if ($this->options['fntburnr_h1_on_off'] == 'on') {
echo '<script type="text/javascript">	var ';
	echo $this->options['fntburnr_h1_font_v2'];
	echo '= { src: \'';
	echo get_bloginfo('wpurl'); 
	echo '/wp-content/plugins/font-burner-control-panel/fonts/';
	echo $this->options['fntburnr_h1_font_v2'];
	echo '.swf\' };  sIFR.prefetch(';
	echo $this->options['fntburnr_h1_font_v2'];
	echo '); sIFR.delayCSS  = true; sIFR.activate(';
	echo $this->options['fntburnr_h1_font_v2'];
	echo '); sIFR.replace(';
	echo $this->options['fntburnr_h1_font_v2'];
	echo ', { selector: \'h1, ';
	echo $this->options['fntburnr_h1_font_v2'];
	echo ', ';
	echo ' .';
	echo $this->options['fntburnr_h1_font_v2'];
	echo ', #';
	echo $this->options['fntburnr_h1_font_v2'];
	echo '\' , css: [ \'.sIFR-root {text-align:'; 
	echo $this->options['fntburnr_h1_align'];
	echo '; color:#';		
	echo $this->options['fntburnr_h1_color'];
	echo ';}' , ' a {color: #';
	echo $this->options['fntburnr_h1_link_color'];
	echo '; text-decoration: ';
	echo $this->options['fntburnr_h1_underline'];
	echo '; font-weight: normal; } ' ,'a:link { color:#';
	echo $this->options['fntburnr_h1_link_color'];
	echo '; text-decoration: ';
	echo $this->options['fntburnr_h1_underline'];
	echo '; font-weight: normal; } ' ,'a:hover { color:#';
	echo $this->options['fntburnr_h1_hover_color'];
	echo '; text-decoration: ';
	echo $this->options['fntburnr_h1_hover_underline'];
	echo '; font-weight: normal; } ' ,'a:visited { color: #';
	echo $this->options['fntburnr_h1_color'];
	echo '; text-decoration: ';
	echo $this->options['fntburnr_h1_underline'];
	echo ' }' , ' em { color: #';
	echo $this->options['fntburnr_h1_color'];
	echo '; font-style: normal; font-weight: normal; } ' , 'strong { color: #';
	echo $this->options['fntburnr_h1_color'];
	echo '; font-style: normal; font-weight: normal; }\' ] , offsetTop: 0, marginBottom: 0, verticalSpacing: 0, wmode: \'transparent\'}); </script>'
; }}

function addfntburnrh2() {
         if ($this->options['fntburnr_h2_on_off'] == 'on') {

	echo '
<script type="text/javascript">	var ';
	echo $this->options['fntburnr_h2_font_v2'];
	echo '= { src: \'';
	echo get_bloginfo('wpurl'); 
	echo '/wp-content/plugins/font-burner-control-panel/fonts/';
	echo $this->options['fntburnr_h2_font_v2'];
	echo '.swf\' };  sIFR.prefetch(';
	echo $this->options['fntburnr_h2_font_v2'];
	echo '); sIFR.delayCSS  = true; sIFR.activate(';
	echo $this->options['fntburnr_h2_font_v2'];
	echo '); sIFR.replace(';
	echo $this->options['fntburnr_h2_font_v2'];
	echo ', { selector: \'h2, ';
	echo $this->options['fntburnr_h2_font_v2'];
	echo ', ';
	echo ' .';
	echo $this->options['fntburnr_h2_font_v2'];
	echo ', #';
	echo $this->options['fntburnr_h2_font_v2'];
	echo '\' , css: [ \'.sIFR-root {text-align:'; 
	echo $this->options['fntburnr_h2_align'];
	echo '; color:#';		
	echo $this->options['fntburnr_h2_color'];
	echo ';}' , ' a {color: #';
	echo $this->options['fntburnr_h2_link_color'];
	echo '; text-decoration: ';
	echo $this->options['fntburnr_h2_underline'];
	echo '; font-weight: normal; } ' ,'a:link { color:#';
	echo $this->options['fntburnr_h2_link_color'];
	echo '; text-decoration: ';
	echo $this->options['fntburnr_h2_underline'];
	echo '; font-weight: normal; } ' ,'a:hover { color:#';
	echo $this->options['fntburnr_h2_hover_color'];
	echo '; text-decoration: ';
	echo $this->options['fntburnr_h2_hover_underline'];
	echo '; font-weight: normal; } ' ,'a:visited { color: #';
	echo $this->options['fntburnr_h2_color'];
	echo '; text-decoration: ';
	echo $this->options['fntburnr_h2_underline'];
	echo ' }' , ' em { color: #';
	echo $this->options['fntburnr_h2_color'];
	echo '; font-style: normal; font-weight: normal; } ' , 'strong { color: #';
	echo $this->options['fntburnr_h2_color'];
	echo '; font-style: normal; font-weight: normal; }\' ] , offsetTop: 0, marginBottom: 0, verticalSpacing: 0, wmode: \'transparent\'}); </script>'
; }}

function addfntburnrh3() {
         if ($this->options['fntburnr_h3_on_off'] == 'on') {

	echo ' 
<script type="text/javascript">	var ';
	echo $this->options['fntburnr_h3_font_v2'];
	echo '= { src: \'';
	echo get_bloginfo('wpurl'); 
	echo '/wp-content/plugins/font-burner-control-panel/fonts/';
	echo $this->options['fntburnr_h3_font_v2'];
	echo '.swf\' };  sIFR.prefetch(';
	echo $this->options['fntburnr_h3_font_v2'];
	echo '); sIFR.delayCSS  = true; sIFR.activate(';
	echo $this->options['fntburnr_h3_font_v2'];
	echo '); sIFR.replace(';
	echo $this->options['fntburnr_h3_font_v2'];
	echo ', { selector: \'h3, ';
	echo $this->options['fntburnr_h3_font_v2'];
	echo ', ';
	echo ' .';
	echo $this->options['fntburnr_h3_font_v2'];
	echo ', #';
	echo $this->options['fntburnr_h3_font_v2'];
	echo '\' , css: [ \'.sIFR-root {text-align:'; 
	echo $this->options['fntburnr_h3_align'];
	echo '; color:#';		
	echo $this->options['fntburnr_h3_color'];
	echo ';}' , ' a {color: #';
	echo $this->options['fntburnr_h3_link_color'];
	echo '; text-decoration: ';
	echo $this->options['fntburnr_h3_underline'];
	echo '; font-weight: normal; } ' ,'a:link { color:#';
	echo $this->options['fntburnr_h3_link_color'];
	echo '; text-decoration: ';
	echo $this->options['fntburnr_h3_underline'];
	echo '; font-weight: normal; } ' ,'a:hover { color:#';
	echo $this->options['fntburnr_h3_hover_color'];
	echo '; text-decoration: ';
	echo $this->options['fntburnr_h3_hover_underline'];
	echo '; font-weight: normal; } ' ,'a:visited { color: #';
	echo $this->options['fntburnr_h3_color'];
	echo '; text-decoration: ';
	echo $this->options['fntburnr_h3_underline'];
	echo ' }' , ' em { color: #';
	echo $this->options['fntburnr_h3_color'];
	echo '; font-style: normal; font-weight: normal; } ' , 'strong { color: #';
	echo $this->options['fntburnr_h3_color'];
	echo '; font-style: normal; font-weight: normal; }\' ] , offsetTop: 0, marginBottom: 0, verticalSpacing: 0, wmode: \'transparent\'}); </script>'
; }}

function addfntburnrh4() {
         if ($this->options['fntburnr_h4_on_off'] == 'on') {

	echo ' 
<script type="text/javascript">	var ';
	echo $this->options['fntburnr_h4_font_v2'];
	echo '= { src: \'';
	echo get_bloginfo('wpurl'); 
	echo '/wp-content/plugins/font-burner-control-panel/fonts/';
	echo $this->options['fntburnr_h4_font_v2'];
	echo '.swf\' };  sIFR.prefetch(';
	echo $this->options['fntburnr_h4_font_v2'];
	echo '); sIFR.delayCSS  = true; sIFR.activate(';
	echo $this->options['fntburnr_h4_font_v2'];
	echo '); sIFR.replace(';
	echo $this->options['fntburnr_h4_font_v2'];
	echo ', { selector: \'h4, ';
	echo $this->options['fntburnr_h4_font_v2'];
	echo ', ';
	echo ' .';
	echo $this->options['fntburnr_h4_font_v2'];
	echo ', #';
	echo $this->options['fntburnr_h4_font_v2'];
	echo '\' , css: [ \'.sIFR-root {text-align:'; 
	echo $this->options['fntburnr_h4_align'];
	echo '; color:#';		
	echo $this->options['fntburnr_h4_color'];
	echo ';}' , ' a {color: #';
	echo $this->options['fntburnr_h4_link_color'];
	echo '; text-decoration: ';
	echo $this->options['fntburnr_h4_underline'];
	echo '; font-weight: normal; } ' ,'a:link { color:#';
	echo $this->options['fntburnr_h4_link_color'];
	echo '; text-decoration: ';
	echo $this->options['fntburnr_h4_underline'];
	echo '; font-weight: normal; } ' ,'a:hover { color:#';
	echo $this->options['fntburnr_h4_hover_color'];
	echo '; text-decoration: ';
	echo $this->options['fntburnr_h4_hover_underline'];
	echo '; font-weight: normal; } ' ,'a:visited { color: #';
	echo $this->options['fntburnr_h4_color'];
	echo '; text-decoration: ';
	echo $this->options['fntburnr_h4_underline'];
	echo ' }' , ' em { color: #';
	echo $this->options['fntburnr_h4_color'];
	echo '; font-style: normal; font-weight: normal; } ' , 'strong { color: #';
	echo $this->options['fntburnr_h4_color'];
	echo '; font-style: normal; font-weight: normal; }\' ] , offsetTop: 0, marginBottom: 0, verticalSpacing: 0, wmode: \'transparent\'}); </script>'
; }}

function addfntburnrcss() {
         if ($this->options['fntburnr_css_on_off'] == 'on') {
echo '
<!-- Font Burner CSS styling -->
<style type="text/css" media="screen">
';
	echo $this->options['fntburnr_css'];
 	echo '</style>
';
; }}

function fntburnrend() {
echo '<!-- sIFR fonts delivered by www.fontburner.com -->

';
}







       
        /**
        * Retrieves the plugin options from the database.
        * @return array
        */
        function getOptions() {
            //Don't forget to set up the default options
            if (!$theOptions = get_option($this->optionsName)) {
                $theOptions = array(
	
	'fntburnr_h1_on_off'=>'on',
	'fntburnr_h1_font'=>'cuprum',
	'fntburnr_h1_align'=>'left',
	'fntburnr_h1_color'=>'666666',
	'fntburnr_h1_link_color'=>'000000',
	'fntburnr_h1_hover_color'=>'333333',	
	'fntburnr_h1_underline'=>'No underline',
	'fntburnr_h1_hover_underline'=>'underline',

	'fntburnr_h2_on_off'=>'on',
	'fntburnr_h2_font'=>'fontin_sans_bold',
	'fntburnr_h2_align'=>'left',
	'fntburnr_h2_color'=>'666666',
	'fntburnr_h2_link_color'=>'000000',
	'fntburnr_h2_hover_color'=>'333333',	
	'fntburnr_h2_underline'=>'No underline',
	'fntburnr_h2_hover_underline'=>'underline',

	'fntburnr_h3_on_off'=>'on',
	'fntburnr_h3_font'=>'andron_scriptor_web',
	'fntburnr_h3_align'=>'left',
	'fntburnr_h3_color'=>'666666',
	'fntburnr_h3_link_color'=>'000000',
	'fntburnr_h3_hover_color'=>'333333',	
	'fntburnr_h3_underline'=>'No underline',
	'fntburnr_h3_hover_underline'=>'underline',

	'fntburnr_h4_on_off'=>'on',
	'fntburnr_h4_font'=>'museo_300',
	'fntburnr_h4_align'=>'left',
	'fntburnr_h4_color'=>'666666',
	'fntburnr_h4_link_color'=>'000000',
	'fntburnr_h4_hover_color'=>'333333',	
	'fntburnr_h4_underline'=>'No underline',
	'fntburnr_h4_hover_underline'=>'underline',

	'fntburnr_h1_font_v2'=>'museo_300',
	'fntburnr_h2_font_v2'=>'museo_300',
	'fntburnr_h3_font_v2'=>'museo_300',
	'fntburnr_h4_font_v2'=>'museo_300',

	'fntburnr_css'=>'line-height: 1.2em;
	  font-size: 16px;
	}
.sIFR-active h1 {
	  line-height: 1.2em;
	  font-size: 15px;
	visibility: hidden;
	}
.sIFR-active h2 {
	  line-height: 1.2em;
	  font-size: 15px;
	visibility: hidden;
	}
.sIFR-active h3 {
	  line-height: 1.2em;
	  font-size: 14px;
	visibility: hidden;
	}
.sIFR-active h4 {
	  line-height: 1.2em;
	  font-size: 13px;
	visibility: hidden;'


			);
                update_option($this->optionsName, $theOptions);
            }
            $this->options = $theOptions;
            
            //!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
            //There is no return here, because you should use the $this->options variable!!!
            //!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
        }
        /**
        * Saves the admin options to the database.
        */
        function saveAdminOptions(){
            return update_option($this->optionsName, $this->options);
        }
        
        /**
        * @desc Adds the options subpanel
        */
        function admin_menu_link() {
            //If you change this from add_options_page, MAKE SURE you change the filter_plugin_actions function (below) to
            //reflect the page filename (ie - options-general.php) of the page your plugin is under!
            add_options_page('Font Burner', 'Font Burner', 10, basename(__FILE__), array(&$this,'admin_options_page'));
            add_filter( 'plugin_action_links_' . plugin_basename(__FILE__), array(&$this, 'filter_plugin_actions'), 10, 2 );
        }
        
        /**
        * @desc Adds the Settings link to the plugin activate/deactivate page
        */
        function filter_plugin_actions($links, $file) {
           //If your plugin is under a different top-level menu than Settiongs (IE - you changed the function above to something other than add_options_page)
           //Then you're going to want to change options-general.php below to the name of your top-level page
           $settings_link = '<a href="options-general.php?page=' . basename(__FILE__) . '">' . __('Settings') . '</a>';
           array_unshift( $links, $settings_link ); // before other links

           return $links;
        }
        
        /**
        * Adds settings/options page
        */
        function admin_options_page() { 
            if($_POST['fntburnr_save']){
                if (! wp_verify_nonce($_POST['_wpnonce'], 'fntburnr-update-options') ) die('Whoops! There was a problem with the data you posted. Please go back and try again.'); 

$this->options['fntburnr_h1_on_off'] = $_POST['fntburnr_h1_on_off'];
$this->options['fntburnr_h1_font'] = $_POST['fntburnr_h1_font'];
$this->options['fntburnr_h1_align'] = $_POST['fntburnr_h1_align'];
$this->options['fntburnr_h1_color'] = $_POST['fntburnr_h1_color'];
$this->options['fntburnr_h1_link_color'] = $_POST['fntburnr_h1_link_color'];
$this->options['fntburnr_h1_hover_color'] = $_POST['fntburnr_h1_hover_color'];
$this->options['fntburnr_h1_underline'] = $_POST['fntburnr_h1_underline'];
$this->options['fntburnr_h1_hover_underline'] = $_POST['fntburnr_h1_hover_underline'];

$this->options['fntburnr_h2_on_off'] = $_POST['fntburnr_h2_on_off'];
$this->options['fntburnr_h2_font'] = $_POST['fntburnr_h2_font'];
$this->options['fntburnr_h2_align'] = $_POST['fntburnr_h2_align'];
$this->options['fntburnr_h2_color'] = $_POST['fntburnr_h2_color'];
$this->options['fntburnr_h2_link_color'] = $_POST['fntburnr_h2_link_color'];
$this->options['fntburnr_h2_hover_color'] = $_POST['fntburnr_h2_hover_color'];
$this->options['fntburnr_h2_underline'] = $_POST['fntburnr_h2_underline'];
$this->options['fntburnr_h2_hover_underline'] = $_POST['fntburnr_h2_hover_underline'];

$this->options['fntburnr_h3_on_off'] = $_POST['fntburnr_h3_on_off'];
$this->options['fntburnr_h3_font'] = $_POST['fntburnr_h3_font'];
$this->options['fntburnr_h3_align'] = $_POST['fntburnr_h3_align'];
$this->options['fntburnr_h3_color'] = $_POST['fntburnr_h3_color'];
$this->options['fntburnr_h3_link_color'] = $_POST['fntburnr_h3_link_color'];
$this->options['fntburnr_h3_hover_color'] = $_POST['fntburnr_h3_hover_color'];
$this->options['fntburnr_h3_underline'] = $_POST['fntburnr_h3_underline'];
$this->options['fntburnr_h3_hover_underline'] = $_POST['fntburnr_h3_hover_underline'];

$this->options['fntburnr_h4_on_off'] = $_POST['fntburnr_h4_on_off'];
$this->options['fntburnr_h4_font'] = $_POST['fntburnr_h4_font'];
$this->options['fntburnr_h4_align'] = $_POST['fntburnr_h4_align'];
$this->options['fntburnr_h4_color'] = $_POST['fntburnr_h4_color'];
$this->options['fntburnr_h4_link_color'] = $_POST['fntburnr_h4_link_color'];
$this->options['fntburnr_h4_hover_color'] = $_POST['fntburnr_h4_hover_color'];
$this->options['fntburnr_h4_underline'] = $_POST['fntburnr_h4_underline'];
$this->options['fntburnr_h4_hover_underline'] = $_POST['fntburnr_h4_hover_underline'];

$this->options['fntburnr_h1_font_v2'] = $_POST['fntburnr_h1_font_v2'];
$this->options['fntburnr_h2_font_v2'] = $_POST['fntburnr_h2_font_v2'];
$this->options['fntburnr_h3_font_v2'] = $_POST['fntburnr_h3_font_v2'];
$this->options['fntburnr_h4_font_v2'] = $_POST['fntburnr_h4_font_v2'];

$this->options['fntburnr_css_on_off'] = $_POST['fntburnr_css_on_off'];
$this->options['fntburnr_css'] = $_POST['fntburnr_css'];
                                        
                                        
                $this->saveAdminOptions();
                
                echo '<div class="updated"><p>Success! Your changes were sucessfully saved!</p></div>';
            }
?>                                   
                <div class="wrap">
<h1>Font Burner Control Panel</h1>
<p><a href="http://www.fontburner.com/"><img src="../wp-content/plugins/font-burner-control-panel/font_burner_badge4.gif" width="300" height="50" vspace="25" align ="right" /></a>This control panel gives you the ability to control how your Font Burner fonts are displayed. For more information about this plugin, please visit the <a href="http://www.fontburner.com/the-font-burner-wordpress-plugin/" title="Font Burner plugin page">Font Burner plugin page</a>. Please <a href="http://www.fontburner.com/forum/" title="visit the Font Burner Forum">visit the Font Burner forum</a> with any bugs, suggestions, or questions. Thanks for using Font Burner, and I hope you like this plugin. <a href="http://adrian3.com/" title="-Adrian 3">-Adrian3</a></p>
 

<?php
if ($this->options['fntburnr_h1_font'] != 'cuprum') {
echo '<h2>IMPORTANT: Upgrade Instructions</h2>
<p>It looks like you just upgraded your Font Burner Plugin. Thanks! First, you need to download the fonts you were using in the previous version and copy them into the "fonts" folder. This version of the plugin is significantly different from previous versions because it requires you to "self host" your fonts. This not only increases the speed of your pages because you aren\'t relying on the Font Burner servers, but it also "future-proofs" your site if Font Burner were to cease to exist. </p>

<p>If you have upgraded to this version, you can download the fonts you were using previously at the links below. After you have unzipped the download, upload the .swf file into the "fonts" folder located at ';
echo get_bloginfo('wpurl'); 
echo '/wp-content/plugins/font-burner-control-panel/fonts/. Once your fonts are uploaded they will appear in the dropdowns below.</p>
';

echo '<p><a href="http://fontburner.com/flash/';
echo $this->options['fntburnr_h1_font'] ;
echo '.swf.zip">Click here to download the ';
echo $this->options['fntburnr_h1_font'] ;
echo ' swf font file.</a></p>';
}

if ($this->options['fntburnr_h2_font'] != 'fontin_sans_bold') {

echo '<p><a href="http://fontburner.com/flash/';
echo $this->options['fntburnr_h2_font'] ;
echo '.swf.zip">Click here to download the ';
echo $this->options['fntburnr_h2_font'] ;
echo ' swf font file.</a></p>';
}

if ($this->options['fntburnr_h3_font'] != 'andron_scriptor_web') {

echo '<p><a href="http://fontburner.com/flash/';
echo $this->options['fntburnr_h3_font'] ;
echo '.swf.zip">Click here to download the ';
echo $this->options['fntburnr_h3_font'] ;
echo ' swf font file.</a></p>';
}

if ($this->options['fntburnr_h4_font'] != 'museo_300') {

echo '<p><a href="http://fontburner.com/flash/';
echo $this->options['fntburnr_h4_font'] ;
echo '.swf.zip">Click here to download the ';
echo $this->options['fntburnr_h4_font'] ;
echo ' swf font file.</a></p>';
}
 ?>


<hr><br /><br />
<h2>Customize your Font Burner settings:</h2>
                <form method="post" id="fntburnr_options">
                <?php wp_nonce_field('fntburnr-update-options'); ?>


<h2>H1 Customization</h2>
                <p>
                  <?php _e('Headline 1 (h1) On/Off<sup>1</sup>:', $this->localizationDomain); ?>
                  <select name="fntburnr_h1_on_off" id="fntburnr_h1_on_off">
                  <option selected="selected"><?php echo $this->options['fntburnr_h1_on_off'] ;?></option>
                  <option>on</option>
                  <option>off</option>
                 </select>
                </p><hr />


<div style="visibility: hidden; display:none">
<p>
<?php 
 
_e('Specify Font:<sup>3</sup>', $this->localizationDomain);

 ?>
<textarea name="fntburnr_h1_font" cols="25" rows="1" id="fntburnr_h1_font">
<?php 

echo $this->options['fntburnr_h1_font'] ;

?>
</textarea>
</p><hr />
</div>

                <p>
                <?php _e('Specify Font:<sup>2</sup>', $this->localizationDomain); ?>


<select name="fntburnr_h1_font_v2" id="fntburnr_h1_font_v2">
<option selected="selected"><?php echo $this->options['fntburnr_h1_font_v2'] ;?></option>
<?php 
// The following will list all the files (in this case swf font files) and add them to the dropdown menu 
// open this directory 
$myDirectory = opendir("../wp-content/plugins/font-burner-control-panel/fonts");
// get each entry
while($entryName = readdir($myDirectory)) {
$dirArray[] = substr($entryName, 0, -4); }
// close directory
closedir($myDirectory);
//	count elements in array
$indexCount	= count($dirArray);
// sort 'em
sort($dirArray);
// loop through the array of files and print them all
for($index=0; $index < $indexCount; $index++) {
        if (substr("$dirArray[$index]", 0, 1) != "."){ // don't list hidden files
		print("<option>$dirArray[$index]</option>
"); }} ?>
</select>

                </p>
*NEW: You can add fonts to the dropdown menu above by adding Font Burner fonts into the "fonts" folder located at <?php 	echo get_bloginfo('wpurl'); 
	echo '/wp-content/plugins/font-burner-control-panel/fonts/'; ?>. See #2 below in the help section for more details. 

<hr />


                <p>
                  <?php _e('H1 Alignment<sup>2</sup>:', $this->localizationDomain); ?>
                  <select name="fntburnr_h1_align" id="fntburnr_h1_align">
                  <option selected="selected"><?php echo $this->options['fntburnr_h1_align'] ;?></option>
                  <option>left</option>
                  <option>center</option>
                  <option>right</option>
                 </select>
                </p><hr />

                <p>
                <?php _e('Font Color:<sup>4</sup>', $this->localizationDomain); ?>
                <textarea name="fntburnr_h1_color" cols="25" rows="1" id="fntburnr_h1_color"><?php echo $this->options['fntburnr_h1_color'] ;?></textarea>
                </p><hr />


                <p>
                <?php _e('Link Color:<sup>4</sup>', $this->localizationDomain); ?>
                <textarea name="fntburnr_h1_link_color" cols="25" rows="1" id="fntburnr_h1_link_color"><?php echo $this->options['fntburnr_h1_link_color'] ;?></textarea>
                </p><hr />


                <p>
                <?php _e('Link Hover Color:<sup>4</sup>', $this->localizationDomain); ?>
                <textarea name="fntburnr_h1_hover_color" cols="25" rows="1" id="fntburnr_h1_hover_color"><?php echo $this->options['fntburnr_h1_hover_color'] ;?></textarea>
                </p><hr />


                <p>
                  <?php _e('H1 Link underline<sup>5</sup>:', $this->localizationDomain); ?>
                  <select name="fntburnr_h1_underline" id="fntburnr_h1_underline">
                  <option selected="selected"><?php echo $this->options['fntburnr_h1_underline'] ;?></option>
                  <option>underline</option>
                  <option>No underline</option>
                 </select>
                </p><hr />


                <p>
                  <?php _e('H1 Hover underline<sup>5</sup>:', $this->localizationDomain); ?>
                  <select name="fntburnr_h1_hover_underline" id="fntburnr_h1_hover_underline">
                  <option selected="selected"><?php echo $this->options['fntburnr_h1_hover_underline'] ;?></option>
                  <option>underline</option>
                  <option>No underline</option>
                 </select>
                </p><hr />

<p><input type="submit" name="fntburnr_save" value="Save" /></p>

<h2>H2 Customization</h2>
                <p>
                  <?php _e('Headline 2 (h2) On/Off<sup>1</sup>:', $this->localizationDomain); ?>
                  <select name="fntburnr_h2_on_off" id="fntburnr_h2_on_off">
                  <option selected="selected"><?php echo $this->options['fntburnr_h2_on_off'] ;?></option>
                  <option>on</option>
                  <option>off</option>
                 </select>
                </p><hr />

<div style="visibility: hidden; display:none">
<p>
<?php 
 
_e('Specify Font:<sup>3</sup>', $this->localizationDomain);

 ?>
<textarea name="fntburnr_h2_font" cols="25" rows="1" id="fntburnr_h2_font">
<?php 

echo $this->options['fntburnr_h2_font'] ;

?>
</textarea>
</p><hr />
</div>

                <p>
                <?php _e('Specify Font:<sup>2</sup>', $this->localizationDomain); ?>


<select name="fntburnr_h2_font_v2" id="fntburnr_h2_font_v2">
<option selected="selected"><?php echo $this->options['fntburnr_h2_font_v2'] ;?></option>
<?php 

for($index=0; $index < $indexCount; $index++) {
        if (substr("$dirArray[$index]", 0, 1) != "."){ // don't list hidden files
		print("<option>$dirArray[$index]</option>
"); }} ?>
</select>

                </p>
*NEW: You can add fonts to the dropdown menu above by adding Font Burner fonts into the "fonts" folder located at <?php 	echo get_bloginfo('wpurl'); 
	echo '/wp-content/plugins/font-burner-control-panel/fonts/'; ?>. See #2 below in the help section for more details. 

<hr />


                <p>
                  <?php _e('h2 Alignment<sup>2</sup>:', $this->localizationDomain); ?>
                  <select name="fntburnr_h2_align" id="fntburnr_h2_align">
                  <option selected="selected"><?php echo $this->options['fntburnr_h2_align'] ;?></option>
                  <option>left</option>
                  <option>center</option>
                  <option>right</option>
                 </select>
                </p><hr />

                <p>
                <?php _e('Font Color:<sup>4</sup>', $this->localizationDomain); ?>
                <textarea name="fntburnr_h2_color" cols="25" rows="1" id="fntburnr_h2_color"><?php echo $this->options['fntburnr_h2_color'] ;?></textarea>
                </p><hr />


                <p>
                <?php _e('Link Color:<sup>4</sup>', $this->localizationDomain); ?>
                <textarea name="fntburnr_h2_link_color" cols="25" rows="1" id="fntburnr_h2_link_color"><?php echo $this->options['fntburnr_h2_link_color'] ;?></textarea>
                </p><hr />


                <p>
                <?php _e('Link Hover Color:<sup>4</sup>', $this->localizationDomain); ?>
                <textarea name="fntburnr_h2_hover_color" cols="25" rows="1" id="fntburnr_h2_hover_color"><?php echo $this->options['fntburnr_h2_hover_color'] ;?></textarea>
                </p><hr />


                <p>
                  <?php _e('h2 Link underline<sup>5</sup>:', $this->localizationDomain); ?>
                  <select name="fntburnr_h2_underline" id="fntburnr_h2_underline">
                  <option selected="selected"><?php echo $this->options['fntburnr_h2_underline'] ;?></option>
                  <option>underline</option>
                  <option>No underline</option>
                 </select>
                </p><hr />


                <p>
                  <?php _e('h2 Hover underline<sup>5</sup>:', $this->localizationDomain); ?>
                  <select name="fntburnr_h2_hover_underline" id="fntburnr_h2_hover_underline">
                  <option selected="selected"><?php echo $this->options['fntburnr_h2_hover_underline'] ;?></option>
                  <option>underline</option>
                  <option>No underline</option>
                 </select>
                </p><hr />


<p><input type="submit" name="fntburnr_save" value="Save" /></p>

<h2>H3 Customization</h2>
                <p>
                  <?php _e('Headline 3 (h3) On/Off<sup>1</sup>:', $this->localizationDomain); ?>
                  <select name="fntburnr_h3_on_off" id="fntburnr_h3_on_off">
                  <option selected="selected"><?php echo $this->options['fntburnr_h3_on_off'] ;?></option>
                  <option>on</option>
                  <option>off</option>
                 </select>
                </p><hr />

<div style="visibility: hidden; display:none">
<p>
<?php 
 
_e('Specify Font:<sup>3</sup>', $this->localizationDomain);

 ?>
<textarea name="fntburnr_h3_font" cols="25" rows="1" id="fntburnr_h3_font">
<?php 

echo $this->options['fntburnr_h3_font'] ;

?>
</textarea>
</p><hr />
</div>

                <p>
                <?php _e('Specify Font:<sup>2</sup>', $this->localizationDomain); ?>


<select name="fntburnr_h3_font_v2" id="fntburnr_h3_font_v2">
<option selected="selected"><?php echo $this->options['fntburnr_h3_font_v2'] ;?></option>
<?php 

for($index=0; $index < $indexCount; $index++) {
        if (substr("$dirArray[$index]", 0, 1) != "."){ // don't list hidden files
		print("<option>$dirArray[$index]</option>
"); }} ?>
</select>

                </p>
*NEW: You can add fonts to the dropdown menu above by adding Font Burner fonts into the "fonts" folder located at <?php 	echo get_bloginfo('wpurl'); 
	echo '/wp-content/plugins/font-burner-control-panel/fonts/'; ?>. See #2 below in the help section for more details. 

<hr />


                <p>
                  <?php _e('h3 Alignment<sup>2</sup>:', $this->localizationDomain); ?>
                  <select name="fntburnr_h3_align" id="fntburnr_h3_align">
                  <option selected="selected"><?php echo $this->options['fntburnr_h3_align'] ;?></option>
                  <option>left</option>
                  <option>center</option>
                  <option>right</option>
                 </select>
                </p><hr />


                <p>
                <?php _e('Font Color:<sup>4</sup>', $this->localizationDomain); ?>
                <textarea name="fntburnr_h3_color" cols="25" rows="1" id="fntburnr_h3_color"><?php echo $this->options['fntburnr_h3_color'] ;?></textarea>
                </p><hr />


                <p>
                <?php _e('Link Color:<sup>4</sup>', $this->localizationDomain); ?>
                <textarea name="fntburnr_h3_link_color" cols="25" rows="1" id="fntburnr_h3_link_color"><?php echo $this->options['fntburnr_h3_link_color'] ;?></textarea>
                </p><hr />


                <p>
                <?php _e('Link Hover Color:<sup>4</sup>', $this->localizationDomain); ?>
                <textarea name="fntburnr_h3_hover_color" cols="25" rows="1" id="fntburnr_h3_hover_color"><?php echo $this->options['fntburnr_h3_hover_color'] ;?></textarea>
                </p><hr />


                <p>
                  <?php _e('h3 Link underline<sup>5</sup>:', $this->localizationDomain); ?>
                  <select name="fntburnr_h3_underline" id="fntburnr_h3_underline">
                  <option selected="selected"><?php echo $this->options['fntburnr_h3_underline'] ;?></option>
                  <option>underline</option>
                  <option>No underline</option>
                 </select>
                </p><hr />


                <p>
                  <?php _e('h3 Hover underline<sup>5</sup>:', $this->localizationDomain); ?>
                  <select name="fntburnr_h3_hover_underline" id="fntburnr_h3_hover_underline">
                  <option selected="selected"><?php echo $this->options['fntburnr_h3_hover_underline'] ;?></option>
                  <option>underline</option>
                  <option>No underline</option>
                 </select>
                </p><hr />

<p><input type="submit" name="fntburnr_save" value="Save" /></p>

<h2>H4 Customization</h2>
                <p>
                  <?php _e('Headline 4 (h4) On/Off<sup>1</sup>:', $this->localizationDomain); ?>
                  <select name="fntburnr_h4_on_off" id="fntburnr_h4_on_off">
                  <option selected="selected"><?php echo $this->options['fntburnr_h4_on_off'] ;?></option>
                  <option>on</option>
                  <option>off</option>
                 </select>
                </p><hr />

 
<div style="visibility: hidden; display:none">
<p>
<?php 
 
_e('Specify Font:<sup>3</sup>', $this->localizationDomain);

 ?>
<textarea name="fntburnr_h4_font" cols="25" rows="1" id="fntburnr_h4_font">
<?php 

echo $this->options['fntburnr_h4_font'] ;

?>
</textarea>
</p><hr />
</div>
                <p>
                <?php _e('Specify Font:<sup>2</sup>', $this->localizationDomain); ?>


<select name="fntburnr_h4_font_v2" id="fntburnr_h4_font_v2">
<option selected="selected"><?php echo $this->options['fntburnr_h4_font_v2'] ;?></option>
<?php 

for($index=0; $index < $indexCount; $index++) {
        if (substr("$dirArray[$index]", 0, 1) != "."){ // don't list hidden files
		print("<option>$dirArray[$index]</option>
"); }} ?>
</select>

                </p>
*NEW: You can add fonts to the dropdown menu above by adding Font Burner fonts into the "fonts" folder located at <?php 	echo get_bloginfo('wpurl'); 
	echo '/wp-content/plugins/font-burner-control-panel/fonts/'; ?>. See #2 below in the help section for more details. 

<hr />



                <p>
                  <?php _e('h4 Alignment<sup>2</sup>:', $this->localizationDomain); ?>
                  <select name="fntburnr_h4_align" id="fntburnr_h4_align">
                  <option selected="selected"><?php echo $this->options['fntburnr_h4_align'] ;?></option>
                  <option>left</option>
                  <option>center</option>
                  <option>right</option>
                 </select>
                </p><hr />


                <p>
                <?php _e('Font Color:<sup>4</sup>', $this->localizationDomain); ?>
                <textarea name="fntburnr_h4_color" cols="25" rows="1" id="fntburnr_h4_color"><?php echo $this->options['fntburnr_h4_color'] ;?></textarea>
                </p><hr />


                <p>
                <?php _e('Link Color:<sup>4</sup>', $this->localizationDomain); ?>
                <textarea name="fntburnr_h4_link_color" cols="25" rows="1" id="fntburnr_h4_link_color"><?php echo $this->options['fntburnr_h4_link_color'] ;?></textarea>
                </p><hr />


                <p>
                <?php _e('Link Hover Color:<sup>4</sup>', $this->localizationDomain); ?>
                <textarea name="fntburnr_h4_hover_color" cols="25" rows="1" id="fntburnr_h4_hover_color"><?php echo $this->options['fntburnr_h4_hover_color'] ;?></textarea>
                </p><hr />


                <p>
                  <?php _e('h4 Link underline<sup>5</sup>:', $this->localizationDomain); ?>
                  <select name="fntburnr_h4_underline" id="fntburnr_h4_underline">
                  <option selected="selected"><?php echo $this->options['fntburnr_h4_underline'] ;?></option>
                  <option>underline</option>
                  <option>No underline</option>
                 </select>
                </p><hr />


                <p>
                  <?php _e('h4 Hover underline<sup>5</sup>:', $this->localizationDomain); ?>
                  <select name="fntburnr_h4_hover_underline" id="fntburnr_h4_hover_underline">
                  <option selected="selected"><?php echo $this->options['fntburnr_h4_hover_underline'] ;?></option>
                  <option>underline</option>
                  <option>No underline</option>
                 </select>
                </p><hr />

<p><input type="submit" name="fntburnr_save" value="Save" /></p>

<h2>CSS Customization</h2>
                <p>
                  <?php _e('Custom CSS On/Off<sup>6</sup>:', $this->localizationDomain); ?>
                  <select name="fntburnr_css_on_off" id="fntburnr_css_on_off">
                  <option selected="selected"><?php echo $this->options['fntburnr_css_on_off'] ;?></option>
                  <option>on</option>
                  <option>off</option>
                 </select>
                </p><hr />

				<p>
                <?php _e('Custom CSS*:<sup>6</sup>', $this->localizationDomain); ?>
                <textarea name="fntburnr_css" cols="45" rows="10" id="fntburnr_css"><?php echo $this->options['fntburnr_css'] ;?></textarea>
        		</p>


                <hr />


<p><input type="submit" name="fntburnr_save" value="Save" /></p>

<h1>Help</h1>
<h2>1. Turn On/Off</h2>
<p>If you do not want to use Font Burner on some of your headlines this is where you can turn it off. This can be handy if you only want to use Font Burner on certain H tags. To turn Font Burner off for a certain Headline select "off" from this dropdown. </p>
<h2>2. Specify Font</h2>
<p>This box is where you will select the font name that you would like to change your headlines to. The fonts listed in the dropdown are some of the most popular Font Burner fonts. You can add to this list by adding .swf font files into the "fonts" folder located at <?php 	echo get_bloginfo('wpurl'); 
	echo '/wp-content/plugins/font-burner-control-panel/fonts/'; ?>. Where do you get these files? Well, you need to go to <a href="http://www.fontburner.com/fonts/" title="free fonts">www.fontburner.com/fonts</a> and download them. The Font Burner Website has over 1000 fonts that you can download and use on your website for free. Note: the files that you download must be unzipped. This will give you a .swf file, which is what you need to upload. After uploading the font file it will appear in the dropdown menu above.
</p>

<h2>3. Alignment</h2>
<p>This option allows you to change the alignment to right, left, or center.</p>
<h2>4. Link Underline Settings</h2>
<p>This is an easy one. If you want your links to be underlined simply check the "underline" checkbox. If you don't want links to be underlined check "none." The second box sets the "hover" color. That means that when the mouse is over the link you can set whether there is an underline or not.</p>

<h2>5. Font Color</h2>
<p>This box is where you enter the color that you would like your headlines to be. This is a six digit hexadecimal number. For example, "ffffff" is white and "000000" is black. A google search can help you figure out how hexadecimal colors work if you are unfamiliar with them. You do not need to enter a "#" before this number. The "Link Color"" allows you to have your links be a different color than the "normal" headline. The "Link Hover Color" specifies the color that the links will be when the mouse rolls over them.</p>
<h2>6. CSS Customization</h2>
<p>Certain Font Burner Fonts need to be fine-tuned and this is where you will do it. The CSS options here are for line-height and font-size. By default, This box contains: </p>
<p>.sIFR-active h1 {<br />
line-height: 1.2em;<br />
font-size: 16px;<br />
visibility: hidden;<br />
}<br />
.sIFR-active h2 {<br />
line-height: 1.2em;<br />
font-size: 15px;<br />
visibility: hidden;<br />
}<br />
.sIFR-active h3 {<br />
line-height: 1.2em;<br />
font-size: 14px;<br />
visibility: hidden;<br />
}<br />
.sIFR-active h4 {<br />
line-height: 1.2em;<br />
font-size: 13px;<br />
visibility: hidden;<br />
}</p>
<p>Use that as a starting point and adjust accordingly.</p>

<h2>Save Button</h2>
The "save" button will save your settings. Any time you make a change remember to click "Save."

                        <tr>
                            <th colspan=2><input type="submit" name="fntburnr_save" value="Save" /></th>
                        </tr>
                    </table>
                </form>


<?php
        }

  } //End Class
} //End if class exists statement

//instantiate the class
if (class_exists('fntburnr')) {
    $fntburnr_var = new fntburnr();
}
?>