<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Slider */
/* @var $form yii\widgets\ActiveForm */
?>
<?php $form = ActiveForm::begin(); ?>
<div class="box-body">
    <?= $form->field($model, 'title')->textInput(['maxlength' => true, 'placeholder' => 'Добавить заголовок']) ?>
    <?= $form->field($model, 'subtitle')->textInput(['maxlength' => true, 'placeholder' => 'Пример: Амичи + Пепперони']) ?>
    <?= $form->field($model, 'price')->textInput(['placeholder' => 'Цена в рублях, пример: 100']) ?>
    <?= $form->field($model, 'excerpt')->textarea(['rows' => 6]) ?>
    <?= $form->field($model, 'link')->textInput(['placeholder' => 'Ссылка на товар или страницу']) ?>
    <?= $form->field($model, 'image')->fileInput() ?>
    <div class="box-footer">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
    </div>
</div>
<?php ActiveForm::end(); ?>
