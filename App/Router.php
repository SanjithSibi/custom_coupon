<?php
namespace Cc\App;
defined('ABSPATH') or exit();

use Cc\App\controller\Base;
class Router
{
    public function hooks(){
        $base=new Base();
        add_action('admin_menu', array($base, 'addingMenu'));
       // add_action('woocommerce_process_product_meta', array($base, 'processProductMeta'),10,1);

        // add_action('wp_ajax_submitForm', array($base, 'submitForm'));

        add_action( 'wp_ajax_my_action', array($base,'myActionCallback' ));
        add_action( 'wp_ajax_nopriv_my_action', array($base,'myActionCallback' ));
        //add_action( 'woocommerce_cart_calculate_fees', array($base,'addVirtualCoupon' ));
         add_filter( 'woocommerce_get_shop_coupon_data', array($base,'myCustomCouponData'), 10, 2 );

    }

}