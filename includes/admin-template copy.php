<?php



add_filter( 'theme_page_templates', 'pt_add_page_template_to_dropdown' );
add_filter( 'template_include', 'pt_change_page_template', 99 );
add_action( 'wp_enqueue_scripts', 'pt_remove_style' );

/**
 * Add page templates.
 *
 * @param  array $templates  The list of page templates
 *
 * @return array  $templates  The modified list of page templates
 */
function pt_add_page_template_to_dropdown( $templates ) {
	$templates[ plugin_dir_path( __FILE__ ) . 'templates/page-admin.php' ] = __( 'Page Template From Plugin', 'text-domain' );

	return $templates;
}

/**
 * Change the page template to the selected template on the dropdown
 *
 * @param $template
 *
 * @return mixed
 */
function pt_change_page_template( $template ) {
	if ( is_page() ) {
		$meta = get_post_meta( get_the_ID() );

		if ( ! empty( $meta['_wp_page_template'][0] ) && $meta['_wp_page_template'][0] != $template ) {
			$template = $meta['_wp_page_template'][0];
		}
	}

	return $template;
}

function pt_remove_style() {
	// Change this "my-page" with your page slug
	if ( is_page( 'my-page' ) ) {
		$theme = wp_get_theme();

		$parent_style = $theme->stylesheet . '-style';

		wp_dequeue_style( $parent_style );
		wp_deregister_style( $parent_style );
		wp_deregister_style( $parent_style . '-css' );
	}
}
