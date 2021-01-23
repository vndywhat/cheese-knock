<?php

use yii\helpers\Html;

?>
<header>
    <!-- Navigation -->
    <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button id="responsive-menu-button" class="responsive-menu-button responsive-menu-boring responsive-menu-accessible navbar-toggler" type="button" data-toggle="collapse">
                    <span class="responsive-menu-box">
                        <span class="responsive-menu-inner"></span>
                    </span>
                </button>
                <div id="responsive-menu-container" class="slide-left">
                    <div id="responsive-menu-wrapper"></div>
                </div>
                <a class="navbar-brand logo" href="/">
                    <?=Html::img('/images/logo.png', ['alt' => 'Cheese Knock'])?>
                </a>
            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="" id="navbarNav">
                <div class="menu-mainmenu-container">
                    <?= \frontend\components\MenusWidget::widget([
                        'items' => [
                            ['label' => 'Главная', 'url' => ['/site/index'], 'options' => [
                                'id' => 'menu-item-93',
                                'class' => 'menu-item menu-item-type-custom menu-item-object-custom menu-item-home menu-item-93 nav-item'
                            ]],
                            ['label' => 'Меню доставки', 'url' => ['/site/shop'],
                                'options' => [
                                    'id' => 'menu-item-95',
                                    'class' => 'menu-item menu-item-type-post_type menu-item-object-page menu-item-has-children menu-item-95 nav-item',
                                ],
                                'items' => [
                                    [
                                        'label' => 'Пицца', 'url' => ['/category/view', 'slug' => 'pizza'],
                                        'options' => [
                                            'id' => 'menu-item-97',
                                            'class' => 'menu-item menu-item-type-taxonomy menu-item-object-product_cat menu-item-97 nav-item',
                                        ],
                                    ],
                                    [
                                        'label' => 'Пасты', 'url' => ['/category/view', 'slug' => 'pasta'],
                                        'options' => [
                                            'id' => 'menu-item-1840',
                                            'class' => 'menu-item menu-item-type-taxonomy menu-item-object-product_cat menu-item-1840 nav-item',
                                        ],
                                    ],
                                    [
                                        'label' => 'Салаты', 'url' => ['/category/view', 'slug' => 'salad'],
                                        'options' => [
                                            'id' => 'menu-item-1841',
                                            'class' => 'menu-item menu-item-type-taxonomy menu-item-object-product_cat menu-item-1841 nav-item',
                                        ],
                                    ],
                                    [
                                        'label' => 'Комбо', 'url' => ['/category/view', 'slug' => 'combo'],
                                        'options' => [
                                            'id' => 'menu-item-2614',
                                            'class' => 'menu-item menu-item-type-taxonomy menu-item-object-product_cat menu-item-2614 nav-item',
                                        ],
                                    ],
                                    [
                                        'label' => 'Напитки', 'url' => ['/category/view', 'slug' => 'drink'],
                                        'options' => [
                                            'id' => 'menu-item-98',
                                            'class' => 'menu-item menu-item-type-taxonomy menu-item-object-product_cat menu-item-98 nav-item',
                                        ],
                                    ],
                                ]],
                            ['label' => 'Условия доставки', 'url' => ['/site/payment'], 'options' => [
                                'id' => 'menu-item-96',
                                'class' => 'menu-item menu-item-type-post_type menu-item-object-page menu-item-96 nav-item'
                            ]],
                            ['label' => 'Контакты', 'url' => ['/site/contacts'], 'options' => [
                                'id' => 'menu-item-94',
                                'class' => 'menu-item menu-item-type-post_type menu-item-object-page menu-item-94 nav-item'
                            ]],
                        ],
                        'options' => [
                            'class' => 'nav navbar-nav',
                            'id' => 'menu-mainmenu',
                        ]
                    ]);?>
                </div>
                <div class="cartTop">
                    <!--<span class="counterPrice"><?/*=$this->params['cart']['amount']*/?> Р</span>-->
                    <span class="counterPrice"><?= $this->params['cart-test']->getTotalCost()?> Р</span>
                    <a href="/cart" class="cartIco">
                        <!--<div id="count-cart-products"><?/*=count($this->params['cart']['products'])*/?></div>-->
                        <div id="count-cart-products"><?= $this->params['cart-test']->getTotalCount()?></div>
                    </a>
                </div>
                <div class="phoneTop">
                    <?=$this->params['config']['phone']?>
                    <a href="#" data-target="#getCall" data-toggle="modal" onclick="yaCounter47037111.reachGoal('openform'); return true;">заказать звонок</a>
                </div>
                <div class="timeTop">
                    Прием заказов
                    <?=$this->params['config']['orders']?><br>
                </div>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>
</header>