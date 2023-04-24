<?
defined('ABSPATH') or exit();
?>
<div id="contact-form">
    <form action="" id="form" name="form" method="post">
            <h1>Custom coupon</h1>
       <?php _e( 'Enter the Percentage:','cc-coupon-code')?><br>
        <input type="number"  name="percentage" id="percentage" min="1" max="100" required><br><br>
        <input type="submit" id="submit" class="Submit">
    </form>
    </div>