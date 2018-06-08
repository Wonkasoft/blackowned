<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 * @since  1.0.0 [<init>]
 * @package blackowned
 */

get_header();

$main_image = ( !get_theme_mod( 'main_image' ) ) ? get_template_directory_uri() . '/assets/img/default-header-image.jpg': get_theme_mod( 'main_image' );
?>
<section id="backdrop" class="container-fluid" style="background: url('<?php echo $main_image; ?>') no-repeat;background-position: center center;background-size: cover;"></section>
<section id="primary" class="container-fluid">
		<div class="row justify-content-center">
			<div class="col col-4">
				<h1 class="arrow-message">
					<span class="top-row-message"><span class="keep-word">Keep</span><span class="upper-message calm-word"> Calm</span>
					we can help</span><span class="bottom-row-message">buy your house <span class="upper-message">fast</span></span>
				</h1> <!-- .arrow-message -->
			</div> <!-- .col -->
		</div> <!-- .row -->
		<div class="row justify-content-center">
			<div class="col col-8">
				<form id="address-submit" action method="post">
					<div class="form-fields-wrap">
						<span class="marker-wrap"><i class="fa fa-map-marker"></i></span>
						<input id="autocomplete" onFocus="geolocate()" type="address" size="35" name="address" placeholder="Enter your address..." />
						<input type="submit" name="submit_btn" value="Get Help Now!" />
					</div>
				</form>
			</div> <!-- .col -->
		</div> <!-- .row -->
</section><!-- #primary -->
<section class="container-fluid content-section">
	<div class="row">
		<div class="col text-center">
			<h1 class="problem-section-title">Do you have a problem house?</h1>
		</div> <!-- /col -->
	</div> <!-- /row -->
	<div class="row justify-content-center">
		<div class="col-6 text-center">
			<p class="problem-content"><span>Black Owned</span> can purchase your home fast to help in situations such 
				back taxes, divorce, vacancies, bad tenants, relocation, foreclosure,probate or just looking for
				hassle-free sale of your home. Let us help you!
			</p>
		</div> <!-- /col -->
	</div> <!-- /row -->
	<div class="row justify-content-center">
		<div class="col col-md-6 text-center">
			<div class="referral-wrap">
			<i class="yellow-circle"><img src="<?php echo get_theme_file_uri( '/assets/img/blue-knot.png' ); ?>" /></i><span class="referral-content">*Do not forget, we pay for referrals!
			</span>
		</div> <!-- /referral-wrap -->
		</div> <!-- /col -->
	</div> <!-- /row -->
</section> <!-- .container-fluid contemt-section -->
<?php
	$testimonial_image = ( !get_theme_mod( 'testimonial_image' ) ) ? '' : get_theme_mod( 'testimonial_image' );
	if ( $testimonial_image == '' ) :

	else :
?>
<section id="testimonials" class="container-fluid content-section" style="background-image: linear-gradient( rgba( 255, 255, 255, .7 ), rgba( 255, 255, 255, .7 )), url( '<?php echo $testimonial_image; ?>' ); background-blend-mode: screen; background-position: center top;background-size: cover;">
	<div class="row justify-content-center">
		<div class="col col-md-8 text-center">
			<h1 class="testimonial-section-title"><span class="keep-word">Keep</span><span class="calm-word"> calm</span> Testimonials</h1>
		</div> <!-- /col -->
	</div> <!-- /row -->
	<?php
	$args = array(
		'post_type' 			=> 'testimonial_post',
		'posts_per_page' 	=> 4
	);
	$loop = new WP_Query( $args );
	$counter = 1;
	if ( $loop->have_posts() ) : while ( $loop-> have_posts() ) : $loop->the_post(); 
		$name = get_the_title();
		$excerpt = get_the_excerpt();
		$link = get_the_permalink();
		?>
		<div class="row justify-content-center">
			<div class="col col-md-4">
				<div class="testimonial-module" id="testimonial-module-<?php echo $counter; ?>">
					<?php echo '<span class="name">'.$name. '</span> <span class="testimonial-quote">' .$excerpt. ' ... </span>'; ?><a href="<?php echo $link; ?>">Read more</a>
				</div> <!-- /testimonial-module -->
			</div> <!-- /col -->
		</div> <!-- /row -->
		<?php
		$counter++;
		endwhile;
	endif;
wp_reset_postdata();
?>
</section> <!-- .container-fluid content-section -->
<?php
endif;
?>
<section class="grid-section">
	<div class="row no-gutters">
		<?php 
		for ($i = 1; $i < 7; $i++) :
			$grid_image_title = ( !get_theme_mod( 'grid_image_title' . $i ) ) ? '' : get_theme_mod( 'grid_image_title' . $i );
			$grid_image = ( !get_theme_mod( 'grid_image_' . $i ) ) ? get_template_directory_uri() . '/assets/img/default-grid-image-' . $i . '.jpg': get_theme_mod( 'grid_image_' . $i );
			$grid_image_decription = ( !get_theme_mod( 'grid_image_description' . $i ) ) ? '' : get_theme_mod( 'grid_image_description' . $i );
			if ( $i == 1 || $i == 5 ) :
				?>
				<div class="col col-md-6 masonary-grid-img photo-masonary-grid-<?php echo $i ?>" style="background: url(<?php echo $grid_image; ?>);background-position: center center;background-size: cover;">
					<div class="text-wrap">
						<?php
							if ( $grid_image_title != '' ) :
							echo '<h2>'.$grid_image_title.'</h2>';
						  echo '<p>'.$grid_image_decription.'</p>';
						endif;
						?>
					</div>
				</div> <!-- .col -->

				<?php
			else :
				?>
				<div class="col col-md-3 masonary-grid-img photo-masonary-grid-<?php echo $i ?>" style="background: url(<?php echo $grid_image; ?>);background-position: center center;background-size: cover;">
					<div class="text-wrap">
						<?php
							if ( $grid_image_title != '' ) :
							echo '<h2>'.$grid_image_title.'</h2>';
						  echo '<p>'.$grid_image_decription.'</p>';
						endif;
						?>
					</div>
				</div> <!-- .col -->
				<?php
			endif;
		endfor;
		?>
	</div> <!-- .row -->
</section> <!-- .container-fluid content-section -->

<?php
	$contact_bg_image = ( !get_theme_mod( 'contact_bg' ) ) ? '' : get_theme_mod( 'contact_bg' );
	$contactform = ( !get_theme_mod( 'contact_form' ) ) ? '' : get_theme_mod( 'contact_form' );
	if ( $contactform == '' ) :

	else :
?>
<section class="container-fluid contact-section" style="background:url( '<?php echo $contact_bg_image; ?>' ) no-repeat;background-position: center top;background-size: cover;">
	<div class="row">
		<div class="col">
			<div class="contact-form-wrap">
				<?php echo do_shortcode( $contactform, true ); ?>
			</div>
		</div> <!-- .col -->
	</div> <!-- .row -->
</section> <!-- .container-fluid content-section -->
<?php 
endif; 
get_footer();