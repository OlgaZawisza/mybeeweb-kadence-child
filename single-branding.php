<?php
/**
 * Single template for CPT: branding
 * Routes to template-parts/branding/layout-{name}.php
 *
 * @package MyBeeWeb-Child-Kadence-Theme
 */

get_header();

if ( have_posts() ) {
	while ( have_posts() ) {
		the_post();
		$layout = function_exists( 'get_field' ) ? ( get_field( 'branding_layout' ) ?: 'default' ) : 'default';
		get_template_part( 'template-parts/branding/layout', $layout );
	}
}

get_footer();
