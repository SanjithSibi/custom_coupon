<?php

namespace Cc\App;
use Cc\App\controller\Base;

class Router
{
    public function hooks(){
        $base=new Base();
        add_filter('woocommerce_product_data_tabs', array($base, 'addFreeGiftTab'));

    }

}