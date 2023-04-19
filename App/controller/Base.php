<?php

namespace Cc\App\controller;

class Base
{
    public function addingMenu()
    {
        add_menu_page('Custom Coupon',
            'Custom Coupon',
            'manage_options',
            'test-plugin',
            array($this, 'form'));

    }
    function form()
    {
        $helo=CC_PATH . 'Assets/js/couponvalue.js';
        echo $helo;
        wc_get_template( 'admin_product_edit.php', array(), '',WP_PLUGIN_DIR . '/custom_coupon/App/view/' );
        wp_enqueue_script('contact-form', CC_PATH . '/Assets/js/couponvalue.js', array('jquery'), '1.0', true);
        wp_localize_script('contact-form', 'contactForm', array(
            'ajaxUrl' => admin_url('admin-ajax.php')

        ));
    }
    function submitForm()
    {

        $percent =$_POST['percent'];
        echo $percent;
    }

    function applyCustomDiscount( $cart ) {
        if ( is_admin() && ! defined( 'DOING_AJAX' ) ) {
            return;
        }

        $discount_amount = $cart->get_subtotal() ;
        $discount=$discount_amount-10;
        $cart->add_fee( __( 'Coupon Discount', 'text-domain' ), -$discount );
    }



}