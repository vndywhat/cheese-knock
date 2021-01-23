<?php

/**
 * @var $categories \common\models\Category
 * @var $category \common\models\Category
 */

use yii\helpers\Html;
use yii\helpers\Url;

$this->title = 'Магазин';

?>

<!-- Page Content -->
<div class="container catalog-page">
    <div class="row">
        <ul class="bcrumbs">
            <li><?=Html::a('Главная', ['/site/index'])?></li>
            <li>Магазин</li>
        </ul>
        <div class="rulesLink">
            <?=Html::a('Условия оплаты и доставки', ['/site/payment'])?>
        </div>
    </div>
    <!-- /.row -->
    <div class="row">

    </div>
</div>
<!-- /.container -->
<div class="catalog-button pizza">
    <a href="/category/pizza">
        Пицца
    </a>
    <div class="toogle-block"></div>
</div>
<div class="catalog-button drink">
    <a href="/category/drink">
        Напитки
    </a>
    <div class="toogle-block"></div>
</div>

<div class="container catalog-page">
    <header class="woocommerce-products-header">
        <h1 class="text-center woocommerce-products-header__title page-title">Магазин</h1>
    </header>
    <div class="row products">
        <?php
        $categoryHtml = '';

        if(count($categories) > 0) {

            foreach ($categories as $category)
            {
                $description = ($category->description) ? '<div class="descTitle">Описание:</div>'.$category->description : '';
                $categoryHtml .= '<div class="col-sm-4 pizzaUnit">';
                $categoryHtml .= '<a href="'.Url::to(['/category/view', 'slug' => $category->slug]).'" class="imgLink">';
                $categoryHtml .= Html::img($category->getThumb());
                $categoryHtml .= '<div class="descr text-center">';
                $categoryHtml .= $description;
                $categoryHtml .= '</div>';
                $categoryHtml .= '</a>';
                $categoryHtml .= '<a href="'.Url::to(['/category/view', 'slug' => $category->slug]).'" class="pizzaName">';
                $categoryHtml .= $category->title . ' <span>('. count($category->products) .')</span>';
                $categoryHtml .= '</a>';
                $categoryHtml .= '<a class="getOrder" href="'.Url::to(['/category/view', 'slug' => $category->slug]).'">Перейти</a>';
                $categoryHtml .= '</div>';
            }
        } else {
            $categoryHtml .= '<div class="col-sm-4 pizzaUnit">';
            $categoryHtml .= '<div class="text-center">';
            $categoryHtml .= 'На данный момент ассортимент полностью отсутствует...';
            $categoryHtml .= '</div>';
            $categoryHtml .= '</div>';

        }
        echo $categoryHtml;
        ?>
    </div>
</div>