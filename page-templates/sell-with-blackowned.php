<?php
/**
 * Template Name: sell-with-blackowned
 *
 * This is the template that displays why-sell-with-us template.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package blackowned
 */

get_header();
var_dump(get_the_ID());
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
