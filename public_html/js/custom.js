jQuery(document).ready(function($){

    $('#cartClear').on('click', function() {
        $.ajax({
                type: 'POST',
                url: '/cart/clear'
            }
        ).done(function (data) {
            if (data.success) {
                $('.counterPrice').html(data.amount+' Р');
                $('#count-cart-products').html(data.count);
            }
        })
            .fail(function () {
                window.location.reload();
            });

        return false;
    });

    $('#ajaxAdd').on('click', function() {
        var form = $('#formPopup');
        $.ajax({
                type: form.attr('method'),
                url: form.attr('action'),
                data: form.serializeArray()
            }
        ).done(function (data) {
            if (data.success) {
                $('.counterPrice').html(data.amount+' Р');
                $('#count-cart-products').html(data.count);
                $('#addToCart').modal('hide');
                $.jGrowl(data.message, { position: 'bottom-right' });
            }
        })
            .fail(function () {
                window.location.reload();
            });

        return false;
    });

    $('#callForm').on('beforeSubmit', function () {
        var getCallForm = $(this);
        $.ajax({
                type: getCallForm.attr('method'),
                url: getCallForm.attr('action'),
                data: getCallForm.serializeArray()
            }
        ).done(function(data) {
            if(data.success) {
                getCallForm[0].reset();
                $('#getCall').modal('hide');
                $.jGrowl(data.message, { position: 'bottom-right' });
            }
        })
            .fail(function () {
                $.jGrowl('Не удалось подключиться к серверу. Приносим извинения за предоставленные неудобства, перезагрузите страничку и попробуйте ещё раз!', { header: 'Ошибка', position: 'bottom-right' });
            });

        return false;
    });

    $('[name="quantity"]').customQuantity();

    //console.log(sessionStorage.getItem('winmap'));

    $(window).scroll(function(){
        if (!sessionStorage.getItem('winmap')) {
            setTimeout(function() {
                //$('#mapModal').modal('show');
                //$('#mapModal').modal({backdrop: 'static', keyboard: false});
            }, 2000);
        }
    });

    $('#add-to-cart').on('click', function(e){
        e.preventDefault();
        var form = $('#addCart');
        $.ajax({
                type: 'POST',
                url: '/cart/review',
                data: form.serialize()
            }
        ).done(function (data) {
            if (data.success) {
                $('#modalCart').empty();
                $('#modalCart').html(data.html);
                //$('.counterPrice').html(data.amount+' Р');
            }
        })
            .fail(function () {
                /*window.location.reload();*/
            });
    });


    $('.modal-footer').on('click', '[type="radio"]', function(){
        if($(this).hasClass('del4')) {
            $('.zone-toggler').slideDown(400);
            $('.setZone').fadeOut(400);
        } else {
            $('.zone-toggler').slideUp(400);
            $('.setZone').fadeIn(400);
        }
    });


    $('.modal-backdrop').on('click', function(event){
        event.preventDefault();
    });

    $('.noactivelink').on('click', function(event){
        event.preventDefault();
    });


    $('#menu-item-95 > a').on('click', function(event){
        event.preventDefault();
    });

    $('.phoneTop a').on('click', function(){
        $('.responsive-menu-button').trigger('click');
    });


    $('input[name="CallForm[phone]"], [name="Order[phone]"]').mask('+7 (Z00) 000-0000', {
        translation: {
            'Z': {
                pattern: /[9]/
            }
        }
    });

    jQuery('.catalog-button .toogle-block').on('click', function (e) {
        var but = jQuery(this).parent();
        if(but.hasClass('tab-active')) {
            $('.catalog-button').removeClass('tab-active');
        } else {
            $('.catalog-button').removeClass('tab-active');
            but.addClass('tab-active');
        }
    });

    var timeModal = sessionStorage.getItem('timeModal');
    var localHours = new Date().getHours();
    var localMinutes = new Date().getMinutes();

    if (localHours < 11 || localHours > 22 || (localHours === 11 && localMinutes < 30 || localHours === 22 && localMinutes > 30)) {
        if (!timeModal || timeModal + 1000 * 60 * 60 < new Date().getTime()) {
            //$('#timeModal').modal();
            sessionStorage.setItem('timeModal', new Date().getTime())
        }
    }
});



// quantity_counter
(function( $ ){

    $.fn.customQuantity = function( options ) {

        $('body').on('click', '.customCounterBlock .plus', function () {
            var vl = $('[name="quantity"]').val();
            $(this).parent().find('.value').html( parseInt(vl, 10) + 1);
            $('[name="quantity"]').val(parseInt(vl, 10) + 1);
            //console.log($('[name="quantity"]').val());
        });

        $('body').on('click', '.customCounterBlock .minus', function () {
            var vl = $('[name="quantity"]').val();
            if(vl > 1) {
                $(this).parent().find('.value').html( parseInt(vl, 10) - 1);
                $('[name="quantity"]').val(parseInt(vl, 10) - 1);
            }
        });


    };
})(jQuery);