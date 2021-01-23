<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "order_item".
 *
 * @property int $id
 * @property int $order_id
 * @property int $product_id
 * @property string $price
 * @property int $count
 */
class OrderItem extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'order_item';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['order_id', 'product_id', 'price', 'count'], 'required'],
            [['order_id', 'product_id'], 'integer'],
            [['price'], 'number'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'order_id' => 'Номер заказа',
            'product_id' => 'Идентификатор товара',
            'price' => 'Цена',
            'count' => 'Количество',
        ];
    }

    public function getProducts() {
        return $this->hasMany(Product::class, ['id' => 'product_id']);
    }

    public function getRelated() {
        return $this->hasMany(OrderRelated::class, ['order_item_id' => 'id']);
    }

    public function getIngredients() {
        return $this->hasMany(Ingredient::class, ['id' => 'ingredient_id'])->via('related');
    }

    public function countPrice()
    {
        $price = $this->price;
        if(count($this->ingredients) > 0) {
            foreach ($this->ingredients as $ingredient)
            {
                $price = $price + $ingredient->price;
            }
        }
        return $price;
    }

    public function productSelect()
    {
        $products = Product::find()->all();
        $select = '';

        foreach ($products as $product)
        {
            if($product->id === $this->product_id)
            {
                $select .= '<option value="'.$product->id.'" selected="selected">'.$product->title.'</option>';
            }
            else
            {
                $select .= '<option value="'.$product->id.'">'.$product->title.'</option>';
            }
        }

        return $select;
    }

    public function getAllIngredients()
    {
        $ingredients = Ingredient::getAll();

        return $ingredients;
    }
}
