<?php
/* @var $this yii\web\View */

use yii\bootstrap\ActiveForm;
use yii\bootstrap\Html;
use yii\helpers\Url;

$this->title = 'Главная';


?>
<div class="row">

    <div class="col-md-3 col-sm-6 col-xs-12">
        <div class="info-box">
            <span class="info-box-icon bg-green"><i class="fa fa-credit-card"></i></span>

            <div class="info-box-content">
                <span class="info-box-text">Продаж</span>
                <span class="info-box-number">760</span>
            </div>
            <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
    </div>
    <!-- /.col -->

    <div class="col-md-3 col-sm-6 col-xs-12">
        <div class="info-box">
            <span class="info-box-icon bg-maroon"><i class="fa fa-heart"></i></span>

            <div class="info-box-content">
                <span class="info-box-text">Топ продаж</span>
                <span class="info-box-number"><a href="<?= Url::to(['/product/view', 'id' => 2])?>">Амичи</a></span>
            </div>
            <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
    </div>
</div>
<div class="row">
    <?php $form = ActiveForm::begin() ?>
    <div class="col-md-6">
        <div class="box box-warning">
            <div class="box-header">
                <h3 class="box-title">Основные настройки</h3>
            </div>
            <div class="box-body">
                <?=$form->field($model, 'orders')->textInput(['placeholder' => 'Время приёма заказов'])?>
                <?=$form->field($model, 'regime')->textInput(['placeholder' => 'Режим работы'])?>
                <?=$form->field($model, 'time_work')->textInput(['placeholder' => 'Время работы'])?>
                <?=$form->field($model, 'address')->textInput(['placeholder' => 'Адрес'])?>
                <?=$form->field($model, 'main_office')->textInput(['placeholder' => 'Главный офис'])?>
            </div>
            <div class="box-footer">
                <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success'])?>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="col-md-12">
            <div class="box box-warning">
                <div class="box-header">
                    <h3 class="box-title">О нас</h3>
                </div>
                <div class="box-body">
                    <?=$form->field($model, 'about')->textarea(['placeholder' => 'О нас', 'rows' => '6'])?>
                </div>
                <div class="box-footer">
                    <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success'])?>
                </div>
            </div>
        </div>
        <div class="col-md-12">
            <div class="box box-warning">
                <div class="box-header">
                    <h3 class="box-title">Телефоны</h3>
                </div>
                <div class="box-body">
                    <?=$form->field($model, 'phone')->textInput(['placeholder' => 'Телефон'])?>
                </div>
                <div class="box-footer">
                    <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success'])?>
                </div>
            </div>
        </div>
    </div>
    <?php ActiveForm::end() ?>
</div>