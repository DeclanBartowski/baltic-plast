function is_mobile() {
    return (/Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent))
}

$(window).on('load', function () {
    if (!is_mobile()) {
        NProgress.configure({
            parent: '.loader-content'
        });
        NProgress.start();
        NProgress.done();
        setTimeout(function () {
            $('.wrapper-loader').fadeOut(200);
        }, 500);
    }
    var heightHead = $('.ui-header').outerHeight();
    jQuery(window).on("resize", function () {
        heightHead = +parseInt($('.ui-header').outerHeight());
    });
    jQuery(window).on("scroll load", function () {
        if ($(window).scrollTop() > heightHead) {
            $('.ui-header').addClass('fixed-menu');
            $('.global-wrapper').css('paddingTop', heightHead);
            setTimeout(function () {
                $('.ui-header').addClass('scroll-transform');
            }, 100);
        } else {
            $('.ui-header').removeClass('fixed-menu');
            $('.ui-header').removeClass('scroll-transform');
            $('.global-wrapper').css('paddingTop', 0);
        }
        if ($(window).scrollTop() > $(window).height()) {
            $('.scroll-to-top').addClass('scroll-to-top-visible');
        } else {
            $('.scroll-to-top').removeClass('scroll-to-top-visible');
        }
        if ($(window).width() < 575) {
            var h_cart = $('.cart-total_box').outerHeight();
            var w_height = $(window).height();
            var w_top = $(window).scrollTop();
            $('.main-footer').css('paddingBottom', h_cart);
            if (w_top > w_height) {
                $('.cart-total_box').addClass('fixed');
            } else {
                $('.cart-total_box').removeClass('fixed');
            }
        }
    });
});
jQuery(document).ready(function ($) {
    if (is_mobile()) {
        setTimeout(function () {
            $('.wrapper-loader').fadeOut(150);
        }, 600);
    }
    lazyLoad($('body'));
    if ($('.product-card_btn').length && $(window).width() < 575) {
        $('.main-footer').addClass('is-bottom');
    }
    $(".hamburger").on("click", function () {
        $(this).toggleClass('is-active');
        $('.head_nav-panel').toggleClass('is-open');
        $('.bg-overlay').fadeToggle(150);
        if (is_mobile()) {
            $('html').toggleClass('is-hidden');
        }
    });
    $('.bg-overlay').on('click', function () {
        $('.head_nav-panel').removeClass('is-open');
        $(".hamburger").removeClass('is-active');
        $('.filter-fixed').removeClass('is-open');
        $(this).fadeOut(150);
        if (is_mobile()) {
            $('html').toggleClass('is-hidden');
        }
    });
    $('.filter-btn').on('click', function () {
        $('.filter-fixed').addClass('is-open');
        $('.bg-overlay').fadeIn(150);
        if (is_mobile()) {
            $('html').addClass('is-hidden');
        }
    });
    $('.catalog-filter_close-btn').on('click', function () {
        $('.filter-fixed').removeClass('is-open');
        $('.bg-overlay').fadeOut(150);
        if (is_mobile()) {
            $('html').removeClass('is-hidden');
        }
    });
    $('.switch-language .language-label').on('click', function () {
        $('.switch-language_list').slideToggle(200);
        $(this).toggleClass('is-active');
    });
    $('.form-control').focus(function () {
        $(this).closest('.form-group').addClass('focus');
    });
    $('.form-control').blur(function () {
        if ($(this).val().length == 0) {
            $(this).closest('.form-group').removeClass('focus');
        }
    });
    $('form').find('.form-control').each(function () {
        if ($(this).val().length > 1) {
            $(this).closest('.form-group').addClass('focus');
        }
    })
    /*$('.product-item_btn').on('click', function () {
        if ($(this).hasClass('is-active')) {
        } else {
            $(this).find('.text').text('Перейти в корзину');
            $(this).addClass('is-active');
            $(this).closest('.product-item').addClass('is-active')
            return false;
        }
    })
    $('.product-card_btn').on('click', function () {
        if ($(this).hasClass('is-active')) {
        } else {
            $(this).find('.text').text('Перейти в корзину');
            $(this).addClass('is-active');
            return false;
        }
    })*/
    $('.js_register-btn').on("click", function () {
        $('#login').modal('hide');
        $('#access').modal('hide');
        $('#register').modal('show');
        return false;
    });
    $('.js_login-btn').on("click", function () {
        $('#login').modal('show');
        $('#register').modal('hide');
        $('#access').modal('hide');
        return false;
    });
    $('.forgot-password_btn').on("click", function () {
        $('#login').modal('hide');
        $('#register').modal('hide');
        $('#access').modal('show');
        return false;
    });
    $('.catalog_color-list li').on("click", function () {
        $(this).siblings().removeClass('is-active');
        $(this).toggleClass('is-active')
    });
    $('.catalog-filter_item-title').on('click', function () {
        $(this).toggleClass('active');
        $(this).closest('.catalog-filter_item').find('.catalog-filter_item-body').slideToggle(150);
    });
    $('.order-item_th-collapse-btn').on('click', function () {
        $(this).closest('.order-item').toggleClass('is-active');
    });
    $('.order-item_mobile-btn').on("click", function () {
        if ($(this).find('.text').html() == 'Свернуть') {
            $(this).closest('.order-item').removeClass('is-active');
            $(this).find('.text').text('Детали');
        } else {
            $(".main-section .main-menu-hidden").slideDown(200);
            $(this).closest('.order-item').addClass('is-active');
            $(this).find('.text').text('Свернуть');
        }
    });
    // $('.equipment-item').on('click', function(e) {
    // 	if( $(e.target).closest(".unified-checkbox").length || $(e.target).closest(".wrapper-counter-btn").length) {
    // 	} else{
    // 		$(this).toggleClass('is-active');
    // 		if($(this).hasClass('is-active')){
    // 			$(this).find('.item-checkbox').prop('checked', true);
    // 		} else{
    // 			$(this).find('.item-checkbox').prop('checked', false);
    // 		}
    // 	}
    // });
    $('.equipment-item .unified-checkbox').on('click', function () {
        if ($(this).find('.item-checkbox').prop("checked") === false) {

            $(this).closest('.equipment-item').removeClass('is-active');
        } else {
            $(this).closest('.equipment-item').addClass('is-active');
        }
    });
    // $('.filter-fixed_body input[type=checkbox]').each(function(){
    // 	$(this).on('click',function(){
    // 		if($(this).prop("checked")){
    // 			$('.catalog-filter_apply-btn').addClass('is-active');
    // 		} else{
    // 			$('.catalog-filter_apply-btn').removeClass('is-active');
    // 		}
    // 	})
    // });

    $('.filter-fixed_body .unified-checkbox').on('click', function () {
        $(this).closest('.filter-fixed_body').find('input[type=checkbox]').each(function () {
            if ($('input[type=checkbox]:checked').length > 0) {
                $('.catalog-filter_apply-btn').addClass('is-active');
            } else {
                $('.catalog-filter_apply-btn').removeClass('is-active');
            }
        });
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
    $('.switch-btn').click(function () {
        $(this).toggleClass('switch-on');
        $(this).trigger('on.switch');
    });
    $('.main-slider').slick({
        slidesToShow: 1,
        slidesToScroll: 1,
        fade: true,
        arrows: false,
        dots: true,
    });
    $('.solution-catalog_slider').slick({
        slidesToShow: 1,
        slidesToScroll: 1,
        fade: true,
        arrows: false,
        dots: true,
    });
    $('.banner-slider').slick({
        slidesToShow: 1,
        slidesToScroll: 1,
        fade: true,
        arrows: false,
        dots: true,
    });
    $('.article-detailed_slider').slick({
        slidesToShow: 1,
        slidesToScroll: 1,
        fade: true,
        arrows: false,
        dots: true,
    });
    $('.solution-item_img').slick({
        slidesToShow: 1,
        slidesToScroll: 1,
        arrows: false,
        dots: true,
    });
    $('.partners-slider').slick({
        slidesToShow: 4,
        slidesToScroll: 1,
        focusOnSelect: true,
        responsive: [{
            breakpoint: 992,
            settings: {
                slidesToShow: 3,
                slidesToScroll: 1,
            }
        }, {
            breakpoint: 576,
            settings: {
                slidesToShow: 2,
                slidesToScroll: 1,
                autoplay: true,
                autoplaySpeed: 6000,
            }
        },]
    });
    $('.product-card_slider').slick({
        slidesToShow: 1,
        slidesToScroll: 1,
        infinite: false,
        speed: 200,
        fade: true,
        arrows: false,
        asNavFor: '.product-card_small-slider',
    });
    $('.product-card_small-slider').slick({
        slidesToShow: 5,
        slidesToScroll: 1,
        infinite: false,
        speed: 200,
        focusOnSelect: true,
        vertical: true,
        asNavFor: '.product-card_slider',
        responsive: [{
            breakpoint: 1200,
            settings: {
                slidesToShow: 4,
                slidesToScroll: 1,
            }
        }, {
            breakpoint: 992,
            settings: {
                slidesToShow: 4,
                slidesToScroll: 1,
            }
        }, {
            breakpoint: 576,
            settings: {
                slidesToShow: 3,
                slidesToScroll: 1,
                vertical: false,
            }
        }, {
            breakpoint: 360,
            settings: {
                slidesToShow: 2,
                slidesToScroll: 1,
                vertical: false,
            }
        },]
    });
    $('.viewed-products_slider').slick({
        slidesToShow: 4,
        slidesToScroll: 4,
        prevArrow: '<span class="ico-arrow slick-prev"></span>',
        nextArrow: '<span class="ico-arrow slick-next"></span>',
        appendArrows: $('.viewed-products_counter'),
        responsive: [{
            breakpoint: 1200,
            settings: {
                slidesToShow: 3,
                slidesToScroll: 3,
            }
        }, {
            breakpoint: 767,
            settings: {
                slidesToShow: 2,
                slidesToScroll: 2,
                arrows: false,
                dots: true,
            }
        }, {
            breakpoint: 576,
            settings: {
                slidesToShow: 1,
                slidesToScroll: 1,
                arrows: false,
                dots: true,
            }
        },]
    });
    if ($('.viewed-products_slider').length) {
        var number = $(".viewed-products_slider").find('.slick-slide:not(.slick-cloned)').length;
        var currentIndex = $(".viewed-products_slider").find('.slick-active').index();
        $('.viewed-products_section').find('.pagination-digit').text(number);
        $('.viewed-products_section').find('.pagination-number').text(currentIndex);
        $(".viewed-products_slider").on('afterChange', function () {
            var number = $(this).find('.slick-slide:not(.slick-cloned)').length;
            currentIndex = $(this).find('.slick-active').index();
            $('.viewed-products_section').find('.pagination-digit').text(number);
            $('.viewed-products_section').find('.pagination-number').text(currentIndex);
        });
    }
    $('.work-process_slider').slick({
        slidesToShow: 1,
        slidesToScroll: 1,
        centerMode: true,
        centerPadding: '22.5%',
        responsive: [{
            breakpoint: 767,
            settings: {
                slidesToShow: 1,
                slidesToScroll: 1,
                centerPadding: '15%',
            }
        }, {
            breakpoint: 576,
            settings: {
                slidesToShow: 1,
                slidesToScroll: 1,
                dots: true,
                arrows: false,
                centerPadding: '10%',
            }
        },]
    });
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
    $('.js-select').selectric({
        maxHeight: 300,
        disableOnMobile: false,
        nativeOnMobile: false,
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
    if (!is_mobile()) {
        if ($('.advantages-box_digit').length) {
            var show = true;
            $(window).on("scroll load resize", function () {
                if (!show) return false;
                var w_top = $(window).scrollTop();
                var e_top = $('.advantages-box_digit').offset().top;
                if (w_top + $(window).height() > e_top) {
                    $('.advantage-item_mod').removeClass('is-fade');
                    $('.advantage-item_digit').each(function (index) {
                        var jthis = $(this);
                        jthis.spincrement({
                            from: 0,
                            // to:false,
                            decimalPlaces: 0,
                            decimalPoint: '.',
                            thousandSeparator: '',
                            duration: 3000, // ms; TOTAL length animation
                            leeway: 150, // percent of duraion
                            easing: 'spincrementEasing',
                        });
                    });
                    show = false;
                }
            });
        }
    }
    if (is_mobile()) {
        $('.advantage-item_mod').removeClass('is-fade');
    }
    if ($('.cart-total_box').length) {
        jQuery(window).on("scroll load resize", function () {
            if ($(window).width() > 1199) {
                var r_det = $('.cart_right-column').offset().top;
                var w_top = $(window).scrollTop();
                var r_top = $('.cart_right-column').outerHeight();
                var r_height = $('.cart-total_box').outerHeight();
                var h_eighbor = $('.cart_left-column').outerHeight();
                var heigthead = $('.ui-header').outerHeight();
                if (h_eighbor > r_height) {
                    if (w_top >= r_det) {
                        $('.cart-total_box').addClass('is-sticky');
                    } else {
                        $('.cart-total_box').removeClass('is-sticky');
                    }
                    if (w_top + r_height + heigthead >= (r_top + r_det)) {
                        $('.cart-total_box').addClass('is-static');
                    } else {
                        $('.cart-total_box').removeClass('is-static');
                    }
                }
            }
        });
    }
    if ($('.js-fixed-slider').length) {
        jQuery(window).on("scroll load resize", function () {
            if ($(window).width() > 991) {
                var r_det = $('.product-card_left-column').offset().top;
                var w_top = $(window).scrollTop();
                var r_top = $('.product-card_left-column').outerHeight();
                var r_height = $('.js-fixed-slider').outerHeight();
                var h_eighbor = $('.product-card_desc').outerHeight();
                var heigthead = $('.ui-header').outerHeight();
                if (h_eighbor > r_height) {
                    if (w_top >= r_det) {
                        $('.js-fixed-slider').addClass('is-sticky');
                    } else {
                        $('.js-fixed-slider').removeClass('is-sticky');
                    }
                    if (w_top + r_height + heigthead >= (r_top + r_det)) {
                        $('.js-fixed-slider').addClass('is-static');
                    } else {
                        $('.js-fixed-slider').removeClass('is-static');
                    }
                }
            }
        });
    }
    $(document).find('.slick-cloned a').removeAttr('data-fancybox');
    $(".fancybox").fancybox({
        afterLoad: function (instance, current) {
            if (!is_mobile()) {
                $('.fixed-menu').addClass('is-overflow');
                $('.scroll-to-top').addClass('is-hidden');
            }
        },
        afterClose: function (instance, current) {
            if (!is_mobile()) {
                $('.fixed-menu').removeClass('is-overflow');
                $('.scroll-to-top').removeClass('is-hidden');
            }
        },
        backFocus: false,
    });
    if (!is_mobile()) {
        $('.js-modal').on('show.bs.modal', function (event) {
            $('.fixed-menu').addClass('is-overflow');
            $('.scroll-to-top').addClass('is-hidden');
        });
        $('.js-modal').on('hidden.bs.modal', function (event) {
            $('.fixed-menu').removeClass('is-overflow');
            $('.scroll-to-top').removeClass('is-hidden');
        });
    }
    $('.js-modal').on('shown.bs.modal', function () {
        $(this).find('.form-group').first().addClass('focus');
        $(this).find('.form-group').first().find('.form-control').trigger('focus');
    });
    $('.scroll-to-top').on('click', function () {
        $('html, body').animate({
            scrollTop: 0
        }, 800);
    });

    var phoneError = '<span class="error">Введите номер телефона</span>';
    var emailError = '<span class="error">Введите корректный E-mail</span>';
    var emptyFieldError = '<span class="error">Заполните поле</span>';
    if (SITE_DIR == '/en/') {
        phoneError = '<span class="error">Enter your phone number</span>';
        emailError = '<span class="error">Please enter a valid E-mail</span>';
        emptyFieldError = '<span class="error">Fill in the field</span>';
    }
    if (SITE_DIR == '/pl/') {
        phoneError = '<span class="error">Wprowadź swój numer telefonu</span>';
        emailError = '<span class="error">Proszę podać poprawny adres e-mail</span>';
        emptyFieldError = '<span class="error">Wypełnij pole</span>';
    }

    $('input[type="tel"]').inputmask("+7 (999) 999 99 99", {
        "clearIncomplete": true,
        showMaskOnHover: false,
    });


    $('.js_form-submit').on("click", function () {
        var jhis = $(this).closest('form');
        $(jhis).find('.requiredField').removeClass('input-error');
        $(jhis).find('.error').remove();
        var error = 0;
        $(jhis).find('.requiredField').each(function () {
            if ($(this).hasClass('callback-phone')) {
                if ($(this).val().length < 10) {
                    $(this).after(phoneError);
                    $(this).addClass('input-error');
                    error = 1;
                }
            } else if ($(this).hasClass('callback-email')) {
                var emailReg = /^([a-z0-9_\.-])+@[a-z0-9-]+\.([a-z]{2,4}\.)?[a-z]{2,4}$/i;
                if (emailReg.test($(this).val()) == false) {
                    $(this).after(emailError);
                    $(this).addClass('input-error');
                    error = 2;
                }
            } else if ($(this).hasClass('callback-name')) {
                if ($(this).val().length < 3) {
                    $(this).addClass('input-error');
                    $(this).after(emptyFieldError);
                    error = 3;
                }
            } else if ($(this).hasClass('callback-text')) {
                if ($(this).val().length < 10) {
                    $(this).addClass('input-error');
                    $(this).after(emptyFieldError);
                    error = 4;
                }
            }
        });
        if (error == 0) {
            /*отправка формы**/
            // $('#register').modal('hide');
            // $('#registered-successfully').modal('show');
        } else {
            return false;
        }
    });
});

function lazyLoad($content) {
    $content.find('img[data-src], source[data-src], audio[data-src], iframe[data-src]').each(function () {
        $(this).attr('src', $(this).data('src'));
        $(this).removeAttr('data-src');
        if ($(this).is('source')) {
            $(this).closest('video').get(0).load();
        }
    });
}

