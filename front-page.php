<?php
/**
* The template for displaying all single posts
*
* @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
* @since  1.0.0 [<init>]
* @package blackowned
*/

get_header();

$woo_cats = get_categories( array ('taxonomy' => 'product_cat','orderby' => 'name', 'order' => 'asc', 'hide_empty' => false ) );
$slider_array = custom_arrays_function( 'slider-array' );
$slide_image = ( !$slider_array ) ? get_template_directory_uri() . '/assets/img/default-slide-image.jpg': '';

?>
<section id="primary" class="container">
	<div class="row justify-content-center">
		<div class="col">
			<?php 
			if ( !$slider_array ) : ?>
				<img src="<?php echo $slide_image; ?>">
				<?php else : ?>
					<div class="wonka-slider-wrap">
						<!-- uncomment tag to activate the left control -->
						<!-- <a class="left-control control-btn"  role=left data-slider-btn="previous"><i class="fa fa-chevron-left" aria-hidden="true"></i></a> -->

						<!-- uncomment tag to activate the right control -->
						<!-- <a class="right-control control-btn" role=right data-slider-btn="next"><i class="fa fa-chevron-right" aria-hidden="true"></i></a> -->
						<ul id="wonka-slider-1" class="wonka-slider-images">
							<?php 
							$i=1;
							while ( $i <= count( $slider_array ) ) :
								$slide_image = ( ! get_theme_mod( array_keys( $slider_array )[$i-1] ) ) ? '' : get_theme_mod( array_keys( $slider_array )[$i-1] );
								?>

								<li class="wonka-slider-item wonka-slider-item-<?php echo $i; ?>"><img src="<?php echo $slide_image; ?>" /></li>
								<?php
								$i++;
/**
* This is the end of the for loop that loads all featured images
*/
endwhile; ?>
</ul> <!-- /ul -->
<ol class="slider-indicators">
	<?php 
	$i=1;
	while ( $i <= count( $slider_array ) ) :
		$slide_image = ( ! get_theme_mod( array_keys( $slider_array )[$i-1] ) ) ? '' : get_theme_mod( array_keys( $slider_array )[$i-1] );
		?>
		<li class="indicator-dot indicator-dot-<?php echo $i; ?>"><div class="img-wrap" style="background: url('<?php echo $slide_image; ?>');background-size: cover; background-position: center center;"></div></li>
		<?php
		$i++;
/**
* This is the end of the for loop that loads all featured images
*/
endwhile; ?>
</ol> <!-- /slider-indicators -->
</div> <!-- /wonka-slider-wrap -->
<?php endif; ?>
</div> <!-- .col -->
</div> <!-- .row -->
</section><!-- #primary -->
<?php 

if ( $woo_cats ) :
	global $woo_cats;
	?>
	<section id="featured-items-section" class="container content-section">
		<div class="row">
			<div class="col text-center">
				<?php	
				if ( count( $woo_cats ) > 1 ) :
					?>
					<h2>Featured Categories</h2>
					<?php
				else :
					?>
					<h2>Featured Category</h2>
					<?php
				endif;
				?>
			</div> <!-- /col -->
		</div> <!-- /row -->
		<?php
		get_template_part( 'template-parts/content', 'featured' );
		?>
	</section> <!-- .container-fluid contemt-section -->

	<?php
/**
* This is the end of the check for the first featured image
* then load section
*/
endif;


$ig_code =  ( ! get_theme_mod( 'ig_code' ) ) ? '' : get_theme_mod( 'ig_code' );
if ( $ig_code != '' ) :
	?>
	<section id="follow-me-section" class="container content-section">
		<?php 
		$follow_message =  ( ! get_theme_mod( 'follow_message' ) ) ? '' : get_theme_mod( 'follow_message' );
		if ( $follow_message != '' ) :

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

get_footer();