<?php

namespace Cc\App;
use Cc\App\controller\Base;

class Router
{
    public function hooks(){
        $base=new Base();
        add_action('admin_menu', array($base, 'addingMenu'));
        add_action('wp_ajax_submitForm', array($base, 'submitForm'));
        add_action( 'woocommerce_cart_calculate_fees', array($base,'applyCustomDiscount' ));




    }

}