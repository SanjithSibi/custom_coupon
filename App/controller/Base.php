<?php

namespace Cc\App\controller;
defined('ABSPATH') or exit();


class Base
{
    public function addingMenu()
    {
        add_menu_page('Custom Coupon',
            __('Custom Coupon', 'cc-coupon-code'),
            'manage_options',
            'test-plugin',
            array($this, 'form'));

    }
    function form()
    {
        wc_get_template('add_coupon.php', array(), '', WP_PLUGIN_DIR . '/custom_coupon/App/view/');
        wp_enqueue_script('contact-form', CC_PATH . '/Assets/js/couponvalue.js', array('jquery'), '1.0', true);
        wp_localize_script('contact-form', 'contactForm', array(
            'ajaxUrl' => admin_url('admin-ajax.php'),
         'nonce' => wp_create_nonce('ajaxnonce')));

    }
    function myActionCallback() {
        $response = array( 'success' => false );
        $nonce = $_POST['nonce'];
        if ( ! wp_verify_nonce( $nonce, 'my_ajax_nonce' ) ) {
            exit();}
        $percent = $_POST['percent'];
        $id=$_POST['id'];
        $response['success'] = true;
        wp_send_json( $response );
    }
    function addVirtualCoupon() {
        $coupon_code = 'VIRTUAL10';
        $discount_percent = 10;
        if (! method_exists( WC()->cart, 'get_subtotal' ) ) {return;}
        $subtotal=WC()->cart->get_subtotal();
        $discount_amount=($subtotal*$discount_percent)/100;
        if (! method_exists( WC()->cart, 'has_discount' ) ||  WC()->cart->has_discount( $coupon_code ) ) {return;}
        if (! method_exists( WC()->cart, 'add_fee' ) ) {return;}
        WC()->cart->add_fee( __( 'Coupon', 'woocommerce' ), -$discount_amount );
        if (! method_exists( WC()->session, 'set' ) ) {return;}
        WC()->session->set( 'virtual_coupon', $coupon_code );
//        if ( WC()->session->get( 'virtual_coupon' ) === $coupon_code ) {
//            // The virtual coupon has been used
//        }
    }



}
