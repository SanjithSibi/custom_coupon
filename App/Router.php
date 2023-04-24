<?php


namespace Cc\App;
defined('ABSPATH') or exit();

use Cc\App\controller\Base;

class Router
{
    public function hooks(){
        $base=new Base();
        add_action('admin_menu', array($base, 'addingMenu'));
//        add_action('wp_ajax_submitForm', array($base, 'submitForm'));
//        add_action('wp_ajax_privation_submitForm', array($base, 'submitForm'));
//        add_action( 'woocommerce_cart_calculate_fees', array($base,'applyCustomCoupon' ));
        //add_action('woocommerce_before_calculate_totals', array($base,'applyCoupon'));
//        add_action( 'woocommerce_before_calculate_totals', array($base,'auto_apply_non_persistent_coupon' ));
//        add_action( 'delete_temp_coupon', array($base,'delete_temporary_coupon' ));
        add_action('woocommerce_before_cart',array($base, 'cxc_apply_coupon_code_cart'));











    }

}