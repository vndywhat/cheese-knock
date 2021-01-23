<?php

namespace common\models;

use Yii;
use yii\caching\DbDependency;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "config".
 *
 * @property int $id
 * @property string $about
 * @property string $phone
 * @property string $orders
 * @property string $address
 * @property string $regime
 * @property string $main_office
 * @property string $time_work
 */
class Config extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'config';
    }

    public static function primaryKey()
    {
        return ['id'];
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['about', 'phone', 'orders', 'address', 'regime', 'main_office', 'time_work'], 'required'],
            [['about'], 'string'],
            [['phone', 'orders'], 'string', 'max' => 255],
            [['address', 'regime', 'main_office', 'time_work'], 'string', 'max' => 100],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'about' => 'О нас',
            'phone' => 'Телефон',
            'orders' => 'Время приёма заказов',
            'address' => 'Адрес',
            'regime' => 'Режим работы',
            'main_office' => 'Главный офис',
            'time_work' => 'Время работы',
        ];
    }
}
