<?php

namespace common\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "ingredients".
 *
 * @property int $id
 * @property int $type
 * @property string $title
 * @property string $price
 * @property string $weight
 * @property int $created_at
 * @property int $updated_at
 */
class Ingredient extends ActiveRecord
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
        return 'ingredient';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['created_at', 'updated_at', 'type'], 'integer'],
            [['title', 'price'], 'required'],
            [['price'], 'number'],
            [['title'], 'string', 'max' => 255],
            [['weight'], 'string', 'max' => 50],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'type' => 'Категория',
            'title' => 'Название',
            'price' => 'Цена',
            'weight' => 'Вес',
            'created_at' => 'Создано',
            'updated_at' => 'Обновлено',
        ];
    }

    public function categoryList()
    {
        return [
            1 => 'Овощи, грибы, зелень, орехи',
            2 => 'Сыры',
            3 => 'Мясо и морепродукты',
            4 => 'Масло',
        ];
    }

    public static function getAll()
    {
        return self::find()->all();
    }

    public static function generateOil($all)
    {
        $html = '<div>';
        $html .= '<div class="oil">Масло</div>';
        $i = 0;
        foreach ($all as $ingredient)
        {
            if($ingredient->type === 4)
            {
                $html .= '<div class="oil-row">';
                if($i === 0) {
                    $html .= '<input checked="checked" type="radio" name="ingredients['.$ingredient->id.']" id="oil'.($i+1).'">';
                } else {
                    $html .= '<input type="radio" name="ingredients['.$ingredient->id.']" id="oil'.($i+1).'">';
                }
                $html .= '<label for="oil'.($i+1).'">'.$ingredient->title.'</label>';
                $html .= '</div>';
                $i++;
            }
        }
        $html .= '</div>';

        return $html;
    }

    public static function generateGreen($all)
    {
        $html = '<div class="dop-title">Дополнительные ингредиенты</div>';
        $html .= '<div class="row dopToggle">';
        $html .= '<div class="col-sm-6">';
        $html .= '<div class="dop-veget">Овощи, грибы, зелень, орехи</div>';
        $i = 0;
        foreach ($all as $ingredient)
        {
            if($ingredient->type === 1)
            {
                $html .= '<div class="frm-row">';
                $html .= '<input type="checkbox" name="ingredients['.$ingredient->id.']" id="add'.$i.'">';
                $html .= '<label for="add'.$i.'">'.$ingredient->title.' '.$ingredient->weight.'</label>';
                $html .= '<div class="add_price">+ '.$ingredient->price.' руб</div>';
                $html .= '</div>';
                $i++;
            }

        }
        $html .= '</div>';
        return $html;
    }
    public static function generateCheese($all) {
        $html = '<div class="col-sm-6">';
        $html .= '<div class="dop-cheese">Сыры</div>';
        $i = 0;
        foreach ($all as $ingredient)
        {
            if($ingredient->type === 2)
            {
                $html .= '<div class="frm-row">';
                $html .= '<input type="checkbox" name="ingredients['.$ingredient->id.']" id="add0'.$i.'">';
                $html .= '<label for="add0'.$i.'">'.$ingredient->title.' '.$ingredient->weight.'</label>';
                $html .= '<div class="add_price">+ '.$ingredient->price.' руб</div>';
                $html .= '</div>';
                $i++;
            }

        }
        return $html;
    }
    public static function generateMeet($all) {
        $html = '<div class="dop-meat">Мясо и морепродукты</div>';
        $i = 0;
        foreach ($all as $ingredient)
        {
            if($ingredient->type === 3)
            {
                $html .= '<div class="frm-row">';
                $html .= '<input type="checkbox" name="ingredients['.$ingredient->id.']" id="add00'.$i.'">';
                $html .= '<label for="add00'.$i.'">'.$ingredient->title.' '.$ingredient->weight.'</label>';
                $html .= '<div class="add_price">+ '.$ingredient->price.' руб</div>';
                $html .= '</div>';
                $i++;
            }

        }
        $html .= '</div>';
        $html .= '</div>';
        return $html;
    }

    public static function generateHtml()
    {
        $all = self::getAll();
        $html = self::generateOil($all) . self::generateGreen($all) . self::generateCheese($all) . self::generateMeet($all);

        return $html;
    }
}
