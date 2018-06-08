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
			<div class="row">
				<div class="col-3">
					<div class="custom-logo">
						<?php
						$custom_logo_id = get_theme_mod( 'custom_logo' );
						$custom_logo_id_image = wp_get_attachment_image_src( $custom_logo_id, 'full');

						if ( ! empty( $custom_logo_id ) ): ?>
							<span class="site-logo"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><img src="<?php echo esc_url( $custom_logo_id_image[0] ); ?>" alt="<?php bloginfo( 'name' ); ?>"/></a></span> 
						<?php
						else :
							?>
							<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
						<?php
						endif;

				$blackowned_description = get_bloginfo( 'description', 'display' );
				if ( $blackowned_description || is_customize_preview() ) :
					?>
					<p class="site-description"><?php echo $blackowned_description; /* WPCS: xss ok. */ ?></p>
				<?php endif; ?>
			</div> <!-- .custom-logo -->
			</div> <!-- .col-5 -->
			<div class="col-8">
				<div class="row">
					<div class="col text-right">
						<nav class="account-row">
							<ul id="sub-menu-icons" class="inline">
								<li class="list-inline-item">
								<?php
								get_search_form();
								?>	
								</li>
								<li class="list-inline-item">
									<a href="/my-account"><i class="fa fa-user"></i></a>
								</li>
							</ul> <!-- /sub-menu list -->
						</nav> <!-- .account-row -->
					</div> <!-- .col -->
				</div> <!-- .row -->
				<div class="row nav-row">
					<div class="col text-right">
						<nav id="site-navigation" class="main-navigation">
							<button class="menu-toggle" aria-controls="primary-menu" aria-expanded="false"><?php esc_html_e( 'Primary Menu', 'blackowned' ); ?></button>
							<?php
							wp_nav_menu( array(
								'theme_location' => 'menu-1',
								'menu_id'        => 'primary-menu',
							) );
							?>
						</nav><!-- #site-navigation -->
					</div> <!-- .col -->
				</div> <!-- .row -->
			</div><!-- .col-7 -->
		</div><!-- .row -->
	</header><!-- #masthead -->

	<div id="content" class="site-content">
