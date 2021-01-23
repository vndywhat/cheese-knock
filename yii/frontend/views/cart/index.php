<?php


use frontend\assets\CartAsset;
use frontend\models\CartModel;
use yii\helpers\Html;

CartAsset::register($this);

$this->title = 'Корзина';

?>

<!-- Page Content -->
<div class="container catalog-page">
    <div class="row">
        <ul class="bcrumbs">
            <li><?=Html::a('Главная', ['/site/index'])?></li>
            <li><?=Html::a('Магазин', ['/category/all'])?></li>
            <li>Корзина</li>
        </ul>
        <div class="rulesLink">
            <?=Html::a('Условия оплаты и доставки', ['/site/payment'])?>
        </div>
    </div>
    <div class="row">
        <h1 class="text-center">Корзина</h1>
        <div class="woocommerce">
            <?=CartModel::buildCart()?>
        </div>
    </div>
    <!-- /.row -->
</div>
<!-- /.container -->
