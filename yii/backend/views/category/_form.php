<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Category */
/* @var $form yii\widgets\ActiveForm */
?>

<?php $form = ActiveForm::begin(); ?>
<div class="box-body">
    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'parent_id')->dropDownList($model->getCategoriesDropDownList()) ?>
    <?= $form->field($model, 'description')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'keywords')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'meta_description')->textInput(['maxlength' => true]) ?>
    <?php
    if($model->isNewRecord) {
        echo $form->field($model, 'slug')->textInput(['readonly' => 'readonly']);
    } else {
        echo $form->field($model, 'slug')->textInput(['maxlength' => true]);
    }
    ?>
    <?=$form->field($model, 'image')->fileInput()?>
    <div class="box-footer">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
    </div>
</div>
<?php ActiveForm::end(); ?>