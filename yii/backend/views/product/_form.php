<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Product */
/* @var $form yii\widgets\ActiveForm */
?>


<?php $form = ActiveForm::begin(); ?>
<div class="box-body">
    <?= $form->field($model, 'category_id')->dropDownList($model->getCategories()) ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true, 'placeholder' => 'Введите название товара']) ?>

    <?= $form->field($model, 'description')->textarea(['rows' => 6, 'placeholder' => 'Введите описание товара']) ?>

    <?= $form->field($model, 'composition')->textInput(['maxlength' => true, 'placeholder' => 'Укажите состав']) ?>

    <?= $form->field($model, 'size')->textInput(['maxlength' => true, 'placeholder' => 'Укажите размеры пиццы (пример: 35 см.) или оставьте поле пустым']) ?>

    <?= $form->field($model, 'weight')->textInput(['maxlength' => true, 'placeholder' => 'Вес, пример: 130 гр.']) ?>

    <?= $form->field($model, 'price')->textInput(['maxlength' => true, 'placeholder' => 'Введите цену']) ?>

    <?= $form->field($model, 'have_related')->dropDownList(['Нет', 'Да']) ?>

    <?= $form->field($model, 'is_drink')->dropDownList(['Нет', 'Да']) ?>

    <?= $form->field($model, 'is_new')->dropDownList(['Нет', 'Да']) ?>

    <?= $form->field($model, 'meta_keywords')->textInput(['maxlength' => true, 'placeholder' => 'Ключевые слова']) ?>

    <?= $form->field($model, 'meta_description')->textInput(['maxlength' => true, 'placeholder' => 'Мета-описание']) ?>

    <?= $form->field($model, 'image')->fileInput() ?>

</div>
<div class="box-footer">
    <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
</div>
<?php ActiveForm::end(); ?>



