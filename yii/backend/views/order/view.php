<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Order */

$this->title = '#' . $model->id . ' ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Заказы', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

\yii\web\YiiAsset::register($this);

$this->registerJsFile('/admin/js/orders.js', ['depends' => 'yii\web\YiiAsset']);

?>
<div class="row">
    <div class="col-md-6">
        <div class="box box-warning">
            <div class="box-header with-border">
                <h3 class="box-title"><?= Html::encode($this->title) ?></h3>
                <div class="box-tools">
                    <div class="btn-group">
                        <?= Html::a('<i class="fa fa-wrench"></i>', ['update', 'id' => $model->id], ['class' => 'btn btn-box-tool', 'title' => 'Редактировать'])?>
                        <?= Html::a('<i class="fa fa-times"></i>', ['delete', 'id' => $model->id], ['class' => 'btn btn-box-tool', 'title' => 'Удалить',
                            'data' => [
                                'confirm' => 'Вы уверены, что хотите удалить этот заказ?',
                                'method' => 'post',
                            ],
                        ])?>
                    </div>
                </div>
            </div>
            <div class="box-body">
                <?= DetailView::widget([
                    'model' => $model,
                    'attributes' => [
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
                        [
                            'attribute' => 'pick_zone',
                            'value' => function ($model) {
                                return $model->pickZone();
                            }
                        ],
                        'name',
                        'address',
                        'porch',
                        'floor',
                        'flat',
                        'phone',
                        'delivery_time',
                        'comment:ntext',
                        'amount',
                        [
                            'attribute' => 'delivery_zone',
                            'value' => function ($model) {
                                return ($model->calculateDelivery() === 0) ? 'Бесплатно' : $model->calculateDelivery();
                            }
                        ],
                        [
                            'attribute' => 'status',
                            'value' => function ($model) {
                                return ($model->status === 0) ? 'Ожидание' : '';
                            }
                        ],
                        'created_at:datetime',
                        'updated_at:datetime',
                    ],
                ]) ?>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="box box-warning">
            <div class="box-header with-border">
                <h3 class="box-title">Состав заказа</h3>
            </div>
            <div class="box-body">
                <?php if(count($model->items) > 0): ?>
                <ul class="products-list product-list-in-box">
                    <?php foreach ($model->items as $item):?>
                        <?php foreach ($item->products as $product):?>
                            <?php if($product->id === $item->product_id): ?>
                                <li id="item-<?=$item->id?>" class="item">
                                    <div class="product-img">
                                        <?=Html::img($product->getThumb(), ['alt' => $product->title, 'class' => 'rounded-circle'])?>
                                    </div>
                                    <div class="product-info">
                                        <a href="<?=Url::to(['/product/view', 'id' => $product->id])?>" class="product-title">
                                            <?=$product->title?>
                                        </a>
                                        <small class="times">×</small> <?=$item->count?>
                                        <span class="label label-success pull-right"><?=$item->countPrice()?>₽</span>
                                        <span class="box-tools">
                                            <?= Html::a('<i class="fa fa-edit"></i>', '#', ['class' => 'btn btn-box-tool', 'title' => 'Редактировать', 'onclick' => 'editItem('.$item->id.'); return false;'])?>
                                            <?= Html::a('<i class="fa fa-times"></i>', ['/order-item/delete', 'id' => $item->id], ['class' => 'btn btn-box-tool', 'title' => 'Удалить',
                                                'data' => [
                                                    'confirm' => 'Вы уверены, что хотите удалить эту позицию?',
                                                    'method' => 'post',
                                                ],
                                            ])?>
                                        </span>
                                        <span class="text-break product-description" style="white-space: unset;">
                                            <?php if(count($item->ingredients) > 0): ?>
                                                <ul class="">
                                                    <?php foreach ($item->ingredients as $ingredient): ?>
                                                    <li><?=$ingredient->title?> <?=$ingredient->weight?></li>
                                                    <?php endforeach; ?>
                                                </ul>
                                            <?php endif; ?>
                                        </span>
                                    </div>
                                </li>
                                <li id="edit-item-<?=$item->id?>" class="item hidden"></li>
                                <!-- /.item -->
                            <?php endif; ?>
                        <?php endforeach; ?>
                    <?php endforeach; ?>
                    <li id="add-item" class="item hidden"></li>
                </ul>
                <?php endif; ?>
            </div>
            <!--<div class="box-footer">
                <?/*=Html::a('Добавить позицию', '#', ['class' => 'btn btn-default', 'onclick' => 'addItem(); return false;'])*/?>
            </div>-->
        </div>
    </div>
</div>
