$(document).on('submit', '.tq-register-form', function (e) {
    e.preventDefault();
    var form = $(this);
    var $data = {};
    $.each(form.serializeArray(), function () {
        $data[this.name] = this.value;
    });
    BX.ajax.runComponentAction('2quick:registration',
        'register', {
            mode: 'class',
            data: $data
        })
        .then(function (response) {
            if (response.data.STATUS === 'SUCCESS') {
                //form.find('.tq-component-error').html(response.data.MESSAGE).show();
                $('.modal').modal('hide');
                $('#registered-successfully').modal('show');
            } else {
                form.find('.tq-component-error').html(response.data.MESSAGE).show();
            }
        });
    return false;
});