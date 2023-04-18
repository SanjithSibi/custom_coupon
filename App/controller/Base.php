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
            'target' => 'fg_free_gift',
        );
        return $tabs;
    }


}