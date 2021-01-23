<?php

/**
 * @var $category \common\models\Category
 * @var $products \common\models\Product
 * @var $product \common\models\Product
 */

$this->title = $category->title;

use yii\helpers\Html;
use yii\helpers\Url; ?>

<!-- Page Content -->
<div class="container catalog-page">
    <div class="row">
        <ul class="bcrumbs">
            <li>
                <?=Html::a('Главная', ['/site/index'])?>
            </li>
            <li>
                <?=Html::a('Магазин', ['/category/all'])?>
            </li>
            <li><?=$category->title?></li>
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
        <h1 class="text-center woocommerce-products-header__title page-title"><?=$category->title?></h1>
    </header>
    <div class="row products">
        <?php if(count($products) > 0){ ?>
            <?php
            $productHtml = '';
            foreach ($products as $product)
            {
                $productHtml .= '<div class="col-sm-4 pizzaUnit">';
                    $productHtml .= '<a href="'. Url::to(['/product/view', 'slug' => $product->slug]).'" class="imgLink">';
                        $productHtml .= '<img src="'.$product->getThumb().'">';
                        $productHtml .= '<div class="descr text-center">';
                            $productHtml .= (!empty($product->composition)) ? '<div class="descTitle">Состав:</div>' : '';
                            $productHtml .= (!empty($product->composition)) ? Html::decode($product->composition) : '';
                        $productHtml .= '</div>';
                    $productHtml .= '</a>';
                    $productHtml .= '<a href="'. Url::to(['/product/view', 'slug' => $product->slug]) .'" class="pizzaName">';
                        $productHtml .= $product->title.'&nbsp;';
                        if($product->size || $product->weight)
                        {
                            $productHtml .= '<span>('.$product->getSizeWeight().')</span>';
                        }
                    $productHtml .= '</a>';
                    $productHtml .= '<div class="pizzaPrice">'.$product->price.' руб.</div>';
                    $productHtml .= '<a class="getOrder" href="'. Url::to(['/product/view', 'slug' => $product->slug]) .'">Заказать</a>';
                $productHtml .= '</div>';
            }
            echo $productHtml;
            ?>
        <?php } else {
            echo '<div class="col-sm-4 pizzaUnit"><div class="text-center">Здесь совсем ничего нет...</div></div>';
        } ?>
    </div>
</div>