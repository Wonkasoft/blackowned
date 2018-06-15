<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 * @since  1.0.0 [<init>]
 * @package blackowned
 */
?>

</div><!-- #content -->
<footer id="colophon" class="site-footer container-fluid">
	<div class="row">
		<div class="col-3 footer-left footer-section">
			<div class="row">
				<div class="col col-md-10 text-center">
					<div class="footer-logo">
					<?php 
					$footer_logo =  ( ! get_theme_mod( 'footer_logo' ) ) ? '' : get_theme_mod( 'footer_logo' );
					$copyright = ( ! get_theme_mod( 'copyright' ) ) ? '' : get_theme_mod( 'copyright' );
					if ( $footer_logo == '' ) :

					else :
					?>
						<img src="<?php echo $footer_logo; ?>" />
					<?php
					endif;
					?>
					</div> <!-- /footer-logo -->
				</div> <!-- /col -->
			</div> <!-- /row -->
			<?php
			/**
			 * Copyright Area
			 * Check to make sure this copyright information is loaded and print to the screen if it is
			 * @var [String]
			 */
			if ( $copyright == '' ) :
				// Do not show this area
			else : ?>
			<div class="row">
				<div class="col col-md-10">
					<div class="copy-wrap">
						&copy; <?php echo date( 'Y' ).' '; echo $copyright; ?>
					</div> <!-- /copy-wrap -->
				</div> <!-- /col -->
			</div> <!-- /row -->
			<?php endif; ?>
		</div> <!-- .col-4 -->
		<div class="col-6 footer-left footer-section">
			<div class="row">
				<div class="col text-left">
					<h3 class="font-upper">Categories</h3>
				</div> <!-- /col -->
				<div class="col text-left">
					<h3 class="font-upper">Info</h3>
				</div> <!-- /col -->
				<div class="col text-left">
					<h3 class="font-upper">Services</h3>
				</div> <!-- /col -->
			</div> <!-- /row -->
			<div class="row">
				<div class="col">
					<?php
					wp_nav_menu( array(
						'theme_location' => 'footer-menu1',
						'menu_id'        => 'footer-1',
					) );
					?>
				</div> <!-- /col -->
				<div class="col">
					<?php
					wp_nav_menu( array(
						'theme_location' => 'footer-menu2',
						'menu_id'        => 'footer-2',
					) );
					?>
				</div> <!-- /col -->
				<div class="col">
					<?php
					wp_nav_menu( array(
						'theme_location' => 'footer-menu3',
						'menu_id'        => 'footer-3',
					) );
					?>
				</div> <!-- /col -->
			</div> <!-- /row -->
		</div> <!-- .col-4 -->
		<div class="col-3 footer-right footer-section">
			<div class="row">
				<div class="col text-center">
					We’ ll keep you posted:
				</div> <!-- /col text-center -->
				<div class="col text-center">
					<?php 
					$snapchat = ( ! get_theme_mod( 'snapchat' ) ) ? '' : get_theme_mod( 'snapchat' );
					$instagram = ( ! get_theme_mod( 'instagram' ) ) ? '' : get_theme_mod( 'instagram' );
					$facebook = ( ! get_theme_mod( 'facebook' ) ) ? '' : get_theme_mod( 'facebook' );
					$twitter = ( ! get_theme_mod( 'twitter' ) ) ? '' : get_theme_mod( 'twitter' );
					$yelp = ( ! get_theme_mod( 'yelp' ) ) ? '' : get_theme_mod( 'yelp' );
					
					/**
					 * SnapChat
					 * Check to make sure this social is loaded and print to the screen if it is
					 * @var [String]
					 */
					if ( $snapchat == '' ) :

					else : ?>
						<span class="circle-icon"><a href="<?php echo $snapchat; ?>"><i class="fa fa-snapchat"></i></a></span>
					<?php endif;
					/**
					 * Twitter
					 * Check to make sure this social is loaded and print to the screen if it is
					 * @var [String]
					 */
					if ( $twitter == '' ) :

					else : ?>
						<span class="circle-icon"><a href="<?php echo $twitter; ?>"><i class="fa fa-twitter"></i></a></span>
					<?php endif;
					/**
					 * Facebook
					 * Check to make sure this social is loaded and print to the screen if it is
					 * @var [String]
					 */
					if ( $facebook == '' ) :

					else : ?>
						<span class="circle-icon"><a href="<?php echo $facebook; ?>"><i class="fa fa-facebook"></i></a></span>
					<?php endif;
						/**
					 * Instagram
					 * Check to make sure this social is loaded and print to the screen if it is
					 * @var [String]
					 */
					if ( $instagram == '' ) :

					else : ?>
						<span class="circle-icon"><a href="<?php echo $instagram; ?>"><i class="fa fa-instagram"></i></a></span>
					<?php endif;
						/**
					 * Yelp
					 * Check to make sure this social is loaded and print to the screen if it is
					 * @var [String]
					 */
					if ( $yelp == '' ) :

					else : ?>
						<span class="circle-icon"><a href="<?php echo $yelp; ?>"><i class="fa fa-yelp"></i></a></span>
					<?php endif; ?>
				</div> <!-- /col -->
			</div> <!-- /row -->

			<div class="row design-cred">
				<div class="col text-center">
					<?php
					$design_credits = ( ! get_theme_mod( 'design_credits' ) )	? '' : get_theme_mod( 'design_credits' );
					if ( $design_credits == '' ) :

					else : ?>
						<p> <?php echo $design_credits; ?> </p>
					<?php endif; ?>
				</div> <!-- /col -->
			</div> <!-- /row -->
		</div> <!-- .col -->
	</div> <!-- .row -->
</footer><!-- #colophon -->
</div><!-- #page -->
<?php wp_footer(); ?>
</body>
</html>
