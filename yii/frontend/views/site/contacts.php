<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\ContactForm */

$this->title = 'Контакты';

use yii\captcha\Captcha;
use yii\bootstrap\ActiveForm;
use yii\helpers\Html;

$ajaxForm = <<<JS
$('#contact-form').on('beforeSubmit', function () {
    var yiiform = $(this);
    
    $.ajax({
            type: yiiform.attr('method'),
            url: yiiform.attr('action'),
            data: yiiform.serializeArray()
        }
    )
    .done(function(data) {
       if(data.success) {
           yiiform[0].reset();
           $.jGrowl(data.message, { position: 'bottom-right' });
        }
    })
    .fail(function () {
         $.jGrowl('Не удалось подключиться к серверу. Приносим извинения за предоставленные неудобства, перезагрузите страничку и попробуйте ещё раз!', { header: 'Ошибка', position: 'bottom-right' });
    });

    return false;
});

JS;

$this->registerJs($ajaxForm);
?>
<!-- Page Content -->
<div class="container catalog-page contact-page">
    <div class="row">
        <ul class="bcrumbs">
            <li><?=Html::a('Главная', ['/site/index'])?></li>
            <li>Контакты</li>
        </ul>
        <div class="rulesLink">
            <?=Html::a('Условия оплаты и доставки', ['/site/payment'])?>
        </div>
    </div>
    <div class="row">
        <h1 class="text-center">Контакты</h1>

        <div class="col-sm-6">
            <h2 class="text-center">Контактная информация</h2>
            <div class="contact-item">
                <div class="ititle">Адрес:</div>
                <div class="iaddr"><?=$this->params['config']['address']?></div>
            </div>
            <div class="contact-item">
                <div class="ititle">Режим работы:</div>
                <div class="hours">
                    <?=$this->params['config']['regime']?>
                </div>
            </div>
            <div class="contact-item">
                <div class="ititle">Телефон:</div>
                <div class="itel"><?=$this->params['config']['phone']?></div>
            </div>

            <div class="social">
                <a href="https://vk.com/cheeseknock" target="_blank">
                    <img class="vkico"
                         src="/images/vk.png">
                </a>
                <a href="https://www.instagram.com/cheeseknock/" target="_blank">
                    <img class="instaico"
                         src="/images/insta.png">
                </a>
            </div>

        </div>
        <div class="col-sm-6">
            <h2 class="text-center">Обратная связь</h2>
            <div class="callback-form">
                Вы можете написать нам, заполнив данную форму
                <div role="form" class="wpcf7" id="wpcf7-f203-p12-o1" lang="ru-RU" dir="ltr">
                    <div class="screen-reader-response"></div>
                    <?php $form = ActiveForm::begin([
                        'id' => 'contact-form',
                        'enableClientValidation' => true,
                        //'enableAjaxValidation' => true,
                        'options' => ['class' => 'wpcf7-form'],
                        'fieldConfig' => [
                            'template' => '{input}{error}',
                            'labelOptions' => [],
                        ],
                    ]); ?>
                    <div class="cfrow">
                        <div class="cfun" style="width: 237px;">
                            <span class="wpcf7-form-control-wrap">
                                <?=$form->field($model, 'name')->textInput(['placeholder' => 'Ваше имя'])?>
                            </span>
                        </div>
                        <div class="cfun" style="width: 237px;">
                            <span class="wpcf7-form-control-wrap">
                                <?=$form->field($model, 'email')->textInput(['placeholder' => 'Email'])?>
                            </span>
                        </div>
                    </div>
                    <div class="textarearow">
                        <?= $form->field($model, 'body')->textarea(['rows' => 10, 'cols' => 40, 'placeholder' => 'Сообщение']) ?>
                    </div>
                    <div class="cfrow">
                        <?= $form->field($model, 'reCaptcha')->widget(
                            \himiklab\yii2\recaptcha\ReCaptcha2::class
                        ) ?>
                    </div>
                    <div class="agree">Нажимая кнопку "Отправить", я даю согласие на
                        <a href="/politic">обработку персональных данных</a>
                    </div>
                    <p>
                        <?=Html::submitInput('Отправить', ['class' => 'wpcf7-form-control wpcf7-submit'])?>
                    </p>
                    <?php ActiveForm::end(); ?>
                </div>
            </div>
        </div>
    </div>
    <!-- /.row -->
</div>
<!-- /.container -->

