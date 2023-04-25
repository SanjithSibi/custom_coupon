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
        $discount_percent = 10;
        $subtotal=WC()->cart->get_subtotal();
        $discount_amount=($subtotal*$discount_percent)/100;
        if ( WC()->cart->has_discount( $coupon_code ) ) {
            return;
        }
        WC()->cart->add_fee( __( 'Virtual Coupon', 'woocommerce' ), -$discount_amount );
        WC()->session->set( 'virtual_coupon', $coupon_code );
//        if ( WC()->session->get( 'virtual_coupon' ) === 'VIRTUAL10' ) {
//            // The virtual coupon has been used
//        }
    }




}
