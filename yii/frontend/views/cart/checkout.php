<?php

/**
 * @var $this \yii\web\View
 * @var $cart array
 */

use frontend\assets\CartAsset;
use yii\helpers\Html;

CartAsset::register($this);

$this->registerJsFile('https://api-maps.yandex.ru/2.1/?lang=ru_RU&coordorder=longlat&apikey=51a2a0be-c4d4-4b04-8bd2-cd9069afca33', ['depends' => 'yii\web\YiiAsset']);
$this->registerJsFile('/js/yandex-maps-helper.js', ['depends' => 'yii\web\YiiAsset']);
$this->registerJsFile('/js/checkout.js', ['depends' => 'yii\web\YiiAsset']);

$this->title = 'Оформление заказа';
?>
<style>
    .woocommerce form .form-row .required {
        visibility: visible;
    }
</style>
<!-- Page Content -->
<div class="container catalog-page">
    <div class="row">
        <ul class="bcrumbs">
            <li><?=Html::a('Главная', ['/site/index'])?></li>
            <li><?=Html::a('Корзина', ['/cart/index'])?></li>
            <li>Оформление заказа</li>
        </ul>
        <div class="rulesLink">
            <?=Html::a('Условия оплаты и доставки', ['/site/payment'])?>
        </div>
    </div>
    <div class="row">
        <h1 class="text-center">Оформление заказа</h1>
        <div class="woocommerce">
            <div class="woocommerce-notices-wrapper">
                <?php if(count($model->errors) > 0): ?>
                <div class="woocommerce-error">
                    При заполнении формы были допущены ошибки:
                    <ul>
                        <?php
                        foreach ($model->errors as $errors) {
                            foreach ($errors as $error) {
                                echo '<li>'.$error.'</li>';
                            }
                        }
                        ?>
                    </ul>
                </div>
                <?php endif; ?>
            </div>
            <?= $this->render('_checkout', [
                'model' => $model,
                'cart' => $cart,
            ]) ?>
        </div>
    </div>
    <!-- /.row -->
</div>
<!-- /.container -->