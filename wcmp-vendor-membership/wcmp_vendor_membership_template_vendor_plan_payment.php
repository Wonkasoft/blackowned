<?php
/**
 * The template for displaying wcmp-vendor-membership plugin content.
 *
 * Override this template by copying it to yourtheme/wcmp-vendor-membership/wcmp-vendor-membership_template_vendor_plan_payment.php
 *
 * @author 		dualcube
 * @package 	WCMp-Vendor-Membership/Templates
 * @version     0.0.1
 */
if (!defined('ABSPATH'))
    exit; // Exit if accessed directly
global $WCMP_Vendor_Membership, $plan_meta, $woocommerce;
if (isset($plan_id) && !empty($plan_id)) {
    $_SESSION['plan_id'] = $plan_id;
} else if (isset($_SESSION['plan_id'])) {
    $plan_id = $_SESSION['plan_id'];
}

if (isset($plan_id) && !empty($plan_id)) {
    ?>
    <?php wc_print_notices(); ?>

    <ul class="wvn-payment-error">
        <?php
        if (isset($_GET['haserror']) && $_GET['haserror'] == 1) {
            echo '<li>An error occurred while processing this request. please try again later</li>';
        }
        ?>
    </ul>
    <div class="wcmp_regi_main">
        <form class="register" role="form" method="post" enctype="multipart/form-data">
            <input type="hidden" name="vendor_membership_plan_id" id="user_type_for_registration" value="<?php echo $plan_id; ?>" />
            <?php
            if (is_user_logged_in()) {
                echo '<input type="hidden" name="do_vendor_membership_upgrade" value="1" />';
                echo '<input type="hidden" name="do_vendor_membership_upgrade" value="' . get_user_meta(get_current_user_id(), 'vendor_group_id', true) . '" />';
            }
            ?>
            <div class="<?php
            if (!is_user_logged_in()) {
                echo 'wcmp_regi_form_box';
            }
            ?>">
                     <?php
                     if (!is_user_logged_in()) :
                         $wcmp_vendor_general_settings_name = get_option('wcmp_vendor_general_settings_name');
                         ?>
                    <h3 class="reg_header2"><?php
                        if (isset($wcmp_vendor_general_settings_name['woo_reg_section_label']) && !empty($wcmp_vendor_general_settings_name['woo_reg_section_label'])) {
                            echo $wcmp_vendor_general_settings_name['woo_reg_section_label'];
                        } else {
                            echo 'Account Details';
                        }
                        ?></h3>
                    <?php if ('no' === get_option('woocommerce_registration_generate_username')) : ?>
                        <div class="wcmp-regi-12">
                            <label for="reg_username"><?php _e('Username', 'woocommerce'); ?> <span class="required">*</span></label>
                            <input type="text"  name="username" id="reg_username" value="<?php if (!empty($_POST['username'])) echo esc_attr($_POST['username']); ?>" required="required" />
                        </div>
                    <?php endif; ?>
                    <div class="wcmp-regi-12">
                        <label for="reg_email"><?php _e('Email address', 'woocommerce'); ?> <span class="required">*</span></label>
                        <input type="email" required="required"  name="email" id="reg_email" value="<?php if (!empty($_POST['email'])) echo esc_attr($_POST['email']); ?>" />
                    </div>
                    <?php if ('no' === get_option('woocommerce_registration_generate_password')) : ?>
                        <div class="wcmp-regi-12">
                            <label for="reg_password"><?php _e('Password', 'woocommerce'); ?> <span class="required">*</span></label>
                            <input type="password" required="required" name="password" id="reg_password" />
                        </div>
                    <?php wp_enqueue_script('wc-password-strength-meter'); endif; ?>
                    <div style="<?php echo ( ( is_rtl() ) ? 'right' : 'left' ); ?>: -999em; position: absolute;"><label for="trap"><?php _e('Anti-spam', 'woocommerce'); ?></label><input type="text" name="email_2" id="trap" tabindex="-1" /></div>
                    <?php wp_nonce_field('woocommerce-register', 'woocommerce-register-nonce'); ?>

                    <?php do_action('wcmp_vendor_register_form'); ?>
                <?php endif; ?>
                <div class="clearboth"></div>
            </div>
            <?php if (get_post_meta($plan_id, '_is_free_plan', true) != 'Enable') : ?>
                <div class="wcmp_regi_form_box">
                    <h3 class="reg_header2">Proceed to Pay</h3>
                    <div class="wcmp-regi-12">
                        <label><input type="radio" name="wvm_payment_method" class="wvm_payment_method" value="paypal" checked="" /> Pay via PayPal; you can pay with your credit card if you don’t have a PayPal account.</label>
                    </div>
                    <?php do_action('wcmp_after_vendor_membership_payment_methods'); ?>
                    <div class="clearboth"></div>
                </div>

            <?php endif; ?>
            <div class="clearboth"></div>
            <p class="woocomerce-FormRow form-row">
                <?php
                $button_text = is_user_logged_in() ? 'Upgrade' : 'Register';
                $button_text = apply_filters('wcmp_vendor_registration_submit', $button_text);
                ?>
                <input type="hidden" name="create_vendor_membership_payment" />
                <input type="submit" class="woocommerce-Button button" id="paypal_submit_btn" name="register" value="<?php esc_attr_e($button_text, 'woocommerce'); ?>" />
            <h2 class="validation_message"></h2>
            <?php do_action('woocommerce_register_form_end'); ?>
        </form>
    </div>
<?php
} else {
    echo do_shortcode('[wcmp_vendor_plan]');
} 