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
        wc_get_template( 'admin_product_edit.php', array(), '',WP_PLUGIN_DIR . '/custom_coupon/App/view/' );

    }
    function myScripts()
    {
    //    wp_enqueue_style( 'plugin-styles', FBT_PATH . '/Assets/css/frontend.css',__FILE__ );
        wp_enqueue_script('bought-together', CC_PATH . '/Assets/js/coupon value.js', array('jquery'), '1.0', true);
        wp_localize_script('bought-together', 'contactForm', array(
            'ajaxUrl' => admin_url('admin-ajax.php')
        ));
    }
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
}