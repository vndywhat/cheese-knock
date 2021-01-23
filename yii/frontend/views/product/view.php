<?php

/**
 * @var $this \yii\web\View
 * @var $product \common\models\Product
 * @var $additional \frontend\models\CartModel
 */

use common\models\Ingredient;
use yii\helpers\Html;
use yii\helpers\Url;

$this->title = $product->title;

$checkJs = <<<JS
    $('.oil-row input').on('change', function () {
        $('.oil-row input').prop('checked', false);
        $(this).prop('checked', true);
    });
JS;

$this->registerJs($checkJs);

$this->registerJsFile('https://vk.com/js/api/openapi.js?162', ['position' => $this::POS_HEAD]);

 ?>
<script type="text/javascript">
    VK.init({apiId: 7187502, onlyWidgets: true});
</script>
<!-- Page Content -->
<div class="container catalog-page">
    <div class="row">
        <ul class="bcrumbs">
            <li>
                <?=Html::a('Главная', ['/site/index'])?>
            </li>
            <li>
                <?= Html::a($product->category->title, ['/category/view', 'slug' => $product->category->slug])?>
            </li>
            <li><?= $product->title ?></li>
        </ul>
        <div class="rulesLink">
            <?=Html::a('Условия оплаты и доставки', ['/site/payment'])?>
        </div>
    </div>
</div>

<div class="container product-page">
    <?= Html::a('Вернуться в меню', ['/category/view', 'slug' => $product->category->slug], ['class' => 'back-to-catalog'])?>
    <div id="product-<?= $product->id ?>"
         class="post-<?= $product->id ?> product type-product status-publish has-post-thumbnail product_cat-pizza first instock shipping-taxable purchasable product-type-simple">
        <div class="row">
            <div class="col-sm-6">
                <a href="<?= Url::to(['/product/view', 'slug' => $product->slug])?>">
                    <img class="product-img"
                         src="<?= $product->getImage() ?>">
                </a>
            </div>
            <div class="col-sm-6">
                <div class="summary entry-summary">
                    <div class="col-sm-12" style="padding-left: 0;">
                        <div class="col-sm-9" style="padding-left: 0;">
                            <h1 class="product_title entry-title float-left">
                                <?= $product->title ?>
                            </h1>
                        </div>
                        <div class="col-sm-3">
                            <div id="vk_like"></div>
                            <script type="text/javascript">
                                VK.Widgets.Like("vk_like", {type: "mini"});
                            </script>
                        </div>
                    </div>
                    <?php if($product->description): ?>
                    <div class="woocommerce-product-details__short-description">
                        <p><?=$product->description?></p>
                    </div>
                    <?php endif; ?>
                    <div class="product_meta">
                    </div>
                    <?php if($product->size || $product->weight): ?>
                    <div class="pizza_size">
                        <?=$product->getSizeWeight()?>
                    </div>
                    <?php endif; ?>
                </div><!-- .summary -->
                <?php if($product->composition): ?>
                    <div>
                        <div class="ing">Состав:<span>*</span></div>
                        <?= $product->composition ?>
                    </div>
                <?php endif; ?>
                <form action="/cart/add" method="post" id="addCart">
                    <?= Html::hiddenInput(Yii::$app->getRequest()->csrfParam, Yii::$app->getRequest()->getCsrfToken(), []) ?>
                    <?= Html::hiddenInput('product_id', $product->id, []) ?>
                    <?php if($product->have_related): ?>
                        <?= Ingredient::generateHtml(); ?>
                    <?php endif; ?>
                    <div class="price-single-block">
                        <div class="prod-price"><?= $product->price ?> Руб</div>
                        <?php if(!$product->is_drink): ?>
                        <div class="delivery-time">Время доставки ≈ 90 мин</div>
                        <?php endif; ?>
                    </div>
                    <div class="countLabel">Кол-во:</div>
                    <div class="quantity">
                        <input type="number" id="quantity_5d8f9505d945d" class="input-text qty text" step="1"
                               min="1" max="" name="quantity" value="1" title="Кол-во" size="4" pattern="[0-9]*"
                               inputmode="numeric" style="display: none;"
                        >
                        <div class="customCounterBlock">
                            <div class="minus">-</div>
                            <div class="value">1</div>
                            <div class="plus">+</div>
                        </div>
                    </div>
                    шт.

                    <button type="submit" value="<?=$product->id?>"
                            id="add-to-cart"
                            class="single_add_to_cart_button button alt"
                            data-target="#addToCart"
                            data-toggle="modal">
                        В корзину
                    </button>
                    <?php if($product->composition): ?>
                    <div class="additional-text"><span>*</span> При наличии у вас аллергии на отдельный вид
                        ингредиентов, пожалуйста подробно изучите состав блюда.
                    </div>
                    <?php endif; ?>
                </form>
            </div>
        </div>
        <?php if(!$product->is_drink): ?>
        <div class="drinkBlock">
            <h2>Не забудьте про напиток</h2>
            <div class="row">
                <?php
                $drinkHtml = '';
                foreach ($product->getDrinks() as $drink)
                {
                    $drinkHtml .= '<div class="col-sm-3">';
                    $drinkHtml .= '<a href="'. Url::to(['/product/view', 'slug' => $drink->slug]).'">';
                    $drinkHtml .= Html::img($drink->getThumb());
                    $drinkHtml .= '</a>';
                    $drinkHtml .= '<a href="'. Url::to(['/product/view', 'slug' => $drink->slug]).'" class="pizzaName">';
                    $drinkHtml .= $drink->title;
                    $drinkHtml .= '</a>';
                    $drinkHtml .= '<div class="pizzaPrice">'.$drink->price.' Руб</div>';
                    $drinkHtml .= Html::a('Заказать', ['/product/view', 'slug' => $drink->slug], ['class' => 'getOrder']);
                    $drinkHtml .= '</div>';
                }
                echo $drinkHtml;
                ?>
            </div>
        </div>
        <?php else: ?>
            <div class="drinkBlock">
                <h2>Не забудьте про пиццу</h2>
                <div class="row">
                    <?php
                    $pizzaHtml = '';
                    foreach ($product->getPizzas() as $pizza)
                    {
                        $pizzaHtml .= '<div class="col-sm-3">';
                        $pizzaHtml .= '<a href="'. Url::to(['/product/view', 'slug' => $pizza->slug]).'">';
                        $pizzaHtml .= Html::img($pizza->getThumb());
                        $pizzaHtml .= '</a>';
                        $pizzaHtml .= '<a href="'. Url::to(['/product/view', 'slug' => $pizza->slug]).'" class="pizzaName">';
                        $pizzaHtml .= $pizza->title;
                        $pizzaHtml .= '</a>';
                        $pizzaHtml .= '<div class="pizzaPrice">'.$pizza->price.' Руб</div>';
                        $pizzaHtml .= Html::a('Заказать', ['/product/view', 'slug' => $pizza->slug], ['class' => 'getOrder']);
                        $pizzaHtml .= '</div>';
                    }
                    echo $pizzaHtml;
                    ?>
                </div>
            </div>
        <?php endif; ?>
        <div class="drinkBlock">
            <h2>Мы будем рады вашим комментариям ;)</h2>
            <div class="row">
                <div class="col-sm-12">
                    <div class="col-sm-6"></div>
                    <div class="col-sm-6">
                        <div id="vk_comments"></div>
                        <script type="text/javascript">
                            VK.Widgets.Comments("vk_comments", {limit: 10, attach: "photo,video,audio,link"});
                        </script>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="addToCart" tabindex="-1" role="dialog" aria-labelledby="addToCartLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
                <h4 class="modal-title" id="myModalLabel">Добавить в корзину: <?= $product->title ?></h4>
            </div>
            <div class="modal-body" style="padding: 15px;">
                <div class="container-fluid" id="modalCart"></div>
            </div>
            <div class="modal-footer">
                <div class="col-sm-12">
                    <span class="pull-right">
                        <button type="submit" value="<?=$product->id?>"
                                id="ajaxAdd"
                                class="single_add_to_cart_button button alt"
                                onclick="yaCounter47037111.reachGoal('addcart'); return true;">
                        В корзину
                    </button>
                    </span>
                </div>
            </div>
        </div>
    </div>
</div>