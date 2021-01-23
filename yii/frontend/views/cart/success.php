<?php

/**
 * @var $this \yii\web\View
 * @var $model \common\models\Order
 */

use yii\helpers\Html;
use yii\helpers\Url;

$this->title = 'Заказ принят';

?>
<div class="container catalog-page">
    <div class="row">
        <ul class="bcrumbs">
            <li><?=Html::a('Главная', ['/site/index'])?></li>
            <li><?=Html::a('Магазин', ['/category/all'])?></li>
            <li>Оформление заказа</li>
        </ul>
        <div class="rulesLink">
            <?=Html::a('Условия оплаты и доставки', ['/site/payment'])?>
        </div>
    </div>
    <div class="row">
        <h1 class="text-center">Заказ принят</h1>
        <div class="woocommerce">
            <div class="woocommerce-order">
                <p class="woocommerce-notice woocommerce-notice--success woocommerce-thankyou-order-received">Спасибо. Ваш заказ был принят.</p>
                <ul class="woocommerce-order-overview woocommerce-thankyou-order-details order_details">
                    <li class="woocommerce-order-overview__order order">
                        Номер заказа: <strong><?=$model->id?></strong>
                    </li>
                    <li class="woocommerce-order-overview__date date">
                        Дата: <strong><?=date('d.m.Y H:i', $model->created_at)?></strong>
                    </li>
                    <li class="woocommerce-order-overview__total total">
                        Всего: <strong><span class="woocommerce-Price-amount amount"><?=$model->amount + $model->calculateDelivery()?><span class="woocommerce-Price-currencySymbol">₽</span></span></strong>
                    </li>
                    <li class="woocommerce-order-overview__payment-method method">
                        Метод оплаты: <strong><?=($model->payment_type === 0) ? 'Наличными' : 'Безналичный'?></strong>
                    </li>
                </ul>
                <section class="woocommerce-order-details">
                    <h2 class="woocommerce-order-details__title">Информация о заказе</h2>
                    <table class="woocommerce-table woocommerce-table--order-details shop_table order_details">
                        <thead>
                        <tr>
                            <th class="woocommerce-table__product-name product-name">Товар</th>
                            <th class="woocommerce-table__product-table product-total">Итого</th>
                        </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($model->items as $item):?>
                                <?php foreach ($item->products as $product):?>
                                    <?php if($product->id === $item->product_id): ?>
                                        <?php $priceIngredients = 0; ?>
                                        <tr class="woocommerce-table__line-item order_item">
                                            <td class="woocommerce-table__product-name product-name">
                                                <a href="<?= Url::to(['/product/view', 'slug' => $product->slug])?>"><?=$product->title?></a> <strong class="product-quantity">× <?=$item->count?></strong>
                                                <?php if(count($item->ingredients) > 0): ?>
                                                <ul class="wc-item-meta">
                                                    <?php foreach ($item->ingredients as $ingredient): ?>
                                                    <?php
                                                    $priceIngredients = $priceIngredients + $ingredient->price;
                                                    ?>
                                                    <li>
                                                        <span class="wc-item-meta-label"><?=$ingredient->title?> <?=$ingredient->weight?> +<?=$ingredient->price?>Р</span>
                                                    </li>
                                                    <?php endforeach; ?>
                                                </ul>
                                                <?php endif; ?>
                                            </td>
                                            <td class="woocommerce-table__product-total product-total">
                                            <span class="woocommerce-Price-amount amount">
                                                <?=($item->price + $priceIngredients)*$item->count?>
                                                <span class="woocommerce-Price-currencySymbol">₽</span>
                                            </span>
                                            </td>
                                        </tr>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                            <?php endforeach; ?>
                        </tbody>
                        <tfoot>
                        <tr>
                            <th scope="row">Подытог:</th>
                            <td>
                                <span class="woocommerce-Price-amount amount"><?=$model->amount?>
                                    <span class="woocommerce-Price-currencySymbol">₽</span>
                                </span>
                            </td>
                        </tr>
                        <tr>
                            <th scope="row">Доставка:</th>
                            <td>
                                <?php if($model->delivery_type === 0): ?>
                                    <?php if($model->calculateDelivery() === 0): ?>
                                        <span class="woocommerce-Price-amount amount">Бесплатно</span>&nbsp;
                                    <?php else: ?>
                                        <span class="woocommerce-Price-amount amount"><?=$model->calculateDelivery()?>
                                            <span class="woocommerce-Price-currencySymbol">₽</span>
                                        </span>
                                        <small class="shipped_via">(Доставка по Омску)</small>
                                    <?php endif; ?>
                                <?php else: ?>
                                    <span class="woocommerce-Price-amount amount">Самовывоз</span>
                                    <small class="shipped_via"><?=$model->pickZone()?></small>
                                <?php endif; ?>
                            </td>
                        </tr>
                        <tr>
                            <th scope="row">Метод оплаты:</th>
                            <td><?=($model->payment_type === 0) ? 'Наличными' : 'Безналичный';?></td>
                        </tr>
                        <tr>
                            <th scope="row">Всего:</th>
                            <td>
                                <span class="woocommerce-Price-amount amount"><?=$model->amount + $model->calculateDelivery()?>
                                    <span class="woocommerce-Price-currencySymbol">₽</span>
                                </span>
                            </td>
                        </tr>
                        <?php if($model->comment): ?>
                        <tr>
                            <th>Примечание:</th>
                            <td><?=$model->comment?></td>
                        </tr>
                        <?php endif; ?>
                        </tfoot>
                    </table>
                    <?php if($model->delivery_time): ?>
                    <table class="woocommerce-table woocommerce-table--custom-fields shop_table custom-fields">
                        <tbody>
                            <tr>
                                <th>Доставка по времени:</th>
                                <td><?=$model->delivery_time?></td>
                            </tr>
                        </tbody>
                    </table>
                    <?php endif; ?>
                </section>
            </div>
        </div>
    </div>
    <!-- /.row -->
</div>