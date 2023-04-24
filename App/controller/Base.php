<?php

namespace Cc\App\controller;

class Base
{
    public function addingMenu()
    {
        add_menu_page('Custom Coupon',
            __('Custom Coupon', 'woocommerce'),
            'manage_options',
            'test-plugin',
            array($this, 'form'));

    }

    function form()
    {
        wc_get_template('add_coupon.php', array(), '', WP_PLUGIN_DIR . '/custom_coupon/App/view/');
        wp_enqueue_script('contact-form', CC_PATH . '/Assets/js/couponvalue.js', array('jquery'), '1.0', true);
        wp_localize_script('contact-form', 'contactForm', array(
            'ajaxUrl' => admin_url('admin-ajax.php')));

    }

    function submitForm()
    {

        $percent = $_POST['percent'];

    }

//    function applyCustomCoupon()
//    {
//        global $woocommerce;
//        $percentage = 10;
//        $subtotal=$woocommerce->cart->get_subtotal();
//        $amount=($percentage*$subtotal)/100;
//        $woocommerce->cart->add_fee(__('Coupon', 'woocommerce'), -$amount);
//    }
    function applyCoupon() {
        global $woocommerce;

        // Check if the coupon code is not already applied
        if (!$woocommerce->cart->applied_coupons) {
            // Generate a unique coupon code
            $coupon_code = 'si';

            // Create the coupon dynamically
            $coupon = array(
                'post_title' => $coupon_code,
                'post_content' => '',
                'post_status' => 'publish',
                'post_author' => 1,
                'post_type' => 'shop_coupon'
            );

            // Insert the coupon into the database
            $new_coupon_id = wp_insert_post($coupon);

            // Set the coupon data
            update_post_meta($new_coupon_id, 'discount_type', 'percent');
            update_post_meta($new_coupon_id, 'coupon_amount', 10);

            // Apply the coupon to the cart
            $woocommerce->cart->apply_coupon($coupon_code);
        }
    }

    function auto_apply_non_persistent_coupon( $cart ) {
        // check if the coupon is already applied
        if ( ! empty( $cart->get_applied_coupons() ) ) {
            return;
        }

        // generate a unique coupon code
        $coupon_code = 'TEMP';

        // create the coupon
        $coupon = array(
            'post_title' => $coupon_code,
            'post_content' => '',
            'post_status' => 'publish',
            'post_author' => 1,
            'post_type' => 'shop_coupon'
        );

        // insert the coupon into the database
        $new_coupon_id = wp_insert_post( $coupon );

        // set the coupon data
        update_post_meta( $new_coupon_id, 'discount_type', 'percent' );
        update_post_meta( $new_coupon_id, 'coupon_amount', 10 );
        update_post_meta( $new_coupon_id, 'usage_limit', 1 );
        update_post_meta( $new_coupon_id, 'expiry_date', strtotime('+1 hour') );
        update_post_meta( $new_coupon_id, 'individual_use', 'yes' );

        // apply the coupon to the cart
        $cart->apply_coupon( $coupon_code );

        // remove the coupon after 1 hour
        wp_schedule_single_event( time() + 3, 'delete_temp_coupon', array( $new_coupon_id ) );
    }
    function delete_temporary_coupon( $coupon_id ) {
        wp_delete_post( $coupon_id, true );
    }

    function cxc_apply_coupon_code_cart()
    {
        $coupon = new \WC_Coupon();
        $coupon->set_code('Cxc_Coupon_2023'); // Add Coupon code here
        $coupon->set_amount(50); // You Can Add Discount amount here
        $coupon->set_discount_type( 'percent' );
        $coupon->set_usage_limit(1);
        $coupon->save();
        $cxc_coupon_2023 = 'cxc_coupon_2023';
        if (WC()->cart->has_discount($cxc_coupon_2023)) {
            return;
        }

        WC()->cart->apply_coupon($cxc_coupon_2023);

        wc_print_notices();
    }


}