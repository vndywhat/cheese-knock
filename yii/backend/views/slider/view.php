<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Slider */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Слайдер', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<!--<div class="slider-view">

    <h1><?/*= Html::encode($this->title) */?></h1>

    <p>
        <?/*= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) */?>
        <?/*= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) */?>
    </p>

    <?/*= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'title',
            'subtitle',
            'price',
            'excerpt:ntext',
            'link:ntext',
            'image',
            'created_at',
        ],
    ]) */?>

</div>-->
<div class="row">
    <div class="col-md-12">
        <div class="box box-warning">
            <div class="box-header with-border">
                <h3 class="box-title"><?= Html::encode($this->title) ?></h3>
                <div class="box-tools">
                    <div class="btn-group">
                        <?= Html::a('<i class="fa fa-wrench"></i>', ['update', 'id' => $model->id], ['class' => 'btn btn-box-tool', 'title' => 'Редактировать'])?>
                        <?= Html::a('<i class="fa fa-times"></i>', ['delete', 'id' => $model->id], ['class' => 'btn btn-box-tool', 'title' => 'Удалить',
                            'data' => [
                                'confirm' => 'Вы уверены, что хотите удалить этот слайд?',
                                'method' => 'post',
                            ],
                        ])?>
                    </div>
                </div>
            </div>
            <div class="box-body">
                <?= DetailView::widget([
                    'model' => $model,
                    'options' => ['class' => 'table table-bordered'],
                    'attributes' => [
                        'id',
                        'title',
                        'subtitle',
                        'price',
                        'excerpt:ntext',
                        'link',
                        'image',
                        'created_at:datetime',
                    ],
                ]) ?>
            </div>
        </div>
    </div>
</div>