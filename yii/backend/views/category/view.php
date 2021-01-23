<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Category */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Категории', 'url' => ['index']];
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
                                'confirm' => 'Вы уверены, что хотите удалить эту категорию?',
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
                            'attribute' => 'parent_id',
                            'format' => 'html',
                            'value' => function($model) {
                                return ($model->parent) ? Html::a($model->parent->title, ['view', 'id' => $model->parent->id]) : 'Нет родительской категории';
                            },
                        ],
                        'title',
                        'description',
                        'keywords',
                        'meta_description',
                        'slug',
                        'created_at:datetime',
                    ],
                ]) ?>
            </div>
        </div>
    </div>
</div>