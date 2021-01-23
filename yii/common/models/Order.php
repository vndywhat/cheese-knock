<?php

namespace common\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\db\Expression;

/**
 * This is the model class for table "order".
 *
 * @property int $id
 * @property string $hash
 * @property int $delivery_type
 * @property int $delivery_zone
 * @property int $payment_type
 * @property int $pick_zone
 * @property string $name
 * @property string $address
 * @property string $porch
 * @property string $floor
 * @property string $flat
 * @property string $phone
 * @property string $delivery_time
 * @property string $comment
 * @property string $amount
 * @property int $status
 * @property int $created_at
 * @property int $updated_at
 */
class Order extends ActiveRecord
{

    public function behaviors()
    {
        return [
            [
                'class' => TimestampBehavior::class,
                'attributes' => [
                    // при вставке новой записи присвоить атрибутам created
                    // и updated значение метки времени UNIX
                    ActiveRecord::EVENT_BEFORE_INSERT => ['created_at', 'updated_at'],
                    // при обновлении существующей записи  присвоить атрибуту
                    // updated значение метки времени UNIX
                    ActiveRecord::EVENT_BEFORE_UPDATE => ['updated_at'],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'order';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'phone', 'delivery_type', 'payment_type', 'status', 'delivery_zone'], 'required'],
            [['comment'], 'string'],
            [['amount'], 'number'],
            [['status', 'created_at', 'updated_at', 'pick_zone'], 'integer'],
            [['address', 'delivery_time'], 'string', 'max' => 255],
            [['name'], 'string', 'max' => 100],
            [['phone'], 'string', 'max' => 17],
            [['porch', 'floor', 'flat'], 'string', 'max' => 15],
            ['phone', 'match', 'pattern' => '/^\+7\s\([0-9]{3}\)\s[0-9]{3}\-[0-9]{4}$/', 'message' => 'Номер телефона должен соответствовать формату +7 (912) 345-6789'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'delivery_type' => 'Тип доставки',
            'payment_type' => 'Способ оплаты',
            'delivery_zone' => 'Доставка',
            'pick_zone' => 'Точка самовывоза',
            'name' => 'Имя',
            'address' => 'Адрес',
            'porch' => 'Подъезд',
            'floor' => 'Этаж',
            'flat' => 'Квартира',
            'phone' => 'Телефон',
            'delivery_time' => 'Доставка по времени',
            'comment' => 'Примечание к заказу',
            'amount' => 'Итог',
            'status' => 'Статус заказа',
            'created_at' => 'Создано',
            'updated_at' => 'Обновлено',
        ];
    }

    public function getItems()
    {
        return $this->hasMany(OrderItem::class, ['order_id' => 'id'])->with('products')->with('related')->with('ingredients');
    }

    public function addItems($cart)
    {
        $products = [];
        $items = $cart->getItems();
        foreach ($items as $cartItem)
        {
            $item = new OrderItem();
            $ingredients = $cartItem->getIngredients();
            $item->order_id = $this->id;
            $item->product_id = $cartItem->getProduct()->id;
            $products[] = $cartItem->getProduct()->id;
            $item->price = $cartItem->getProduct()->price;
            $item->count = $cartItem->getQuantity();
            $item->insert();
            if(count($ingredients) > 0) {
                foreach ($ingredients as $ingredient) {
                    $related = new OrderRelated();
                    $related->order_item_id = $item->id;
                    $related->ingredient_id = $ingredient->id;
                    $related->insert();
                }
            }
        }
        array_unique($products);
        Product::updateAllCounters(['sales_count' => 1], ['id' => $products]);
    }

    public function calculateDelivery()
    {
        $delivery = 0;
        switch($this->delivery_zone)
        {
            case 0:
                $delivery = 100;
                break;
            case 1:
                $delivery = 200;
                break;
            case 2:
                $delivery = 300;
                break;
            case 3:
                $delivery = 0;
                break;
        }

        return $delivery;
    }

    public static function refreshPrice($orderId)
    {
        $order = self::find()->where(['id' => $orderId])->one();
        $sum = OrderItem::find()->where(['order_id' => $orderId])->sum('price');
        $order->amount = $sum;

        $order->save(false);
    }

    public function pickZone()
    {
        $zone = '';
        switch ($this->pick_zone)
        {
            case 1:
                $zone = 'ул. Лермонтова 4';
                break;
            case 2:
                $zone = 'ул. Лукашевича 21Б';
                break;
            case 3:
                $zone = 'Доставка';
                break;
        }

        return $zone;
    }
}
