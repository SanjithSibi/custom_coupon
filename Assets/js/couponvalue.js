
jQuery(document).ready(function($) {
    $('#submit').click(function() {
        var percent=$('#percentage').val();
        alert(percent);
        $.ajax({
            type: 'post',
            url: contactForm.ajaxUrl,
            data: {
                action: 'applyCustomCoupon',
                percent: percent,
            }
        });
        return false;
    });
});