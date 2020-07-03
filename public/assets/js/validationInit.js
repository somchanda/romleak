function formValidation() {
    "use strict";
    /*----------- BEGIN validate CODE -------------------------*/
    $('#login_validation').validate({
        rules: {
            email: {
                required: true
            },
            password: {
                required: true,
                minlength:5
            }
        },
        errorClass: 'help-block col-lg-12',
        errorElement: 'span',
        highlight: function (element, errorClass, validClass) {
            $(element).parents('.form-group').removeClass('has-success').addClass('has-error');
        },
        unhighlight: function (element, errorClass, validClass) {
            $(element).parents('.form-group').removeClass('has-error').addClass('has-success');
        }
    });
    /*----------- END validate CODE -------------------------*/
}
