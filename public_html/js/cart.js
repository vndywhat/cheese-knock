function removeItem(id)
{
    $.ajax({
            type: 'POST',
            url: '/cart/remove',
            data: {id: id}
        }
    ).done(function (data) {
        if (data.success) {
            $('#cart-item-'+data.id).remove();
            $('.counterPrice').html(data.amount+' Р');
            $('#count-cart-products').html(data.count);
            $('.woocommerce').empty();
            $('.woocommerce').html(data.html);
            $('.woocommerce-notices-wrapper').html(data.message);
        }
    })
    .fail(function () {
        //window.location.reload();
    });

    return false;
}

function removeIngredient(key, id)
{
    $.ajax({
            type: 'POST',
            url: '/cart/remove-ingredient',
            data: {key: key, id: id}
        }
    ).done(function (data) {
        if (data.success) {
            $('#k'+data.key+'_i'+data.id).remove();
            $('.counterPrice').html(data.amount+' Р');
            $('#count-cart-products').html(data.count);
            $('.woocommerce').empty();
            $('.woocommerce').html(data.html);
        }
    })
        .fail(function () {
            window.location.reload();
        });

    return false;
}

function changeItem(id, mode) {
    $.ajax({
            type: 'POST',
            url: '/cart/change-quantity',
            data: {id: id, mode: mode}
        }
    ).done(function (data) {
        if (data.success) {
            $('.counterPrice').html(data.amount+' Р');
            $('#count-cart-products').html(data.count);
            $('.woocommerce').empty();
            $('.woocommerce').html(data.html);
        }
    })
        .fail(function () {
            window.location.reload();
        });

    return false;
}

function restoreItem(id)
{
    $.ajax({
            type: 'POST',
            url: '/cart/restore-item',
            data: {id: id}
        }
    ).done(function (data) {
        if (data.success) {
            $('.counterPrice').html(data.amount+' Р');
            $('#count-cart-products').html(data.count);
            $('.woocommerce').empty();
            $('.woocommerce').html(data.html);
        }
    })
        .fail(function () {
            window.location.reload();
        });

    return false;
}