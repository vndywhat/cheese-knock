<?php

/**
 * @var $cart \frontend\components\cart\Cart
 * @var $model \common\models\Order
 */

use frontend\models\CartModel;
use yii\bootstrap\ActiveForm;
use yii\helpers\Html;

$form = ActiveForm::begin([
    'id' => 'checkout-form',
    'enableClientValidation' => false,
    'options' => ['class' => 'checkout woocommerce-checkout'],
]);
$zone = !isset($model->delivery_zone) ? 3 : $model->delivery_zone;
?>
    <input type="hidden" name="Order[delivery_zone]" id="delivery_zone" value="<?=$zone?>">
    <input type="hidden" name="Order[amount]" id="cart_total" value="<?= $cart->getTotalCost() ?>">
    <div class="col1-set" id="customer_details">
        <div class="col-1">
            <div class="woocommerce-billing-fields">
                <h3>Детали оплаты</h3>
                <div class="woocommerce-billing-fields__field-wrapper">
                    <div class="delivery_block">
                        <div class="flex-row rel">
                            <div>
                                <input type="radio" checked="checked" name="Order[delivery_type]" value="0" id="delivery_1">
                                <label for="delivery_1">Доставка</label>
                            </div>
                            <div>
                                <input type="radio" name="Order[delivery_type]" value="1" id="delivery_2">
                                <label for="delivery_2">Самовывоз</label>
                            </div>
                        </div>
                    </div>
                    <p class="form-row form-row-first validate-required"
                       id="billing_first_name_field"
                       data-priority="10"
                    >
                        <label for="billing_first_name" class="">
                            Имя
                            <abbr class="required" title="обязательно">*</abbr>
                        </label>
                        <span class="woocommerce-input-wrapper">
                        <input type="text" class="input-text"
                               name="Order[name]"
                               id="billing_first_name"
                               required="required"
                               placeholder="Как к вам обращаться?"
                               value="<?=$model->name?>" autocomplete="given-name"
                        >
                    </span>
                    </p>
                    <p class="form-row form-row-wide address-field validate-required"
                       id="billing_address_1_field"
                       data-priority="50"
                    >
                        <label for="billing_address_1" class="">
                            Адрес
                            <abbr class="required" title="обязательно">*</abbr>
                        </label>
                        <span class="woocommerce-input-wrapper">
                        <input type="text" class="input-text"
                               name="Order[address]"
                               id="billing_address_1"
                               placeholder="Номер дома и название улицы"
                               value="<?=$model->address?>"
                               autocomplete="address-line1"
                               required="required"
                        >
                    </span>
                    </p>
                    <p class="form-row form-row-wide pick-zone-field validate-required hidden"
                       id="pick-zone-field"
                       data-priority="50"
                    >
                        <label for="pick-zone" class="">
                            Точка самовывоза
                            <abbr class="required" title="обязательно">*</abbr>
                        </label>
                        <span class="woocommerce-input-wrapper">
                            <select name="Order[pick_zone]" id="pick_zone">
                                <option selected value="1">ул. Лермонтова 4</option>
                                <option value="2">ул. Лукашевича 21Б</option>
                            </select>
                        </span>
                    </p>
                    <div class="bil_block">
                        <p class="form-row form-row-wide" id="billing_en_field"
                           data-priority="70"
                        >
                            <label for="billing_en" class="">
                                Подъезд
                                <span class="optional">(необязательно)</span>
                            </label>
                            <span class="woocommerce-input-wrapper">
                            <input type="text" class="input-text "
                                   name="Order[porch]"
                                   id="billing_en"
                                   placeholder="Подъезд" value="<?=$model->porch?>"
                            >
                        </span>
                        </p>
                        <p class="form-row form-row-wide"
                           id="billing_st_field"
                           data-priority="80"
                        >
                            <label for="billing_st" class="">
                                Этаж <span class="optional">(необязательно)</span>
                            </label>
                            <span class="woocommerce-input-wrapper">
                                <input type="text" class="input-text "
                                        name="Order[floor]"
                                        id="billing_st"
                                        placeholder="Этаж"
                                        value="<?=$model->floor?>"
                                >
                            </span>
                        </p>
                        <p class="form-row form-row-wide"
                           id="billing_ap_field"
                           data-priority="90"
                        >
                            <label for="billing_ap" class="">
                                Квартира <span class="optional">(необязательно)</span>
                            </label>
                            <span class="woocommerce-input-wrapper">
                                <input type="text" class="input-text "
                                       name="Order[flat]"
                                       id="billing_ap"
                                       placeholder="Квартира"
                                       value="<?=$model->flat?>"
                                >
                            </span>
                        </p>
                    </div>
                    <div class="time_block">
                        <p class="form-row form-row-wide validate-required validate-phone"
                           id="billing_phone_field"
                           data-priority="130"
                        >
                            <label for="billing_phone" class="">
                                Телефон
                                <abbr class="required" title="обязательно">*</abbr>
                            </label>
                            <span class="woocommerce-input-wrapper">
                                <input type="tel" class="input-text "
                                       required="required"
                                       name="Order[phone]"
                                       id="billing_phone"
                                       placeholder="" value="<?=$model->phone?>"
                                       autocomplete="tel"
                                       maxlength="17"
                                >
                            </span>
                        </p>
                        <p class="form-row form-row-wide"
                           id="billing_time_field"
                           data-priority="160"
                        >
                            <label for="billing_time" class="">
                                Доставка по времени
                            </label>
                            <span class="woocommerce-input-wrapper">
                                <input type="text" class="input-text "
                                       name="Order[delivery_time]"
                                       id="billing_time"
                                       placeholder="Доставить к 18:00 *"
                                       value="<?=$model->delivery_time?>"
                                >
                            </span>
                        </p>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-2">
            <div class="woocommerce-additional-fields">
                <div class="woocommerce-additional-fields__field-wrapper">
                    <p class="form-row notes" id="order_comments_field" data-priority="10">
                        <label for="order_comments" class="">Примечание к заказу&nbsp;
                            <span class="optional">(необязательно)</span>
                        </label>
                        <span class="woocommerce-input-wrapper">
                            <textarea name="Order[comment]"
                                      class="input-text "
                                      id="order_comments"
                                      placeholder="Примечания к вашему заказу, например, особые пожелания отделу доставки."
                                      rows="2"
                                      cols="5"
                            ><?=$model->comment?></textarea>
                        </span>
                    </p>
                </div>
            </div>
        </div>
    </div>
    <h2>Зоны бесплатной доставки</h2>
    <div id="map-ya"></div>
    <div class="modal1-footer">
        <div class="del-row">
            <label for="del1">
                <div class="zone3"></div>
                <span>
                    <!--Стоимость доставки 100 Р, при заказе от 600 Р доставка бесплатно-->
                    Бесплатная доставка при заказе от 600 Р
                </span>
            </label>
        </div>
        <div class="del-row">
            <label for="del2">
                <div class="zone1"></div>
                <span>
                    <!--Стоимость доставки 200 Р, при заказе от 800 Р доставка бесплатно-->
                    Бесплатная доставка при заказе от 800 Р
                </span>
            </label>
        </div>
        <div class="del-row">
            <label for="del3">
                <div class="zone2"></div>
                <span>
                    <!--Стоимость доставки 300 Р, при заказе от 1000 Р доставка бесплатно-->
                    Бесплатная доставка при заказе от 1000 Р
                </span>
            </label>
        </div>
        <div class="del-row">
            Если сумма Вашего заказа меньше минимальной - уточняйте стоимость доставки у оператора
        </div>
        <div class="wtf-text maptitle">
            Вы можете
            <a href="/category/pizza"
               id="to-menu">Перейти в меню</a> или оформить заказ с
            платной доставкой
        </div>
    </div>
    <h3 id="order_review_heading">Ваш заказ</h3>
    <div id="order_review" class="woocommerce-checkout-review-order">
        <?= CartModel::getOrderReview()?>
        <div id="payment" class="woocommerce-checkout-payment">
            <ul class="wc_payment_methods payment_methods methods">
                <li class="wc_payment_method payment_method_cod">
                    <input id="payment_method_cod" type="radio" class="input-radio"
                           name="Order[payment_type]"
                           value="0" checked="checked" data-order_button_text=""
                    >
                    <label for="payment_method_cod">
                        Наличный расчет
                    </label>
                    <div id="method_cod" class="payment_box payment_method_cod">
                        <p>Оплата наличными курьеру</p>
                    </div>
                </li>
                <li class="wc_payment_method payment_method_other_payment">
                    <input id="payment_method_other_payment" type="radio" class="input-radio"
                           name="Order[payment_type]" value="1" data-order_button_text=""
                    >
                    <label for="payment_method_other_payment">
                        Безналичный расчет
                    </label>
                    <div id="method_other_payment" class="payment_box payment_method_other_payment" style="display:none;">
                        <fieldset>
                            <p class="form-row form-row-wide woocommerce-validated">
                                <label for="other_payment-admin-note">
                                    Оплата пластиковой картой при доставке
                                    <span class="required">*</span>
                                </label>
                            </p>
                            <div class="clear"></div>
                        </fieldset>
                    </div>
                </li>
            </ul>
            <div class="form-row place-order">
                <noscript>
                    Since your browser does not support JavaScript, or it is disabled, please ensure you
                    click the <em>Update Totals</em> button before placing your order. You may be charged
                    more than the amount stated above if you fail to do so. <br/>
                    <input type="submit"
                           class="button alt"
                           name="woocommerce_checkout_update_totals"
                           value="Обновить итог"
                    >
                </noscript>
                <input type="submit" class="button alt"
                       onclick="yaCounter47037111.reachGoal('confirmorder'); return true;"
                       name="woocommerce_checkout_place_order" id="place_order" value="Подтвердить заказ"
                       data-value="Подтвердить заказ">
            </div>
        </div>
    </div>
<?php ActiveForm::end(); ?>