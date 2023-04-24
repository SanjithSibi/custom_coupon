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
    function myCustomCouponData( $data, $coupon ) {
        // Modify the coupon data here
        $coupon_code = 'MYCOUPON'; // Coupon code
        $amount = '10'; // Amount off
        $discount_type = 'fixed_cart'; // Type: fixed_cart, percent, fixed_product, percent_product
        $expiry_date = strtotime( '+1 week' ); // Expiry date: +1 week from now

        if ( ! woocommerce_coupon_code_exists( $coupon_code ) ) {
            $coupon = new WC_Coupon();
            $coupon->set_code( $coupon_code );
            $coupon->set_discount_type( $discount_type );
            $coupon->set_amount( $amount );
            $coupon->set_date_expires( date( 'Y-m-d H:i:s', $expiry_date ) );
            $coupon->save();
        }
//        $data['my_custom_field'] = 'Some value';

        return $data;
    }




}