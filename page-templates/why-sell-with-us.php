<?php
/**
 * Template Name: why-sell-with-us
 *
 * This is the template that displays why-sell-with-us template.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package blackowned
 */

get_header();
global $WCMP_Vendor_Membership, $WCMp;
$current_user = wp_get_current_user();
if (function_exists('is_user_wcmp_vendor')) {
    $is_vendor = is_user_wcmp_vendor($current_user);
} elseif (function_exists('is_user_wcmp_pending_vendor')) {
    $is_pending_vendor = is_user_wcmp_pending_vendor($current_user);
}
$global_settings = $WCMP_Vendor_Membership->get_global_settings();
?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main container">

		<?php
		while ( have_posts() ) :
			the_post();

			get_template_part( 'template-parts/content', 'page' );

			// If comments are open or we have at least one comment, load up the comment template.
			if ( comments_open() || get_comments_number() ) :
				comments_template();
			endif;

		endwhile; // End of the loop.
		?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_footer();
