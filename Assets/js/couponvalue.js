jQuery(document).ready(function($) {
    $('#submit').click(function() {
        var percent=$('#percentage').val();
        var id=$('#id').val();
        var nonce = $('#my_nonce').val();
        $.ajax({
            type: 'post',
            url: contactForm.ajaxUrl,
            data: {
                action: 'my_ajax_handler',
                percent: percent,
                id:id,
                nonce:nonce,
            }
        });
        return false;
    });
});