<?php

/* @var $this yii\web\View */
/* @var $name string */
/* @var $message string */
/* @var $exception Exception */

use yii\helpers\Html;

$this->title = $name;
?>
<!-- Page Content -->
<div class="container catalog-page">
    <div class="row">
        <ul class="bcrumbs">
            <li><a href="/">Главная</a></li>
            <li><a href="/">Заказать онлайн</a></li>
        </ul>
        <div class="rulesLink">
            <a href="/payment">Условия оплаты и доставки</a>
        </div>
    </div>
    <div class="row">
        <h1 class="text-center"><?= Html::encode($this->title) ?></h1>
        <div class="woocommerce">
            <div class="woocommerce-notices-wrapper"></div>
            <p class="cart-empty"><?= nl2br(Html::encode($message)) ?></p>
            <p>
                Вышеуказанная ошибка произошла, когда веб-сервер обрабатывал ваш запрос.
            </p>
            <p>
                Пожалуйста, свяжитесь с нами, если считаете, что это ошибка сервера. Спасибо.
            </p>
        </div>
    </div>
    <!-- /.row -->
</div>
<!-- /.container -->
<!--<div class="site-error">

    <h1><?/*= Html::encode($this->title) */?></h1>

    <div class="alert alert-danger">
        <?/*= nl2br(Html::encode($message)) */?>
    </div>

    <p>
        The above error occurred while the Web server was processing your request.
    </p>
    <p>
        Please contact us if you think this is a server error. Thank you.
    </p>

</div>-->
