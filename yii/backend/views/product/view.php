<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Product */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Товары', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
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
                                'confirm' => 'Вы уверены, что хотите удалить этот товар?',
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
                        [
                            'attribute' => 'category_id',
                            'value' => function ($model) {
                                return ($model->category) ? $model->category->title : 'Без категории';
                            },
                        ],
                        'title',
                        'description:ntext',
                        'composition',
                        'size',
                        'weight',
                        'price',
                        'image',
                        'slug',
                        [
                            'attribute' => 'have_related',
                            'value' => function ($model) {
                                return ($model->have_related) ? 'Да' : 'Нет';
                            },
                        ],
                        [
                            'attribute' => 'is_drink',
                            'value' => function ($model) {
                                return ($model->is_drink) ? 'Да' : 'Нет';
                            },
                        ],
                        [
                            'attribute' => 'is_new',
                            'value' => function ($model) {
                                return ($model->is_new) ? 'Да' : 'Нет';
                            },
                        ],
                        //'have_related',
                        //'is_drink',
                        //'is_new',
                        'sales_count',
                    ],
                ]) ?>
            </div>
        </div>
    </div>
</div>