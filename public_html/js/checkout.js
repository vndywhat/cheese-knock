
    var oldZone = $('#delivery_zone').val();

    $('#billing_delivery').val('Доставка');

    $('[name="Order[payment_type]"]').on('change', function(){
        if($(this).val() === '0') {
            $('div#method_other_payment').slideUp();
            $('div#method_cod').slideDown();
        } else {
            $('div#method_cod').slideUp();
            $('div#method_other_payment').slideDown();
        }
    });



    var cart_total = $('#cart_total').val();
    ymaps.ready(init);

    function init()
    {
        var myMap = new ymaps.Map('map-ya', {
            //73.368212%2C54.989342
                center: [73.3728767325486, 54.97472481556362],
                zoom: 11,
                controls: ['geolocationControl']
            }),
            suugestView = new ymaps.SuggestView($('#billing_address_1')[0], {
                boundedBy: [[72, 54], [75, 56]]
            });

        var deliveryZones = ymaps.geoQuery(ya_maps_datas).addToMap(myMap);

        var marker = new ymaps.Placemark([0, 0]);
        var address = $('#billing_address_1').val();
        myMap.geoObjects.add(marker);

        if(address.length > 0) {
            ymaps.geocode(address)
                .then(function (res) {
                    marker.geometry.setCoordinates(res.geoObjects.get(0).geometry.getCoordinates());
                    var coords = res.geoObjects.get(0).geometry.getCoordinates(),
                        // Находим полигон, в который входят переданные координаты.
                        polygon = deliveryZones.searchContaining(coords).get(0);
                    if (polygon) {
                        $('#ship_type').val(polygon.options.get('deliv'));
                        checkPolygon(polygon.options.get('deliv'));
                    } else {
                        $('#ship_type').val(3);
                        checkPolygon(3);
                    }
                });
        }


        suugestView.events.add('select', function (e) {
            ymaps.geocode(e.get('item').value)
                .then(function (res) {
                    marker.geometry.setCoordinates(res.geoObjects.get(0).geometry.getCoordinates());
                    var coords = res.geoObjects.get(0).geometry.getCoordinates(),
                        // Находим полигон, в который входят переданные координаты.
                        polygon = deliveryZones.searchContaining(coords).get(0);
                    if (polygon) {
                        $('#ship_type').val(polygon.options.get('deliv'));
                        checkPolygon(polygon.options.get('deliv'));
                    } else {
                        $('#ship_type').val(3);
                        checkPolygon(3);
                    }
                });
        });

        myMap.events.add('click', function (e) {
            var coords = e.get('coords');
            marker.geometry.setCoordinates(coords);
            console.log(coords);
            ymaps.geocode(coords, {
                /**
                 * Опции запроса
                 * @see https://api.yandex.ru/maps/doc/jsapi/2.1/ref/reference/geocode.xml
                 */
                // Ищем только станции метро.
                kind: 'house',
                // Запрашиваем не более 20 результатов.
                results: 20
            }).then(function (res) {
                $('#billing_address_1').val(res.geoObjects.get(0).properties.get('name'));
            });
        });
    }

    function checkPolygon(del) {
        setDeliveryZone(del);
        if (!$("div").is(".deliv-text")) {
            $('#billing_address_2_field').after('<div class="deliv-text">' +
                '<div class="free-del">Бесплатная доставка</div>' +
                '<div class="not-free-del">Стоимость доставки составит 300р.</div>' +
                '<div class="call-free-del">Доставка платная. Мы рассчитаем и сообщим стоимость доставки по телефону</div>' +
                '</div>');
        }
        $('.deliv-text div').hide();
        $('tr.shipping td').text('Доставка по Омску');
        var del_price = 0,
            text;
        $('.wtf-text').show();
        setDeliveryZone(del);
        if (del == 3) {
            $('.deliv-text .call-free-del').show();
        }
        if (cart_total > 1000 && (del == 0 || del == 1 || del == 2)) {
            setDeliveryZone(3);
            $('.deliv-text .free-del').show();
            $('.wtf-text').hide();
        } else if (cart_total > 800 && (del == 0 || del == 1)) {
            setDeliveryZone(3);
            $('.deliv-text .free-del').show();
            $('.wtf-text').hide();
        } else if (cart_total > 600 && (del == 0)) {
            setDeliveryZone(3);
            $('.deliv-text .free-del').show();
            $('.wtf-text').hide();
        } else if (del != 3) {
            text = 'Стоимость доставки составит ' + getDeliveryPrice() + ' р.'
            $('.deliv-text .not-free-del').text(text);
            $('tr.shipping td').text('Доставка по Омску ' + getDeliveryPrice() + 'р');
            $('.deliv-text .not-free-del').show();
        }
        var tota = parseFloat(cart_total) + getDeliveryPrice();
        $('tr.order-total .woocommerce-Price-amount').text(tota.toFixed(2) + ' p');

    }

    function setDeliveryZone(zone) {
        $('#delivery_zone').val(zone);
    }

    function getDeliveryPrice() {
        var del_price;
        var zone = parseInt($('#delivery_zone').val(), 10);
        if (zone == 0) {
            del_price = 100;
        }
        if (zone == 1) {
            del_price = 200;
        }
        if (zone == 2) {
            del_price = 300;
        }
        if (zone == 3) {
            del_price = 0;
        }
        return del_price;
    }

    $('[name="Order[delivery_type]"]').on('change', function(){
        //console.log($(this).val());
        $('#billing_delivery').val($(this).val());
        if($(this).val() === '1') {
            $('#billing_address_1').removeAttr('required');
            $('#pick_zone').attr('required', 'required');
            checkPolygon(3);
            $('#billing_address_1').data('val',$('#billing_address_1').val() );
            $('#billing_address_1').val('-');
            $('#billing_address_1_field, .bil_block').slideUp();
            $('#pick-zone-field').removeClass('hidden');
        }  else {
            $('#billing_address_1').attr('required', 'required');
            $('#pick_zone').removeAttr('required');
            //$('#billing_address_1').data('val',$('#billing_address_1').val() );
            $('#billing_address_1').val($('#billing_address_1').data('val'));
            $('#billing_address_1_field, .bil_block').slideDown();
            $('#pick-zone-field').addClass('hidden');
        }
    });