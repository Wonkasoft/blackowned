<?php
/**
 * The template for displaying wcmp-vendor-categorization plugin content.
 *
 * Override this template by copying it to yourtheme/wcmp-vendor-membership/wcmp-vendor-membership_template_vendor_plan_single.php
 *
 * @author      dualcube
 * @package     WCMp-Vendor-Catagorization/Templates
 * @version     0.0.1
 */
if (!defined('ABSPATH')) {
    // Exit if accessed directly
    exit;
}
get_header();
global $WCMP_Vendor_Membership, $WCMp;
$current_user = wp_get_current_user();
if (function_exists('is_user_wcmp_vendor')) {
    $is_vendor = is_user_wcmp_vendor($current_user);
} elseif (function_exists('is_user_wcmp_pending_vendor')) {
    $is_pending_vendor = is_user_wcmp_pending_vendor($current_user);
}
$global_settings = $WCMP_Vendor_Membership->get_global_settings();
$current_stylesheet = get_option('stylesheet');
$stylesheet_support = array('flatsome', 'flatsome-child', 'wyzi-business-finder', 'wyzi-business-finder-child');
$body_class = in_array($current_stylesheet, $stylesheet_support) ? 'container' : '';

?>
<div id="container" class="container">
    <div role="main" class="row">
        <?php

        // Start the loop.
        while (have_posts()) : the_post();
            // Include the page content template.
            $post_id = get_the_ID();

            ?>
            <div id="post-<?php the_ID(); ?>" <?php post_class($body_class); ?>>
                <?php if ( !empty( wp_get_attachment_url( get_post_thumbnail_id( $post_id ) ) ) ) : ?>
                    <div class="wcmp-plan-images">
                        <a href="<?php echo get_the_permalink(); ?>" itemprop="image" title=""><img width="300" height="300" src="<?php echo wp_get_attachment_url(get_post_thumbnail_id($post_id)); ?>" class="attachment-shop_single size-shop_single wp-post-image" alt="" title="<?php echo the_title(); ?>"></a>
                    </div> 
                <?php endif; ?>
                <div class="summary entry-summary <?php $added_class = ( !empty( wp_get_attachment_url( get_post_thumbnail_id( $post_id ) ) ) ) ? 'right-half': 'full-width'; echo $added_class; ?>">

                    <h1 itemprop="name" class="product_title entry-title"><?php echo get_the_title(); ?></h1>
                    <?php if (get_post_meta($post_id, '_is_free_plan', true) != 'Enable') : ?>
                        <p class="wcmp-plan-price">
                            <?php
                            $_vendor_billing_field = get_post_meta($post_id, '_vendor_billing_field', true);
                            if (isset($_vendor_billing_field['_initial_payment']) && !empty($_vendor_billing_field['_initial_payment']) && $_vendor_billing_field['_initial_payment'] > 0) {
                                echo get_woocommerce_currency_symbol();
                                echo number_format($_vendor_billing_field['_initial_payment'], 2);
                            }
                            if (isset($_vendor_billing_field['_is_recurring']) && $_vendor_billing_field['_is_recurring'] == 'yes') {
                                if (isset($_vendor_billing_field['_initial_payment']) && $_vendor_billing_field['_initial_payment'] > 0) {
                                    if ($_vendor_billing_field['_vendor_billing_amt_cycle'] == 'Week') {
                                        echo __(' for First Week', 'wcmp-vendor_membership');
                                    }
                                    if ($_vendor_billing_field['_vendor_billing_amt_cycle'] == 'SemiMonth') {
                                        echo __(' for First 15 Days', 'wcmp-vendor_membership');
                                    }
                                    if ($_vendor_billing_field['_vendor_billing_amt_cycle'] == 'Month') {
                                        echo __('/mo.', 'wcmp-vendor_membership');
                                    } elseif ($_vendor_billing_field['_vendor_billing_amt_cycle'] == 'Day') {
                                        echo __(' for First Day', 'wcmp-vendor_membership');
                                    } elseif ($_vendor_billing_field['_vendor_billing_amt_cycle'] == 'Year') {
                                        echo __('/yr.', 'wcmp-vendor_membership');
                                    }

                                $billing_amt = isset($_vendor_billing_field['_vendor_billing_amt']) && !empty($_vendor_billing_field['_vendor_billing_amt']) ? $_vendor_billing_field['_vendor_billing_amt'] : 0;
                                if (isset($global_settings['display_method']) && !empty($global_settings['display_method']) && $global_settings['display_method'] == 'inclusive') {
                                    if (isset($_vendor_billing_field['_vendor_billing_tax_amt']) && !empty($_vendor_billing_field['_vendor_billing_tax_amt'])) {
                                        $billing_amt += $_vendor_billing_field['_vendor_billing_tax_amt'];
                                    }
                                }
                                // WP_Query arguments
                                $args = array (
                                'post_type'              => array( 'vendortype' ),
                                'post_status'            => array( 'publish' ),
                                'nopaging'               => true,
                                'order'                  => 'DESC',
                                'orderby'                => 'menu_order',
                                );

                                // The Query
                                $vendors = new WP_Query( $args );
                                $match = '';
                                $post_meta = '';
                                $yearly;
                                $cycle = '';
                                $current_post = get_post_field( 'post_name', get_post() );
                                $id = 0;
                                
                                // The Loop
                                if ( $vendors->have_posts() ) {
                                    while ( $vendors->have_posts() ) {
                                    $vendors->the_post();
                                    $match = get_post_field( 'post_name', get_post() );
                                    $id = get_the_ID();
                                    $post_meta = get_post_meta($id, '_vendor_billing_field', true);
                                        if ( $match == $current_post . '-year' ) {
                                            $yearly = $post_meta['_vendor_billing_amt'];
                                        }
                                        if ( strpos( $match, '-year' ) && $match === $current_post ) {
                                            $yearly = $post_meta['_vendor_billing_amt'];
                                        }
                                    }

                                }
                                
                                if ( !empty( $yearly ) && $_vendor_billing_field['_vendor_billing_amt_cycle'] !== 'Year' ) {
                                    echo __(' <span class="yearly-price">| ', 'wcmp-vendor_membership');

                                    echo get_woocommerce_currency_symbol() . number_format($yearly, 2) . '/yr.</span>';
                                }
                            } else {
                                if (isset($_vendor_billing_field['_initial_payment']) && $_vendor_billing_field['_initial_payment'] > 0) {
                                    echo __(' One Time', 'wcmp-vendor_membership');
                                }
                            }
                                }
                            
                            ?>
                        </p>
                        <?php $payment_page_url = get_wcmp_vendor_settings('vendor_registration', 'vendor', 'general'); ?>
                        <form name="frm_subscribe_vandor_plan" method="post" action="<?php echo get_permalink($payment_page_url); ?>" >
                            <input type="hidden" name="vendor_plan_id" value="<?php echo $post_id; ?>" />
                            <div class="subscription-container">

                                <?php
                                $button_text = __('Subscribe Now', 'wcmp-vendor_membership');
                                if (isset($_vendor_billing_field['_subscribe_button_text']) && $_vendor_billing_field['_subscribe_button_text'] != '') {
                                    $button_text = $_vendor_billing_field['_subscribe_button_text'];
                                }
                                if ($current_user->ID != 0) {
                                    $button_text = __('Upgrade Now', 'wcmp-vendor_membership');
                                    if (isset($_vendor_billing_field['_subscribe_button_text_logged_in']) && $_vendor_billing_field['_subscribe_button_text_logged_in'] != '') {
                                        $button_text = $_vendor_billing_field['_subscribe_button_text_logged_in'];
                                    }
                                }
                                if (isset($is_vendor) && $is_vendor != 0 && $is_vendor != '' && $is_vendor != false) {

                                    $button_text = __('Upgrade Now', 'wcmp-vendor_membership');
                                    if (isset($_vendor_billing_field['_subscribe_button_text_upgrade']) && $_vendor_billing_field['_subscribe_button_text_upgrade'] != '') {
                                        $button_text = $_vendor_billing_field['_subscribe_button_text_upgrade'];
                                    }
                                }

                                if (current_user_can('manage_options')) {
                                    ?>
                                    <p style="color:red;">
                                        <?php echo __('Sorry you are logged in as admin please try with another account or logoff', 'wcmp-vendor_membership'); ?>
                                    </p>

                                    <?php
                                } else if($post_id != get_user_meta(get_current_user_id(), 'vendor_group_id', true)) {
                                    ?>
                                    
                                    <input type="submit" value="<?php echo $button_text; ?>" name="vendor_plan_payment" class="btn btn-lg vendor_subscribe_now" />
                                <?php } ?>
                            </div>
                        </form>
                    <?php endif; ?>
                    
                </div>
                    <div itemprop="description">
                    <h2 class="package-featured-list"><?php echo __('Features List', 'wcmp-vendor_membership'); ?></h2>
                    <hr />

                    <?php echo get_post($post_id, 'OBJECT')->post_content; ?>
                    </div>
                    <?php $_vender_featurelist = get_post_meta($post_id, '_vender_featurelist', true); ?>
                    <?php
                    if (is_array($_vender_featurelist)) : ?>
                    <ul>
                        <?php foreach ($_vender_featurelist as $flist) :
                                ?>
                                <li><?php echo $flist; ?></li>
                        <?php endforeach; ?>
                    </ul>
                    <?php endif; ?>
            </div>

        <?php
        // End the loop.
        endwhile; ?>
    </div>
</div>

<?php
get_footer();
