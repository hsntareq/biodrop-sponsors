<?php

add_filter( 'template_include', 'sponsors_admin_page_template', 1000, 1 );
function sponsors_admin_page_template( $template ) {
	global $wp_query;

	// if ( get_query_var( 'sponsors' ) ) {
		$new_template = plugin_dir_path( __FILE__ ) . 'templates/page-admin.php';
	if ( file_exists( $new_template ) ) {
		$template = $new_template;
	}
	// }
	return $template;
}


/*
add_filter( 'generate_rewrite_rules', 'site_custom_endpoint' );
add_action( 'init', 'foo_add_rewrite_rule' );
function foo_add_rewrite_rule() {
	add_rewrite_rule( '^foobar?', 'index.php?is_foobar_page=1&post_type=custom_post_type', 'top' );
	// Customize this query string - keep is_foobar_page=1 intact
}

add_action( 'query_vars', 'foo_set_query_var' );
function foo_set_query_var( $vars ) {
	array_push( $vars, 'is_foobar_page' );
	return $vars;
}

add_filter( 'template_include', 'foo_include_template', 1000, 1 );
function foo_include_template( $template ) {
	if ( get_query_var( 'is_foobar_page' ) ) {
		$new_template = plugin_dir_path( __FILE__ ) . 'templates/page-admin.php';
		if ( file_exists( $new_template ) ) {
			$template = $new_template;
		}
	}
	return $template;
}
 */
