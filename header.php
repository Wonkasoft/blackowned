<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package blackowned
 * @since  1.0.0 init
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
	<div id="page" class="site">
		<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'blackowned' ); ?></a>

		<header id="masthead" class="site-header">
			<div class="container menu-bar">
				<div class="row">
					<div class="col-md-2">
						<div class="custom-logo">
							<?php
							$custom_logo = wp_get_attachment_image_src( get_theme_mod( 'custom_logo' ), 'full');
							if ( ! empty( $custom_logo ) ): ?>
								<div class="site-logo"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><img src="<?php echo esc_url( $custom_logo[0] ); ?>" alt="<?php bloginfo( 'name' ); ?>"/></a></div> 
								<?php
							else :
								?>
								<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
								<?php
								$blackowned_description = get_bloginfo( 'description', 'display' );
								if ( $blackowned_description || is_customize_preview() ) :
									?>
								<p class="site-description"><?php echo $blackowned_description; /* WPCS: xss ok. */ ?></p>
							<?php endif; 
							endif; ?>

						</div> <!-- .custom-logo -->
					</div> <!-- .col-2 -->
					<div class="col-md-7">
						<nav id="site-navigation" class="main-navigation align-items-center">
							<button class="menu-toggle" aria-controls="primary-menu" aria-expanded="false">
								<span class="hang-a-bur hang-a-bur-top"></span>
								<span class="hang-a-bur hang-a-bur-mid"></span>
								<span class="hang-a-bur hang-a-bur-bottom"></span></button>
							<?php
							wp_nav_menu( array(
								'theme_location' => 'menu-1',
								'menu_id'        => 'primary-menu',
								'class'        => 'main-menu',
							) );
							?>
						</nav><!-- #site-navigation -->
					</div> <!-- .col -->

					<div class="col-md-3 search-form-top">
						<?php
						get_search_form();
						?>	
					</div><!-- .col-4 -->
					<div class="cart-icon">
						<a href="<?php echo get_permalink( wc_get_page_id( 'cart' ) ); ?>">
							<i class="fa fa-cart-plus"></i>
							<?php 
							if ( WC()->cart->get_cart_contents_count() > 0 ) :
								?>
							<span class="badge badge-dark header-cart-count">
							<?php
							echo WC()->cart->get_cart_contents_count(); ?>
							</span>
							<?php 
						endif;
						?>
						</a>
						<span class="separator"> </span>
						<?php
							if ( is_user_logged_in() ) :
								?>
								<a id="login-btn" href="<?php echo wp_logout_url( get_permalink( wc_get_page_id( 'myaccount' ) ) ); ?>"><i class="fa fa-user"></i> Logout</a>
								<?php
							else :
								?>
								<a id="login-btn" href="<?php echo get_permalink( wc_get_page_id( 'myaccount' ) ); ?>"><i class="fa fa-user"></i> Login</a>
								<?php
							endif;
							?>
					</div> <!-- /cart-icon -->

				</div><!-- .row -->
			</div> <!-- /container -->
		</header><!-- #masthead -->

		<div id="content" class="site-content">
