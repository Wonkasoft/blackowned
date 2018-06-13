<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package blackowned
 * @since  1.0.0 [<init>]
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

		<header id="masthead" class="container-fluid site-header">
			<div class="container menu-bar">
				<div class="row align-items-center">
					<div class="col-2">
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
							endif;

							$blackowned_description = get_bloginfo( 'description', 'display' );
							if ( $blackowned_description || is_customize_preview() ) :
								?>
							</div> <!-- .custom-logo -->
							<p class="site-description"><?php echo $blackowned_description; /* WPCS: xss ok. */ ?></p>
						<?php endif; ?>
					</div> <!-- .col-2 -->
					<div class="col-6">
						<nav id="site-navigation" class="main-navigation align-items-center">
							<button class="menu-toggle" aria-controls="primary-menu" aria-expanded="false"><?php esc_html_e( 'Primary Menu', 'blackowned' ); ?></button>
							<?php
							wp_nav_menu( array(
								'theme_location' => 'menu-1',
								'menu_id'        => 'primary-menu',
								'class'        => 'align-items-center',
							) );
							?>
						</nav><!-- #site-navigation -->
					</div> <!-- .col -->

					<div class="col-4 text-center">
						<?php
						get_search_form();
						?>	
					</div><!-- .col-4 -->
					<div class="cart-icon text-right">
						<a href="/cart"><i class="fa fa-cart-plus"></i></a>
						<a id="login-btn" href="/my-account">Login</a>
					</div> <!-- /cart-icon -->

				</div><!-- .row -->
			</div> <!-- /container -->
		</header><!-- #masthead -->

		<div id="content" class="site-content">
