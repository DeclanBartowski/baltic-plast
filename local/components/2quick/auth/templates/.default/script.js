$(document).on('submit', '.login-form', function (e) {
    e.preventDefault();
    var form = $(this);
    var $data = {};
    $.each(form.serializeArray(), function () {
        $data[this.name] = this.value;
    });
    BX.ajax.runComponentAction('2quick:auth',
        'auth', {
            mode: 'class',
            data: {data: $data}
        })
        .then(function (response) {
            if (response.data.STATUS === 'SUCCESS') {
                location.reload();
            } else {
                form.find('.tq-component-error').html(response.data.MESSAGE).show();
            }
        });
    return false;
});
