<?php
/**
 * @var $model \common\models\OrderItem
 */

use yii\helpers\Html;
use yii\widgets\ActiveForm;

?>
<?php
$form = ActiveForm::begin([
    'id' => 'edit-'.$model->id,
    'action' => '',
]); ?>
    <div class="form-row col-md-12">
        <div class="form-group col-md-6">
            <label for="item-product_id">Товар</label>
            <select id="item-product_id" class="form-control" name="OrderItem[product_id]" aria-invalid="false">
                <?=$model->productSelect()?>
            </select>
        </div>
        <div class="form-group col-md-3">
            <label for="item-count">Количество</label>
            <input type="number" id="item-count" class="form-control plaintext" name="OrderItem[count]" value="<?=$model->count?>" min="1" placeholder="Количество" aria-invalid="false">
        </div>
        <?php if(count($model->ingredients) > 0): ?>
        <div class="form-group col-md-12">
            <div class="col-sm-6">

        </div>
        <?php endif; ?>
        <div class="form-group col-md-12">
            <?=Html::submitInput('Сохранить', ['class' => 'btn btn-success mb-2', 'title' => 'Сохранить', 'onclick' => 'preventDefault(); saveItem('.$model->id.');'])?>
            <?= Html::a('Отменить', '#', ['class' => 'btn btn-default mb-2', 'title' => 'Отменить', 'onclick' => 'cancelEdit('.$model->id.'); return false;'])?>
        </div>
    </div>
<?php ActiveForm::end(); ?>