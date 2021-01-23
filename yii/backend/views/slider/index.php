<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel common\models\SliderSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Слайдер';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="row">
    <div class="col-md-12">
        <div class="box box-warning">
            <div class="box-header with-border">
                <h3 class="box-title">Список слайдов</h3>
                <div class="box-tools">
                    <div class="btn-group">
                        <?= Html::a('<i class="fa fa-plus"></i>', ['create'], ['class' => 'btn btn-box-tool', 'title' => 'Добавить слайд']) ?>
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
                        'title',
                        'subtitle',
                        'price',
                        //'excerpt:ntext',
                        'link',
                        //'image',
                        'created_at:datetime',

                        ['class' => 'yii\grid\ActionColumn'],
                    ],
                ]);?>
                <?php Pjax::end(); ?>
            </div>
        </div>
    </div>
</div>