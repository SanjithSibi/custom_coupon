<?php

namespace Cc\App\controller;
defined('ABSPATH') or exit();


class Base
{
    public function addingMenu()
    {
        add_menu_page(__('Custom Coupon','cc-coupon-code'),
            __('Custom Coupon', 'cc-coupon-code'),
            'manage_options',
            'test-plugin',
            array($this, 'form'));

    }
//    function processProductMeta(  ) {
//        if (!empty( $_POST['product_name'] ) ) {
//            update_post_meta( $post_id, '_product_name', ( $_POST['product_name'] ) );
//        }
//
//    }
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
        update_post_meta($id,'_coupon_value',$percent);
        wp_send_json( $response );
    }
    function addVirtualCoupon() {
        $coupon_code = 'VIRTUAL10';
        $discount_percent = 20;
        if (! method_exists( WC()->cart, 'get_subtotal' ) ) {return;}
        $subtotal=WC()->cart->get_subtotal();
        $discount_amount=($subtotal*$discount_percent)/100;
        if (! method_exists( WC()->cart, 'has_discount' ) ||  WC()->cart->has_discount( $coupon_code ) ) {return;}
        if (! method_exists( WC()->cart, 'add_fee' ) ) {return;}
        WC()->cart->add_fee( __( 'Coupon', 'cc-coupon-code' ), -$discount_amount );
        if (! method_exists( WC()->session, 'set' ) ) {return;}
        WC()->session->set( 'virtual_coupon', $coupon_code );
//        if ( WC()->session->get( 'virtual_coupon' ) === $coupon_code ) {
//            // The virtual coupon has been used
//        }
    }
    function myCustomCouponData( $data, $coupon ) {
        $data['type'] = 'virtual';
        $data['code'] = 'VIRTUAL';
        $data['discount_type'] = 'percent';
        $data['amount'] = 20;
        $data['usage_limit'] = 1;
        // Remove the "Individual use only" checkbox option
        unset( $data['individual_use'] );
        // Remove the "Exclude sale items" checkbox option
        unset( $data['exclude_sale_items'] );
       // WC()->cart->apply_coupon( $data['code'] );



        // Return the modified data
        return $data;
    }


}
