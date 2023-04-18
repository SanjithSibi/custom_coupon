<div id="cc-custom-coupon" class="panel woocommerce_options_panel hidden">
    <?php _e('Enter the percentage', 'cc-custom-coupon');
    ?>

    <input type="number" id="discount_percentage" name="discount_percentage" value="<?php echo isset($Value) && !empty($Value) ? $Value:'';?>" min="1" max="100">


</div>

