<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel common\models\OrderSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Заказы';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="row">
    <div class="col-md-12">
        <div class="box box-warning">
            <div class="box-header with-border">
                <h3 class="box-title">Список заказов</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <?php Pjax::begin(); ?>
                <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

                <?= GridView::widget([
                    'dataProvider' => $dataProvider,
                    'filterModel' => $searchModel,
                    'columns' => [
                        ['class' => 'yii\grid\SerialColumn'],

                        'id',
                        [
                            'attribute' => 'delivery_type',
                            'value' => function ($model) {
                                return ($model->delivery_type === 0) ? 'Доставка' : 'Самовывоз';
                            }
                        ],
                        [
                            'attribute' => 'payment_type',
                            'value' => function ($model) {
                                return ($model->payment_type === 0) ? 'Наличный' : 'Безналичный';
                            }
                        ],
                        'name',
                        //'address',
                        //'porch',
                        //'floor',
                        //'flat',
                        //'phone',
                        //'delivery_time',
                        //'comment:ntext',
                        'amount',
                        [
                            'attribute' => 'delivery_zone',
                            'value' => function ($model) {
                                return $model->calculateDelivery();
                            }
                        ],
                        [
                            'attribute' => 'status',
                            'value' => function ($model) {
                                return ($model->status === 0) ? 'Ожидание' : '';
                            }
                        ],
                        //'created_at',
                        //'updated_at',

                        ['class' => 'yii\grid\ActionColumn'],
                    ],
                ]); ?>

                <?php Pjax::end(); ?>
            </div>
        </div>
    </div>
</div>