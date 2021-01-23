<?php

/* @var $this \yii\web\View */
/* @var $content string */

use common\widgets\Alert;
use frontend\assets\AppAsset;
use yii\bootstrap\ActiveForm;
use yii\helpers\Html;

AppAsset::register($this);

$callFormJs = <<<JS
$('#callForm').on('beforeSubmit', function () {
        var getCallForm = $(this);
        $.ajax({
                type: getCallForm.attr('method'),
                url: getCallForm.attr('action'),
                data: getCallForm.serializeArray()
            }
        ).done(function(data) {
                if(data.success) {
                    getCallForm[0].reset();
                    $('#getCall').modal('hide');
                    $.jGrowl(data.message, { position: 'bottom-right' });
                }
            })
            .fail(function () {
                $.jGrowl('Не удалось подключиться к серверу. Приносим извинения за предоставленные неудобства, перезагрузите страничку и попробуйте ещё раз!', { header: 'Ошибка', position: 'bottom-right' });
            })

        return false;
    });
   
JS;

$this->registerJs($callFormJs);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php $this->registerCsrfMetaTags() ?>

    <meta name="author" content="">

    <link rel="icon" href="/favicon.png" sizes="32x32">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

    <title><?= Html::encode($this->title) ?> — <?=$this->params['addTitle']?></title>
    <script type="text/javascript">!function(){var t=document.createElement("script");t.type="text/javascript",t.async=!0,t.src="https://vk.com/js/api/openapi.js?161",t.onload=function(){VK.Retargeting.Init("VK-RTRG-378317-6Z19P"),VK.Retargeting.Hit()},document.head.appendChild(t)}();</script>
    <noscript><img src="https://vk.com/rtrg?p=VK-RTRG-378317-6Z19P" style="position:fixed; left:-999px;" alt=""/></noscript>
    <?php $this->head() ?>
</head>

<body <?php if(isset($this->params['class'])): ?>class="homepage"<?php endif; ?>>
<?php $this->beginBody() ?>
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
                    <a id="cartClear" href="#" class="btn btn-default pull-right" style="
                        margin: 32px 0 15px 15px;
                        padding: 2px 5px;
                    ">×</a>
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

<div id="wrapper">
    <?= Alert::widget() ?>
    <?= $content ?>
</div>

<footer>
    <div class="container">
        <div class="col-sm-2">
            <a href="/" class="logo">
                <?=Html::img('/images/logo.png', ['alt' => 'Cheese Knock'])?>
            </a>
        </div>
        <div class="col-sm-5 col-sm-offset-1">
            <ul class="footMenu">
                <li><a href="/">Главная</a></li>
                <li><a href="/#about">О нас</a></li>
                <li><a href="/category/pizza">Заказать онлайн</a></li>
            </ul>
            <ul class="footMenu">
                <li><a href="/payment">Оплата и доставка</a></li>
                <li><a href="/politic">Политика конфиденциальности</a></li>
                <li><a href="/contacts">Контакты</a></li>
            </ul>
        </div>
        <div class="col-sm-3">
            <div class="ftel"><?=$this->params['config']['phone']?></div>
            <div class="fadr"><?=$this->params['config']['main_office']?></div>
            <div class="ftime">
                <?=$this->params['config']['time_work']?><br>
            </div>
        </div>
        <div class="col-sm-1 ecards">
            <?=Html::img('/images/visa_ico.png', ['alt' => 'Visa'])?>
            <?=Html::img('/images/mastercard_ico.png', ['alt' => 'Mastercard'])?>
        </div>
    </div>
    <div class="modal fade" id="getCall" tabindex="-1" role="dialog" aria-labelledby="getCall" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                    <h4 class="modal-title" id="myModalLabel">Обратный звонок</h4>
                </div>
                <div class="modal-body">
                    <div role="form" class="wpcf7" id="wpcf7-f4-o1" lang="ru-RU" dir="ltr">
                        <?php $callForm = ActiveForm::begin([
                            'id' => 'callForm',
                            'action' => ['site/get-call'],
                            'enableClientValidation' => true,
                            'options' => ['class' => 'wpcf7-form'],
                            'fieldConfig' => [
                                'template' => '{input}{error}',
                                'labelOptions' => [],
                            ],
                        ]); ?>
                        <p>
                            Имя
                            <span class="wpcf7-form-control-wrap yname">
                                <?=$callForm->field($this->params['callForm'], 'name')->textInput(['placeholder' => 'Ваше имя'])?>
                            </span>
                            Номер телефона
                            <span class="wpcf7-form-control-wrap ytel">
                                <?=$callForm->field($this->params['callForm'], 'phone')->textInput(['placeholder' => '+7 (912) 345-6789'])?>
                            </span>
                            <?=Html::submitInput('Заказать звонок', ['class' => 'wpcf7-form-control wpcf7-submit'])?>
                        </p>
                        <?php ActiveForm::end(); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="timeModal" tabindex="-1" role="dialog" aria-labelledby="timeModal" aria-hidden="true">
        <div class="modal-dialog" role="document" style="width: 100%;max-width: 400px;color: #000;">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                    <h4 class="modal-title" id="myModalLabel">В данное время доставка не работает.</h4>
                    <h4 class="modal-title" id="myModalLabel2">Прием заказов с 11:30 до 22:30</h4>
                    <h4 class="modal-title" id="myModalLabel2">но Вы можете сделать заказ заранее</h4>
                </div>
            </div>
        </div>
    </div>
</footer>

<!-- Yandex.Metrika counter -->
<script type="text/javascript">
    (function (d, w, c) {
        (w[c] = w[c] || []).push(function() {
            try {
                w.yaCounter47037111 = new Ya.Metrika2({
                    id:47037111,
                    clickmap:true,
                    trackLinks:true,
                    accurateTrackBounce:true,
                    webvisor:true
                });
            } catch(e) { }
        });
        var n = d.getElementsByTagName("script")[0],
            s = d.createElement("script"),
            f = function () { n.parentNode.insertBefore(s, n); };
        s.type = "text/javascript";
        s.async = true;
        s.src = "https://mc.yandex.ru/metrika/tag.js";
        if (w.opera == "[object Opera]") {
            d.addEventListener("DOMContentLoaded", f, false);
        } else { f(); }
    })(document, window, "yandex_metrika_callbacks2");
</script>
<noscript><div><img src="https://mc.yandex.ru/watch/47037111" style="position:absolute; left:-9999px;" alt="" /></div></noscript>
<!-- /Yandex.Metrika counter -->

<!--<button id="responsive-menu-button" class="responsive-menu-button responsive-menu-boring responsive-menu-accessible" type="button" aria-label="Menu">
    <span class="responsive-menu-box">
        <span class="responsive-menu-inner"></span>
    </span>
</button>-->
<!--<div id="responsive-menu-container" class="slide-left">
    <div id="responsive-menu-wrapper">
        <ul id="responsive-menu" class="">
            <li id="responsive-menu-item-99" class="menu-item menu-item-type-custom menu-item-object-custom current-menu-item current_page_item menu-item-home responsive-menu-item responsive-menu-current-item">
                <a href="/" class="responsive-menu-item-link">Главная</a>
            </li>
            <li id="responsive-menu-item-103" class="menu-item menu-item-type-taxonomy menu-item-object-product_cat responsive-menu-item">
                <a href="/category/pizza" class="responsive-menu-item-link">Пицца</a>
            </li>
            <li id="responsive-menu-item-1865" class="menu-item menu-item-type-taxonomy menu-item-object-product_cat responsive-menu-item">
                <a href="/category/pasta" class="responsive-menu-item-link">Пасты</a>
            </li>
            <li id="responsive-menu-item-1866" class="menu-item menu-item-type-taxonomy menu-item-object-product_cat responsive-menu-item">
                <a href="/category/salad" class="responsive-menu-item-link">Салаты</a>
            </li>
            <li id="responsive-menu-item-2616" class="menu-item menu-item-type-taxonomy menu-item-object-product_cat responsive-menu-item">
                <a href="/category/combo" class="responsive-menu-item-link">Комбо</a>
            </li>
            <li id="responsive-menu-item-104" class="menu-item menu-item-type-taxonomy menu-item-object-product_cat responsive-menu-item">
                <a href="/category/drink" class="responsive-menu-item-link">Напитки</a>
            </li>
            <li id="responsive-menu-item-101" class="menu-item menu-item-type-post_type menu-item-object-page responsive-menu-item">
                <a href="/cart" class="responsive-menu-item-link">Корзина</a>
            </li>
            <li id="responsive-menu-item-102" class=" menu-item menu-item-type-post_type menu-item-object-page responsive-menu-item">
                <a href="/payment" class="responsive-menu-item-link">Условия бесплатной доставки</a>
            </li>
            <li id="responsive-menu-item-100" class="menu-item menu-item-type-post_type menu-item-object-page responsive-menu-item">
                <a href="/contacts" class="responsive-menu-item-link">Контакты</a>
            </li>
        </ul>
        <div id="responsive-menu-additional-content">
            <div class="phoneTop">
                +7 (3812) 28-14-12
                <a href="" data-target="#getCall" data-toggle="modal">заказать звонок</a>
            </div>
            <div class="timeTop">
                Прием заказов<br>
                Пн-вс: 11.30-22.30
            </div>
        </div>
    </div>
</div>-->
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
