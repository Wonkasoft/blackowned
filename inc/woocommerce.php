<?php
/**
 * WooCommerce Compatibility File
 *
 * @link https://woocommerce.com/
 *
 * @package blackowned
 */

/**
 * WooCommerce setup function.
 *
 * @link https://docs.woocommerce.com/document/third-party-custom-theme-compatibility/
 * @link https://github.com/woocommerce/woocommerce/wiki/Enabling-product-gallery-features-(zoom,-swipe,-lightbox)-in-3.0.0
 *
 * @return void
 */
function blackowned_woocommerce_setup() {
	add_theme_support( 'woocommerce' );
	add_theme_support( 'wc-product-gallery-zoom' );
	add_theme_support( 'wc-product-gallery-lightbox' );
	add_theme_support( 'wc-product-gallery-slider' );
}
add_action( 'after_setup_theme', 'blackowned_woocommerce_setup' );

/**
 * WooCommerce specific scripts & stylesheets.
 *
 * @return void
 */
function blackowned_woocommerce_scripts() {
	wp_enqueue_style( 'blackowned-woocommerce-style', get_template_directory_uri() . '/woocommerce.css' );

	$font_path   = WC()->plugin_url() . '/assets/fonts/';
	$inline_font = '@font-face {
			font-family: "star";
			src: url("' . $font_path . 'star.eot");
			src: url("' . $font_path . 'star.eot?#iefix") format("embedded-opentype"),
				url("' . $font_path . 'star.woff") format("woff"),
				url("' . $font_path . 'star.ttf") format("truetype"),
				url("' . $font_path . 'star.svg#star") format("svg");
			font-weight: normal;
			font-style: normal;
		}';

	wp_add_inline_style( 'blackowned-woocommerce-style', $inline_font );
}
add_action( 'wp_enqueue_scripts', 'blackowned_woocommerce_scripts' );

/**
 * Disable the default WooCommerce stylesheet.
 *
 * Removing the default WooCommerce stylesheet and enqueing your own will
 * protect you during WooCommerce core updates.
 *
 * @link https://docs.woocommerce.com/document/disable-the-default-stylesheet/
 */
add_filter( 'woocommerce_enqueue_styles', '__return_empty_array' );

/**
 * Add 'woocommerce-active' class to the body tag.
 *
 * @param  array $classes CSS classes applied to the body tag.
 * @return array $classes modified to include 'woocommerce-active' class.
 */
function blackowned_woocommerce_active_body_class( $classes ) {
	$classes[] = 'woocommerce-active';

	return $classes;
}
add_filter( 'body_class', 'blackowned_woocommerce_active_body_class' );

/**
 * Products per page.
 *
 * @return integer number of products.
 */
function blackowned_woocommerce_products_per_page() {
	return 12;
}
add_filter( 'loop_shop_per_page', 'blackowned_woocommerce_products_per_page' );

/**
 * Product gallery thumnbail columns.
 *
 * @return integer number of columns.
 */
function blackowned_woocommerce_thumbnail_columns() {
	return 4;
}
add_filter( 'woocommerce_product_thumbnails_columns', 'blackowned_woocommerce_thumbnail_columns' );

/**
 * Default loop columns on product archives.
 *
 * @return integer products per row.
 */
function blackowned_woocommerce_loop_columns() {
	return 3;
}
add_filter( 'loop_shop_columns', 'blackowned_woocommerce_loop_columns' );

/**
 * Related Products Args.
 *
 * @param array $args related products args.
 * @return array $args related products args.
 */
function blackowned_woocommerce_related_products_args( $args ) {
	$defaults = array(
		'posts_per_page' => 3,
		'columns'        => 3,
	);

	$args = wp_parse_args( $defaults, $args );

	return $args;
}
add_filter( 'woocommerce_output_related_products_args', 'blackowned_woocommerce_related_products_args' );

if ( ! function_exists( 'blackowned_woocommerce_product_columns_wrapper' ) ) {
	/**
	 * Product columns wrapper.
	 *
	 * @return  void
	 */
	function blackowned_woocommerce_product_columns_wrapper() {
		$columns = blackowned_woocommerce_loop_columns();
		echo '<div class="columns-' . absint( $columns ) . '">';
	}
}
add_action( 'woocommerce_before_shop_loop', 'blackowned_woocommerce_product_columns_wrapper', 40 );

if ( ! function_exists( 'blackowned_woocommerce_product_columns_wrapper_close' ) ) {
	/**
	 * Product columns wrapper close.
	 *
	 * @return  void
	 */
	function blackowned_woocommerce_product_columns_wrapper_close() {
		echo '</div>';
	}
}
add_action( 'woocommerce_after_shop_loop', 'blackowned_woocommerce_product_columns_wrapper_close', 40 );

/**
 * Remove default WooCommerce wrapper.
 */
remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10 );

remove_action( 'woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10 );

if ( ! function_exists( 'blackowned_woocommerce_wrapper_before' ) ) {
	/**
	 * Before Content.
	 *
	 * Wraps all WooCommerce content in wrappers which match the theme markup.
	 *
	 * @return void
	 */
	function blackowned_woocommerce_wrapper_before() {
		?>
		<div id="primary" class="content-area container">
			<main id="main" class="site-main row" role="main">
				<div class="col">
			<?php
	}
}
add_action( 'woocommerce_before_main_content', 'blackowned_woocommerce_wrapper_before', 10 );

if ( ! function_exists( 'blackowned_woocommerce_wrapper_after' ) ) {
	/**
	 * After Content.
	 *
	 * Closes the wrapping divs.
	 *
	 * @return void
	 */
	function blackowned_woocommerce_wrapper_after() {
			?>
				</div><!-- .col -->
			</main><!-- #main -->
		</div><!-- #primary -->
		<?php
	}
}
add_action( 'woocommerce_after_main_content', 'blackowned_woocommerce_wrapper_after', 10 );

/**
 * Sample implementation of the WooCommerce Mini Cart.
 *
 * You can add the WooCommerce Mini Cart to header.php like so ...
 *
	<?php
		if ( function_exists( 'blackowned_woocommerce_header_cart' ) ) {
			blackowned_woocommerce_header_cart();
		}
	?>
 */

if ( ! function_exists( 'blackowned_woocommerce_cart_link_fragment' ) ) {
	/**
	 * Cart Fragments.
	 *
	 * Ensure cart contents update when products are added to the cart via AJAX.
	 *
	 * @param array $fragments Fragments to refresh via AJAX.
	 * @return array Fragments to refresh via AJAX.
	 */
	function blackowned_woocommerce_cart_link_fragment( $fragments ) {
		ob_start();
		blackowned_woocommerce_cart_link();
		$fragments['a.cart-contents'] = ob_get_clean();

		return $fragments;
	}
}
add_filter( 'woocommerce_add_to_cart_fragments', 'blackowned_woocommerce_cart_link_fragment' );

if ( ! function_exists( 'blackowned_woocommerce_cart_link' ) ) {
	/**
	 * Cart Link.
	 *
	 * Displayed a link to the cart including the number of items present and the cart total.
	 *
	 * @return void
	 */
	function blackowned_woocommerce_cart_link() {
		?>
		<a class="cart-contents" href="<?php echo esc_url( wc_get_cart_url() ); ?>" title="<?php esc_attr_e( 'View your shopping cart', 'blackowned' ); ?>">
			<?php
			$item_count_text = sprintf(
				/* translators: number of items in the mini cart. */
				_n( '%d item', '%d items', WC()->cart->get_cart_contents_count(), 'blackowned' ),
				WC()->cart->get_cart_contents_count()
			);
			?>
			<span class="amount"><?php echo wp_kses_data( WC()->cart->get_cart_subtotal() ); ?></span> <span class="count"><?php echo esc_html( $item_count_text ); ?></span>
		</a>
		<?php
	}
}

if ( ! function_exists( 'blackowned_woocommerce_header_cart' ) ) {
	/**
	 * Display Header Cart.
	 *
	 * @return void
	 */
	function blackowned_woocommerce_header_cart() {
		if ( is_cart() ) {
			$class = 'current-menu-item';
		} else {
			$class = '';
		}
		?>
		<ul id="site-header-cart" class="site-header-cart">
			<li class="<?php echo esc_attr( $class ); ?>">
				<?php blackowned_woocommerce_cart_link(); ?>
			</li>
			<li>
				<?php
				$instance = array(
					'title' => '',
				);

				the_widget( 'WC_Widget_Cart', $instance );
				?>
			</li>
		</ul>
		<?php
	}
}

$user = wp_get_current_user(); 
if ( in_array( 'dc_vendor', (array) $user->roles ) ) :

	/**
	 * My Account menu items
	 *
	 * @param arr $items
	 * @return arr
	 */
	function blackowned_account_menu_items( $items ) {
	 	
	    $items['vendor-store'] = __( 'My Store', 'blackowned' );

	    $items = array_slice($items, 6) + array_slice($items, 0, 6);
	 
	    return $items;
	 
	}
	 
	add_filter( 'woocommerce_account_menu_items', 'blackowned_account_menu_items', 10, 1 );

	/**
	 * Add endpoint
	 */
	function blackowned_add_my_account_endpoint() {
	 
	    add_rewrite_endpoint( 'vendor-store', EP_ROOT | EP_PAGES );
	 
	}
	 
	add_action( 'init', 'blackowned_add_my_account_endpoint' );

	/**
	 * Information content
	 */
	function blackowned_vendor_store_endpoint_content() {

		$output = '';
		$output .= 	'<div class="vendor-content-wrap"><div class="row title-row"><div class="col">';
		$output .=	'<h3><a class="vendor-link" href="' . get_site_url() . '/dashboard">Manage your store</a></h3></div></div>';
		$output .=	'<div class="row content-row"><div class="col">';
		$output .=	'<div class="vendor-module products-module"><div class="col image-container"><i class="fa fa-gift"></i></div>';
		$output .=	'<div class="col module-description products-description"><h3>Products</h3></div></div>';
		$output .=	'<div class="vendor-module orders-module"><div class="col image-container"><i class="fa fa-shopping-cart"></i></div>';
		$output .=	'<div class="col module-description orders-description"><h3>Orders</h3></div></div>';
		$output .=	'</div></div>';
		$output .=	'<div class="row content-row"><div class="col">';
		$output .=	'<div class="vendor-module analytics-module"><div class="col image-container"><i class="fa fa-line-chart"></i></div>';
		$output .=	'<div class="col module-description analytics-description"><h3>Analytics</h3></div></div>';
		$output .=	'<div class="vendor-module settings-module"><div class="col image-container"><i class="fa fa-cogs"></i></div>';
		$output .=	'<div class="col module-description settings-description"><h3>Settings</h3></div></div>';
		$output .=	'</div></div>';
		$output .=	'<a href="' . get_site_url() . '/dashboard" class="btn btn-lg">Edit Store Settings</a>';
		$output .=	'</div>';

		echo $output;

	}
	 
	add_action( 'woocommerce_account_vendor-store_endpoint', 'blackowned_vendor_store_endpoint_content' );
endif;