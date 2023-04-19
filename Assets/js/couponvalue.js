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
            },
            success: function (response) {
                alert('successfully sent');
                console.log(response.data);


            },
            error: function () {
                alert('hi');

            }
        });
        return false;
    });
});
