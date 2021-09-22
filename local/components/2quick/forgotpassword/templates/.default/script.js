$(document).on('submit', '.forgot-password-form', function (e) {
    e.preventDefault();
    var form = $(this);
    var $data = {};
    $.each(form.serializeArray(), function () {
        $data[this.name] = this.value;
    });
    BX.ajax.runComponentAction('2quick:forgotpassword',
        'restorePassword', {
            mode: 'class',
            data: $data
        })
        .then(function (response) {
            if (response.data.STATUS === 'SUCCESS') {
                //form.find('.tq-component-error').html(response.data.MESSAGE).show();
                $('.modal').modal('hide');
                $('#password-changed').modal('show');
            } else {
                form.find('.tq-component-error').html(response.data.MESSAGE).show();
            }
        });
    return false;
});
