<?php

namespace Cc\App;
use Cc\App\controller\Base;

class Router
{
    public function hooks(){
        $base=new Base();
        add_action('admin_menu', array($base, 'addingMenu'));
        add_action('wp_enqueue_scripts', array($base, 'myScripts'));
        add_filter('woocommerce_product_data_tabs', array($base, 'addFreeGiftTab'));
        add_action('woocommerce_product_data_panels', array($base, 'woocommerceProductCustomFields'));
        add_action( 'woocommerce_process_product_meta', array($base,'saveDiscountValueToDatabase' ));
    }

}