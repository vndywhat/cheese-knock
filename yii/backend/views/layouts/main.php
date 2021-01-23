<?php

use dmstr\widgets\Menu;
use yii\helpers\Html;

/* @var $this \yii\web\View */
/* @var $content string */

backend\assets\AppAsset::register($this);


dmstr\web\AdminLteAsset::register($this);

$directoryAsset = Yii::$app->assetManager->getPublishedUrl('@vendor/almasaeed2010/adminlte/dist');

?>
<?php $this->beginPage() ?>
    <!DOCTYPE html>
    <html lang="<?= Yii::$app->language ?>">
    <head>
        <meta charset="<?= Yii::$app->charset ?>"/>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <?= Html::csrfMetaTags() ?>
        <title><?= Html::encode($this->title) ?> — Доставка итальянской пиццы Cheese Knock</title>
        <link rel="icon" href="/favicon.png" sizes="32x32">
        <?php $this->head() ?>
    </head>
    <body class="hold-transition layout-boxed skin-yellow sidebar-mini">
    <?php $this->beginBody() ?>
    <div class="wrapper">

        <?= $this->render(
            'header.php',
            ['directoryAsset' => $directoryAsset]
        ) ?>

        <aside class="main-sidebar">
            <section class="sidebar">
                <?= dmstr\widgets\Menu::widget(
                    [
                        'options' => ['class' => 'sidebar-menu tree', 'data-widget'=> 'tree'],
                        'items' => [
                            ['label' => 'Меню', 'options' => ['class' => 'header']],
                            ['label' => 'Главная', 'icon' => 'fw fa-gear', 'url' => ['/site/index']],
                            ['label' => 'Категории', 'icon' => 'cart-plus', 'url' => ['/category/index']],
                            ['label' => 'Товары', 'icon' => 'cutlery', 'url' => ['/product/index']],
                            ['label' => 'Слайдер', 'icon' => 'image', 'url' => ['/slider/index']],
                            ['label' => 'Заказы', 'icon' => 'money', 'url' => ['/order/index']],
                            ['label' => 'Сопутствующие товары', 'icon' => 'glass', 'url' => ['/ingredient/index'], 'items' => [
                                ['label' => 'Ингредиенты', 'icon' => 'lemon-o', 'url' => ['/ingredient/index']],
                            ]],
                            ['label' => 'Gii', 'icon' => 'file-code-o', 'url' => ['/gii']],
                            ['label' => 'Debug', 'icon' => 'dashboard', 'url' => ['/debug']],
                            ['label' => 'Login', 'url' => ['site/login'], 'visible' => Yii::$app->user->isGuest],
                        ],
                    ]
                ) ?>
            </section>
        </aside>

        <?= $this->render(
            'content.php',
            ['content' => $content, 'directoryAsset' => $directoryAsset]
        ) ?>

    </div>

    <?php $this->endBody() ?>
    </body>
    </html>
<?php $this->endPage() ?>