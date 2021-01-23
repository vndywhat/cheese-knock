<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel common\models\ProductSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Товары';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="row">
    <div class="col-md-12">
        <div class="box box-warning">
            <div class="box-header with-border">
                <h3 class="box-title">Список товаров</h3>
                <div class="box-tools">
                    <div class="btn-group">
                        <?= Html::a('<i class="fa fa-plus"></i>', ['create'], ['class' => 'btn btn-box-tool', 'title' => 'Добавить товар']) ?>
                    </div>
                </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <?php Pjax::begin(); ?>
                <?php /*// echo $this->render('_search', ['model' => $searchModel]); */?>
                <?= GridView::widget([
                    'dataProvider' => $dataProvider,
                    'filterModel' => $searchModel,
                    'layout' => '{items}{summary}<div class="box-footer" style="padding-top: 10px;float: right;">{pager}</div>',
                    'tableOptions' => [
                        'class' => 'table table-bordered',
                    ],
                    'columns' => [
                        ['class' => 'yii\grid\SerialColumn'],
                        'id',
                        [
                            'attribute' => 'category_id',
                            'format' => 'html',
                            'value' => function ($model) {
                                return ($model->category) ? Html::a($model->category->title, ['category/view', 'id' => $model->category->id]) : 'Без категории';
                            },
                        ],
                        'title',
                        'description:ntext',
                        'composition',
                        //'size',
                        //'weight',
                        //'price',
                        //'image',
                        //'slug',
                        //'have_related',
                        //'is_drink',
                        //'is_new',
                        'sales_count',

                        ['class' => 'yii\grid\ActionColumn'],
                    ],
                ]);?>
                <?php Pjax::end(); ?>
            </div>
        </div>
    </div>
</div>