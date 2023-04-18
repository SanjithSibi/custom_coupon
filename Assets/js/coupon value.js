jQuery(document).ready(function($) {
    $('#submit').click(function() {
        alert('hi');

        var values=$('#form').serializeArray();
        alert(values);

        $.ajax({
            type: 'post',
            url: contactForm.ajaxUrl,
            data: {
                action: 'submitForm',
                values:values,
            }
        });
        return false;
    });
});
