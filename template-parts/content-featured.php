<?php
/**
 * Template part for displaying featured section modules in front-page.php
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 * @since  1.0.0 [<init>]
 * @package blackowned
 */

$i = 1;
global $woo_cats;
foreach ( $woo_cats as $cat ) :
	$thumbnail_id = get_woocommerce_term_meta( $cat->term_id, 'thumbnail_id', true ); 
	$image = wp_get_attachment_url( $thumbnail_id );
	if ( $i == 1 ) : ?>
		<div class="row featured-modules-row">
			<div class="featured-module">
				<div class="img-container">
					<img src="<?php echo $image ?>" />
				</div> <!-- /img-container -->
				<h5><?php echo $cat->name; ?></h5>
			</div> <!-- /featured-module -->
	<?php elseif ( $i == count( $woo_cats ) ) : ?>
			<div class="featured-module">
				<div class="img-container">
					<img src="<?php echo $image ?>" />
				</div> <!-- /img-container -->
				<h5><?php echo $cat->name; ?></h5>
			</div> <!-- /featured-module -->
		</div> <!-- /row -->
	<?php else : ?>
		<div class="featured-module">
			<div class="img-container">
				<img src="<?php echo $image ?>" />
			</div> <!-- /img-container -->
			<h5><?php echo $cat->name; ?></h5>
		</div> <!-- /featured-module -->
	<?php endif;
	$i++;
endforeach;