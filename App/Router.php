<?php

namespace Cc\App;
use Cc\App\controller\Base;

class Router
{
    public function hooks(){
        $base=new Base();
        add_filter('woocommerce_product_data_tabs', array($base, 'addFreeGiftTab'));
        add_action('woocommerce_product_data_panels', array($base, 'woocommerceProductCustomFields'));
        add_action( 'woocommerce_process_product_meta', array($base,'saveDiscountValueToDatabase' ));
        add_action( 'woocommerce_before_calculate_totals', array($base,'customPrice') );


    }

}