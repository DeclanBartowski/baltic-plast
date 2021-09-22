function reinintScripts() {
    $('.wrapper-counter-btn').each(function () {
        // var price = 0
        var metr = parseFloat($(this).find('.product-count').attr('data-langth'));
        var measure = $(this).find('.product-count').attr('data-measure');
        $(this).find('.product-count').on('input', function () {
            var rep = (/^0/);
            var value = $(this).val();
            if (rep.test(value)) {
                value = value.replace(rep, '');
                $(this).val(value);
            }
            var value2 = $(this).val();
            var rep2 = /[a-zA-Zа-яА-Я]/;
            if (rep2.test(value2)) {
                value2 = value2.replace(rep2, '');
                $(this).val(value2);
            }
            var value3 = value.replace(/[^\d,]/g, '')
            $(this).val(value3)
            if ($(this).val() == '') {
                $(this).val(1);
            }

        });
        $(this).find('.product-count').on('change', function () {
            var msg = parseInt($(this).val());
            var msgIn = $(this).attr('data-msg');
            $(this).val(msg + " " + msgIn);
            $(this).closest('.equipment-item').find('.equipment-item_size-digit').text(msg * metr + " " + measure);
            $(this).closest('.product-card_top-panel').find('.product-card_size-digit').text(msg * metr + " " + measure);
            $(this).closest('tr').find('.order-item_size-digit').text(msg * metr + " " + measure);
        });
        $(this).find('.counter-back').on("click", function (e) {
            event.preventDefault();
            var valPlus = $(this).siblings('.product-count').val();
            var result = parseInt(valPlus) - 1;
            var msgIn = valPlus.replace(/[^a-zA-ZА-Яа-яЁё.]/gi, '').replace(/\s+/gi, ', ');
            if (result >= 1) {
                $(this).siblings('.product-count').val(result + " " + msgIn).change();
                $(this).closest('.equipment-item').find('.equipment-item_size-digit').text(result * metr + " " + measure);
                $(this).closest('.product-card_top-panel').find('.product-card_size-digit').text(result * metr + " " + measure);
                $(this).closest('tr').find('.order-item_size-digit').text(result * metr + " " + measure);
            }
        });
        $(this).find('.counter-forward').on("click", function (e) {
            event.preventDefault();
            var valPlus = $(this).siblings('.product-count').val();
            var result = parseInt(valPlus) + 1;
            var msgIn = valPlus.replace(/[^a-zA-ZА-Яа-яЁё.]/gi, '').replace(/\s+/gi, ', ');
            if (result >= 1) {
                $(this).siblings('.product-count').val(result + " " + msgIn).change();
                $(this).closest('.equipment-item').find('.equipment-item_size-digit').text(result * metr + " " + measure);
                $(this).closest('.product-card_top-panel').find('.product-card_size-digit').text(result * metr + " " + measure);
                $(this).closest('tr').find('.order-item_size-digit').text(result * metr + " " + measure);
            }
        });
    });
}

function ajaxUpdate(reinit = false) {
    $.get(SITE_DIR + "ajax/basketupdate.php?tqAjax=Y", function (data) {
        $('.tq-basket-container').html(data);
        BX.onCustomEvent('OnBasketChange');
        if (reinit) {
            reinintScripts();
        }
    });
}

function UpdateFavComp() {
    $.ajax({
        url: SITE_DIR + "ajax/basket.php",
        type: "POST",
        dataType: 'json',
        data: {action: 'countfavcomp'},
        success: function (data) {

            $('.dds_fav_count').html(data.TEXT);
            $('.dds_fav_quan').attr('data-quantity', data.FAV);
        }
    });
}

$(document).on('click', '[data-show-more]', function () {
    var btn = $(this);
    var page = btn.attr('data-next-page');
    var id = btn.attr('data-show-more');
    var bx_ajax_id = btn.attr('data-ajax-id');
    var block_id = "#comp_" + bx_ajax_id;

    var data = {
        bxajaxid: bx_ajax_id
    };
    data['PAGEN_' + id] = page;

    $.ajax({
        type: "GET",
        url: window.location.href,
        data: data,
        timeout: 3000,
        success: function (data) {
            $("#btn_" + bx_ajax_id).remove();
            $(block_id).append(data);
            lazyLoad($('body'));
        }
    });
});

$(document).on('click change submit', '[data-action]', function (e) {
    var action = $(this).attr('data-action');
    var $this = $(this);
    var data = {};
    var rep = (/^0/);
    data['action'] = action;

    switch (e.type) {
        case 'click':
            switch (action) {
                case 'add2basket':
                    var id = $this.attr('data-id');
                    data['id'] = id;
                    var quantity = $('.product-count').val();
                    if (rep.test(quantity)) {
                        quantity = quantity.replace(rep, '');
                    }
                    data['quantity'] = parseFloat(quantity);
                    data['error_msg'] = $this.attr('data-add-error');
                    data['added_to_basket'] = $this.attr('data-added');
                    break;
                case 'delete':
                    data['id'] = $this.attr('data-id');
                    break;
                case 'clear_basket':
                    break;
                case 'addSolution':

                    $.each($('[name="products"]:checked'), function (i, v) {
                        if (data['PRODUCTS'] === undefined) {
                            data['PRODUCTS'] = {};
                        }
                        data['PRODUCTS'][i] = {
                            'ID': $(v).val(),
                            'QUANTITY': $('[name="quantity[' + $(v).val() + ']"]').val(),
                            'ERROR': $(v).attr('data-add-error')
                        }
                    });
                    data['added_to_basket'] = $this.attr('data-added');
                    if (data['PRODUCTS'] === undefined) {
                        return false;
                    }
                    break;
                default:
                    return false;
                    break;
            }
            break;
        case 'change':
            switch (action) {
                case 'updatebasket':
                    data['id'] = $this.attr('data-id');
                    var quantity = $this.val();
                    if (rep.test(quantity)) {
                        quantity = quantity.replace(rep, '');
                    }
                    data['quantity'] = parseFloat(quantity);
                    break;
                default:
                    return false;
                    break;
            }
            break;

        case 'submit':
        default:
            return false;
            break;
            break;
    }
    $.ajax({
        url: SITE_DIR + "ajax/ajax.php",
        type: "POST",
        dataType: 'json',
        data: data,
        success: function (result) {
            switch (action) {
                case 'add2basket':
                    if (result.TYPE == 'SUCCESS') {
                        if ($this.hasClass('is-active')) {
                        } else {
                            $this.find('.text').text($this.attr('data-to-basket'));
                            $this.addClass('is-active');
                            $this.removeAttr('data-action');
                            $this.attr('href', SITE_DIR + 'basket/')
                            $this.closest('.product-item').addClass('is-active')
                        }
                    } else {
                        alert(result.MESSAGE)
                    }
                    break;
                case 'addSolution':
                    if (result.TYPE == 'SUCCESS') {
                        if ($this.hasClass('is-active')) {
                        } else {
                            $this.find('.text').text($this.attr('data-to-basket'));
                            $this.addClass('is-active');
                            $this.removeAttr('data-action');
                            $this.attr('href', SITE_DIR + 'basket/')
                            $this.closest('.product-item').addClass('is-active')
                        }
                    } else {
                        alert(result.MESSAGE);
                    }
                    break;
            }
            var rein = false;
            if (action == 'updatebasket') {
                rein = true;
            }
            ajaxUpdate(rein);
        }
    });
    return false;
});

$(document).on('submit', '#ORDER', function () {
    $('.tqOrderError').html('');
    $.ajax({
        url: SITE_DIR + "ajax/order.php",
        type: "POST",
        dataType: 'json',
        data: $(this).serialize(),
        success: function (result) {
            if (result.STATUS == "ERROR") {
                $('.tqOrderError').html(result.HTML);
            } else {
                location.href = location.pathname + '?ORDER_ID=' + result;
            }
        }
    });

    return false;
});

BX.addCustomEvent('onAjaxSuccess', function () {
    lazyLoad($('body'));
});

$(document).on('change', '[name="products"],.product-count', function () {
    var products = $('[name="products"]:checked');
    var resultBlock = $('.equipment-footer');
    var addBLock = $('[data-action="addSolution"]');
    var priceSum = 0;
    var discountSum = 0;
    var currency = '';
    if (products.length > 0) {
        $.each(products, function (i, input) {
            var price = parseFloat($(input).attr('data-price'));
            var discount = parseFloat($(input).attr('data-discount'));
            var measure = $(input).attr('data-measure');
            currency = $(input).attr('data-currency');
            var quantity = parseFloat($('[name="quantity[' + $(input).val() + ']"]').val());
            priceSum += price * quantity;
            discountSum += discount * quantity;
        });
        var formatPrice = BX.Currency.currencyFormat(priceSum, currency, true);
        var formatDiscount = BX.Currency.currencyFormat(discountSum, currency, true);
        resultBlock.find('.equipment_total-table .tq-discount-result').html(formatDiscount);
        resultBlock.find('.equipment_total-sum').html(formatPrice);
        resultBlock.show();
        addBLock.removeAttr('style');
    } else {
        resultBlock.find('.equipment_total-table .tq-discount-result').html('');
        resultBlock.find('.equipment_total-sum').html('');
        resultBlock.hide();
        addBLock.attr('style', 'display:none');
    }
});


$(document).on('click', '[data-input]', function () {
    var inputId = $(this).attr('data-input');
    $('#' + inputId).prop('checked', true);
});
$(document).on('click', '[data-all]', function () {
    var inputName = $(this).attr('data-all');
    $('[name="' + inputName + '"]').prop('checked', false);
});

let ajax;

function tqSmartFilter() {
    if (!!ajax) {
        ajax.abort();
    }
    var formData = $('.smartfilter').serialize();
    ajax = $.ajax({
        type: "GET",
        url: location.pathname,
        data: formData,
        success: function (data) {
            $('.catalog-section').html($('.catalog-section', data).html());
            $('.js-select').selectric({
                maxHeight: 300,
                disableOnMobile: false,
                nativeOnMobile: false,
            });

            lazyLoad($('body'));

            $('.filter-btn').on('click', function () {
                $('.filter-fixed').addClass('is-open');
                $('.bg-overlay').fadeIn(150);
                if (is_mobile()) {
                    $('html').addClass('is-hidden');
                }
            });

            $('.filter_price-label').on('click', function () {
                $('.filter_price-dropdown').slideToggle(10);
                $(this).toggleClass('is-active');
            });
            $('body').on("touchend, click", function (e) {
                if ($(e.target).closest(".filter_price-label").length || $(e.target).closest(".filter_price-dropdown").length) return;
                $('.filter_price-dropdown').slideUp(10);
                $('.filter_price-label').removeClass('is-active');
            });
            var sliders = $(".slider-range")
            sliders.each(function () {
                var number = parseInt($(this).closest('.filter-number').find('.price-min').data('number'));
                var number2 = parseInt($(this).closest('.filter-number').find('.price-max').data('number'));
                $(this).closest('.filter-number').find(".price-min").on('input', function () {
                    var value1 = $(this).val();
                    var rep = /[a-zA-Zа-яА-Я]/;
                    if (rep.test(value1)) {
                        value1 = value1.replace(rep, '');
                        $(this).val(value1);
                    }
                });
                $(this).closest('.filter-number').find(".price-max").on('input', function () {
                    var value2 = $(this).val();
                    var rep = /[a-zA-Zа-яА-Я]/;
                    if (rep.test(value2)) {
                        value2 = value2.replace(rep, '');
                        $(this).val(value2);
                    }
                });
                $(this).closest('.filter-number').find(".price-min").on('change', function () {
                    var value1 = parseInt($(this).val());
                    var value2 = parseInt($(this).closest('.filter-number').find('.price-max').val());
                    if ($(this).val() == '') value1 = 1
                    if (value1 > number2) {
                        $(this).val(number2);
                        value1 = number2;
                    }
                    if (value1 < number) {
                        $(this).val(number);
                        value1 = number;
                    }
                    if (value1 > value2) {
                        $(this).val(value2);
                        value1 = value2;
                    }
                    $(this).closest('.filter-number').find('.slider-range').slider("values", 0, value1);
                    $(this).closest('.filter-number').find(".first-price").text(value1);
                });
                $(this).closest('.filter-number').find(".price-max").on('change', function () {
                    var value1 = parseInt($(this).closest('.filter-number').find(".price-min").val());
                    var value2 = parseInt($(this).val());
                    if ($(this).val() == '') value2 = number2
                    if (value2 > number2) {
                        $(this).val(number2);
                        value2 = number2;
                    }
                    if (value2 < number) {
                        $(this).val(number);
                        value2 = number;
                    }
                    if (value1 > value2) {
                        $(this).val(value1);
                        value2 = value1;
                    }
                    $(this).closest('.filter-number').find('.slider-range').slider("values", 1, value2);
                    $(this).closest('.filter-number').find(".second-price").text(value2);
                });
                if ($(this).hasClass('slider-range_vertical')) {

                    var curMin = $(this).closest('.filter-number').find(".price-min").val();
                    var curMax = $(this).closest('.filter-number').find(".price-max").val();
                    if (isNaN(curMax)) {
                        curMin = number;
                    }
                    if (isNaN(parseInt(curMax))) {
                        curMax = number2;
                    }

                    $(this).slider({
                        animate: true,
                        range: true,
                        orientation: "vertical",
                        min: number,
                        max: number2,
                        values: [
                            curMin,
                            curMax
                        ],
                        slide: function (event, ui) {
                            $(this).closest('.filter-number').find(".price-min").val(ui.values[0]).change();
                            $(this).closest('.filter-number').find(".price-max").val(ui.values[1]).change();
                        }
                    });
                } else {

                    var curMin = $(this).closest('.filter-number').find(".price-min").val();
                    var curMax = $(this).closest('.filter-number').find(".price-max").val();
                    if (isNaN(curMax)) {
                        curMin = number;
                    }
                    if (isNaN(parseInt(curMax))) {
                        curMax = number2;
                    }

                    $(this).slider({
                        animate: true,
                        range: true,
                        min: number,
                        max: number2,
                        values: [
                            curMin,
                            curMax
                        ],
                        slide: function (event, ui) {
                            $(this).closest('.filter-number').find(".price-min").val(ui.values[0]).change();
                            $(this).closest('.filter-number').find(".price-max").val(ui.values[1]).change();
                            $(this).closest('.filter-number').find(".first-price").text(ui.values[0]);
                            $(this).closest('.filter-number').find(".second-price").text(ui.values[1]);
                        }
                    });
                }
            });
            history.pushState(null, null, location.pathname + '?' + formData);
        }
    });
}

$(document).on('change', '.smartfilter', function () {
    tqSmartFilter();
});
$(document).on('click', '.switch-language_list a', function () {
    var newDir = $(this).attr('href');
    var currentLink = location.pathname;
    var newLink = currentLink.replace(SITE_DIR, newDir)
    location.href = newLink;
    return false;
});