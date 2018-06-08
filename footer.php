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
		<div class="col-4 footer-left footer-section">
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
			<div class="row">
				<div class="col col-md-10">
					<div class="copy-wrap">
						&copy; <?php echo date( 'Y' ).' '; echo $copyright; ?>
					</div> <!-- /copy-wrap -->
				</div> <!-- /col -->
			</div> <!-- /row -->
		</div> <!-- .col-4 -->
		<div class="col-4 footer-center footer-section">
			<div class="row">
				<div class="col text-center">
					<h3 class="font-upper">Resources</h3>
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
			</div> <!-- /row -->
		</div> <!-- .col-4 -->
		<div class="col-4 footer-right footer-section">
			<div class="row">
				<div class="col text-center">
					<h3 class="font-upper">Social Presence</h3>
				</div> <!-- /col -->
			</div> <!-- /row -->
			<div class="row">
				<div class="col text-center">
					<?php 
					$twitter = ( ! get_theme_mod( 'twitter' ) ) ? '' : get_theme_mod( 'twitter' );
					$facebook = ( ! get_theme_mod( 'facebook' ) ) ? '' : get_theme_mod( 'facebook' );
					$instagram = ( ! get_theme_mod( 'instagram' ) ) ? '' : get_theme_mod( 'instagram' );
					if ( $facebook == '' ) :

					else : ?>
						<span class="circle-icon"><a href="<?php echo $twitter; ?>"><i class="fa fa-twitter"></i></a></span>
					<?php endif;

					if ( $twitter == '' ) :

					else : ?>
						<span class="circle-icon"><a href="<?php echo $facebook; ?>"><i class="fa fa-facebook"></i></a></span>
					<?php endif;

					if ( $instagram == '' ) :

					else : ?>
						<span class="circle-icon"><a href="<?php echo $instagram; ?>"><i class="fa fa-instagram"></i></a></span>
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
