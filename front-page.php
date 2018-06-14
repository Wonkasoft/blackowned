<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 * @since  1.0.0 [<init>]
 * @package blackowned
 */

get_header();

$slide_image = ( !get_theme_mod( 'slide_image' ) ) ? get_template_directory_uri() . '/assets/img/default-slide-image.jpg': get_theme_mod( 'slide_image' );
?>
<section id="primary" class="container">
		<div class="row justify-content-center">
			<div class="col">
				<img src="<?php echo $slide_image; ?>">
			</div> <!-- .col -->
		</div> <!-- .row -->
</section><!-- #primary -->
<section class="container content-section">
	<div class="row">
		<div class="col text-center">
			<h2>Featured Categories</h2>
		</div> <!-- /col -->
	</div> <!-- /row -->
	<div class="row justify-content-center">
		<div class="col text-center">
			

			
		</div> <!-- /col -->
	</div> <!-- /row -->
</section> <!-- .container-fluid contemt-section -->
<?php 
$ig_code =  ( ! get_theme_mod( 'ig_code' ) ) ? '' : get_theme_mod( 'ig_code' );
if ( $ig_code == '' ) :

else :
?>
<section class="container content-section">
<?php 
	$follow_message =  ( ! get_theme_mod( 'follow_message' ) ) ? '' : get_theme_mod( 'follow_message' );
	if ( $follow_message == '' ) :

else :
?>
	<div class="row">
		<div class="col text-center">
			<h2><?php echo $follow_message; ?></h2>
		</div> <!-- /col -->
	</div> <!-- /row -->
<?php
endif;
?>
	<div class="row justify-content-center">
		<div class="col text-center">
	<?php echo do_shortcode( $ig_code ); ?>
		</div> <!-- /col -->
	</div> <!-- /row -->
</section> <!-- .container-fluid contemt-section -->
<?php
endif;
?>
			






<?php 
get_footer();