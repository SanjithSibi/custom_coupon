<?
defined('ABSPATH') or exit();
?>
<div id="contact-form">
    <form action="" id="form" name="form" method="post">
            <h1>Custom coupon</h1>
        <input type="hidden" name="my_nonce" id="my_nonce" value="<?php echo wp_create_nonce( 'my_ajax_nonce' ); ?>">
        <?php _e( 'Enter Coupon id:','cc-coupon-code')?><br>
        <input type="text"  name="id" id="id" required><br><br>
       <?php _e( 'Enter the Percentage:','cc-coupon-code')?><br>
        <input type="number"  name="percentage" id="percentage" min="1" max="100" required><br><br>
        <input type="submit" id="submit" class="Submit">
    </form>
    </div>