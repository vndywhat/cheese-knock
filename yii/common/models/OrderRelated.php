<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "order_related".
 *
 * @property int $id
 * @property int $order_item_id
 * @property int $ingredient_id
 *
 * @property Ingredient $ingredient
 * @property OrderItem $orderItem
 */
class OrderRelated extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'order_related';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['order_item_id', 'ingredient_id'], 'required'],
            [['order_item_id', 'ingredient_id'], 'integer'],
            [['ingredient_id'], 'exist', 'skipOnError' => true, 'targetClass' => Ingredient::class, 'targetAttribute' => ['ingredient_id' => 'id']],
            [['order_item_id'], 'exist', 'skipOnError' => true, 'targetClass' => OrderItem::class, 'targetAttribute' => ['order_item_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'order_item_id' => 'Order Item ID',
            'ingredient_id' => 'Ingredient ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIngredient()
    {
        return $this->hasOne(Ingredient::class, ['id' => 'ingredient_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrderItem()
    {
        return $this->hasOne(OrderItem::class, ['id' => 'order_item_id']);
    }
}
