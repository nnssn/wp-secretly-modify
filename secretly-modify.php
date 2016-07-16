<?php

/*
Plugin Name: secretly modify
Plugin URI: https://github.com/nnssn/wp-secretly-modify
Description: Add the option "No change the update datetime." to the edit page (feed is not updated)
Version: 0.1
Author: nnssn
Author URI: https://github.com/nnssn
License: GPL2
*/


add_action( 'admin_menu', function () {
	load_plugin_textdomain( 'secretly-modify', 'wp-content/plugins/secretly-modify' );
	$metabox_label = __( 'secretly modify', 'secretly-modify' );
	add_meta_box( 'html_secretly_modify', $metabox_label, 'html_secretly_modify', 'post', 'side', 'high' );
});

function html_secretly_modify() {
$text = __( 'No change the update datetime.', 'secretly-modify' );
echo <<< EOM
<div id="secretly-modify">
<input type="hidden" name="secretly_modify" value="0">
<label><input type="checkbox" name="secretly_modify" value="1">{$text}</label>
</div>
EOM;
}

add_filter( 'wp_insert_post_data', function ( $data, $postarr ) {
	if ( filter_input( INPUT_POST, 'secretly_modify' )
	&& filter_input( INPUT_POST, 'original_post_status' ) === 'publish' ) {
		do_action( 'secretly_modify' );
		unset( $data["post_modified"] );
		unset( $data["post_modified_gmt"] );
	}
	return $data;
}, 10, 2 );
