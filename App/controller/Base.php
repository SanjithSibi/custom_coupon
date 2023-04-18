<?php

namespace Cc\App\controller;

class Base
{
    public function addFreeGiftTab($tabs){

        if(! is_array($tabs)) {
            return $tabs;
        }
        $tabs['cc-coupon-code'] = array(
            'label' => __('Auto Coupon', 'cc-coupon-code'),
            'priority' => 50,
            'target' => 'cc-custom-coupon',
        );
        return $tabs;
    }
    function woocommerceProductCustomFields()
    {
        global  $post;
        if(! isset($post->ID) || (! is_numeric($post->ID))){ return ; }
        $product_id = $post->ID;
        $discount_value = get_post_meta( $product_id, '_cc_discount_percentage', true );
        $value = (!empty($discount_value)) ? $discount_value : '';
        wc_get_template( 'admin_product_edit.php', array('Value' => $value), '',WP_PLUGIN_DIR . '/custom_coupon/App/view/' );
    }
    function saveDiscountValueToDatabase( $post_id ) {
        $discount_value = isset($_POST['discount_percentage']) ?  sanitize_text_field($_POST['discount_percentage']):'';
        if(!empty($discount_value) ) {
            update_post_meta($post_id, '_cc_discount_percentage', $discount_value);
        }
    }
    function customPrice($cart_object)
    {

        if(!isset($cart_object) || ! is_object($cart_object) || ! method_exists(WC()->cart,'get_cart')){return;}
        foreach ($cart_object->get_cart() as $key => $value) {
            //print_r($value);
            if(!is_array($value)){continue;}
            $product_id=$value['product_id'];
            $discount_value = get_post_meta( $product_id, '_cc_discount_percentage', true );
            $price=$value['data']->get_price();
            $discounted_price=(($price*$discount_value)/100)-$price;
            if (!isset($value['data'])|| !is_object($value['data']) || ! method_exists( $value['data'], 'set_price' ) ) {continue;}
            $value['data']->set_price($discounted_price);
            }
        }



}