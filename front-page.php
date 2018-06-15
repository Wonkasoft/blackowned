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
<?php 
$featured_image_1 =  ( ! get_theme_mod( 'featured_image_1' ) ) ? '' : get_theme_mod( 'featured_image_1' );
if ( $featured_image_1 == '' ) :

else :
?>
<section class="container content-section">
	<div class="row">
		<div class="col text-center">
			<h2>Featured Categories</h2>
		</div> <!-- /col -->
	</div> <!-- /row -->
	<div class="row justify-content-center">
		<ul class="featured-images">
	<?php 
/**
 * This is the end of the check for the first featured image
 * then load section
 */
endif;

		for ($i=1; $i < 4; $i++) :
			$featured_image = ( ! get_theme_mod( 'featured_image_'.$i ) ) ? '' : get_theme_mod( 'featured_image_'.$i );
		if ( $featured_image != '' ) :
	?>
			
			<li class="featured-item"><img src="<?php echo $featured_image; ?>" /></li>
<?php

/**
 * This is the end of the check for featured images
 */
endif;

 /**
 * This is the end of the for loop that loads all featured images
 */
endfor; ?>
		</ul> <!-- /ul -->
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