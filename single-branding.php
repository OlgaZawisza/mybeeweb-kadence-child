<?php
/**
 * Single template for CPT: branding
 * Routes to template-parts/branding/layout-{name}.php
 *
 * @package MyBeeWeb-Child-Kadence-Theme
 */

get_header();

\Kadence\kadence()->print_styles( 'kadence-content' );

do_action( 'kadence_hero_header' );
?>
<div id="primary" class="content-area">
	<div class="content-container site-container">
		<div id="main" class="site-main">
			<?php do_action( 'kadence_before_main_content' ); ?>
			<div class="content-wrap">
				<?php
				if ( have_posts() ) {
					while ( have_posts() ) {
						the_post();
						$layout = function_exists( 'get_field' ) ? ( get_field( 'branding_layout' ) ?: 'default' ) : 'default';
						get_template_part( 'template-parts/branding/layout', $layout );
					}
				}
				?>
			</div>
			<?php do_action( 'kadence_after_main_content' ); ?>
		</div>
	</div>
</div>
<?php
get_footer();
