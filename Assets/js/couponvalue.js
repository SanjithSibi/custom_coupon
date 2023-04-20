jQuery(document).ready(function($) {
    $('#submit').click(function() {
        alert('hi');

        var percent=$('#percentage').val();
        alert(percent);
        $.ajax({
            type: 'post',
            url: contactForm.ajaxUrl,
            data: {
                action: 'submitForm',
                percent: percent,
            }
        });
        return false;
    });
});
