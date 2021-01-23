<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Order */
/* @var $form yii\widgets\ActiveForm */
?>

<?php $form = ActiveForm::begin(); ?>
<div class="box-body">
    <?= $form->field($model, 'delivery_type')->dropDownList(['Доставка', 'Самовывоз']) ?>

    <?= $form->field($model, 'delivery_zone')->dropDownList(['100', '200', '300', 'Бесплатно']) ?>

    <?= $form->field($model, 'payment_type')->dropDownList(['Наличный', 'Безналичный']) ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'address')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'porch')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'floor')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'flat')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'phone')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'delivery_time')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'comment')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'amount')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'status')->dropDownList(['Ожидание']) ?>

    <div class="box-footer">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
    </div>
</div>
<?php ActiveForm::end(); ?>
