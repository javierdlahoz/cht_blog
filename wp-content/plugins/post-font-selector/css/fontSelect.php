<?php
ob_start();
require_once(realpath(dirname(__FILE__).'/../../../../').'/wp-load.php' );
$nothing = ob_get_clean();
global $wpdb;


$q = sprintf("SELECT * FROM %sfonts ORDER BY type ASC, name ASC",
				$wpdb->prefix);
$fonts = $fonts2 = $wpdb->get_results($q);

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