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
        $id=$_POST['id'];

    }
        function addVirtualCoupon() {
        $coupon_code = 'VIRTUAL10';
        $discount_amount = 10; // Change this to the amount of discount you want to offer
        if ( WC()->cart->has_discount( $coupon_code ) ) {
            return;
        }
        WC()->cart->add_fee( __( 'Virtual Coupon', 'woocommerce' ), -$discount_amount );
        WC()->session->set( 'virtual_coupon', $coupon_code );
//        if ( WC()->session->get( 'virtual_coupon' ) === 'VIRTUAL10' ) {
//            // The virtual coupon has been used
//        }
    }
    function myCustomCouponData($data) {
 //       $data['my_custom_field'] = 'Some value';
        $data = array(
            'discount_type'              => 'fixed_cart',
            'coupon_amount'              => 100, // value
            'individual_use'             => 'no',
            'product_ids'                => array(),
            'exclude_product_ids'        => array(),
            'usage_limit'                => '',
            'usage_limit_per_user'       => '1',
            'limit_usage_to_x_items'     => '',
            'usage_count'                => '',
            'expiry_date'                => '2018-09-01', // YYYY-MM-DD
            'free_shipping'              => 'no',
            'product_categories'         => array(),
            'exclude_product_categories' => array(),
            'exclude_sale_items'         => 'no',
            'minimum_amount'             => '',
            'maximum_amount'             => '',
            'customer_email'             => array()
        );
        // Save the coupon in the database
        $coupon = array(
            'post_title' => $code,
            'post_content' => '',
            'post_status' => 'publish',
            'post_author' => 1,
            'post_type' => 'shop_coupon'
        );
        $new_coupon_id = wp_insert_post( $coupon );
        // Write the $data values into postmeta table
        foreach ($data as $key => $value) {
            update_post_meta( $new_coupon_id, $key, $value );
        }

        return $data;
    }




}
