<?php

namespace common\models;

use backend\components\SlugBehavior;
use backend\models\ImageUpload;
use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\web\UploadedFile;

/**
 * This is the model class for table "product".
 *
 * @property int $id
 * @property int $category_id
 * @property string $title
 * @property string $description
 * @property string $composition
 * @property string $size
 * @property string $weight
 * @property string $price
 * @property string $image
 * @property string $thumbnail
 * @property string $slug
 * @property int $have_related
 * @property int $is_drink
 * @property int $is_new
 * @property string $meta_description
 * @property string $meta_keywords
 * @property int $sales_count
 * @property int $created_at
 * @property int $updated_at
 */
class Product extends ActiveRecord
{
    public function behaviors()
    {
        return [
            'slug' => [
                'class' => SlugBehavior::class,
                'attribute' => 'title',
                'slugAttribute' => 'slug',
                'ensureUnique' => true,
            ],
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
        return 'product';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['category_id', 'have_related', 'is_drink', 'is_new', 'sales_count', 'created_at', 'updated_at'], 'integer'],
            [['title', 'price'], 'required'],
            [['description'], 'string'],
            [['price'], 'number'],
            [['title', 'composition', 'size', 'weight', 'image', 'slug'], 'string', 'max' => 255],
            [['meta_description', 'meta_keywords'], 'string', 'max' => 50],
            [['image'], 'file', 'skipOnEmpty' => true, 'extensions' => 'png, jpg'],
            [['slug'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'category_id' => 'Категория',
            'title' => 'Название',
            'description' => 'Описание',
            'composition' => 'Состав',
            'size' => 'Размер',
            'weight' => 'Вес',
            'price' => 'Цена',
            'image' => 'Изображение',
            'slug' => 'ЧПУ',
            'have_related' => 'Показывать блок «Дополнительные ингридиенты?»',
            'is_drink' => 'Напиток?',
            'is_new' => 'Новинка?',
            'sales_count' => 'Количество продаж',
            'meta_description' => 'Мета-описание',
            'meta_keywords' => 'Ключевые слова',
            'created_at' => 'Создано',
            'updated_at' => 'Обновлено',
        ];
    }

    public function getCategories()
    {
        $categories = Category::find()->all();

        $arr[0] = 'Без категории';
        foreach ($categories as $category) {
            $arr[$category->id] = $category->title;
        }

        return $arr;
    }

    /**
     * Возвращает родительскую категорию
     */
    public function getCategory() {
        // связь таблицы БД `product` с таблицей `category`
        return $this->hasOne(Category::class, ['id' => 'category_id']);
    }

    public function setImage()
    {
        $image = new ImageUpload();

        $newImage = UploadedFile::getInstance($this, 'image');

        if(!is_null($newImage)) {
            $image->image = $newImage;
            $image->catalog = $this->getCatalog();
            $images = $image->uploadImage();

            $this->image = $images[$image->catalog][0]['image'];
            $this->thumbnail = $images[$image->catalog][1]['thumbnail'];
        }
    }

    public function updateImage()
    {
        $image = new ImageUpload();

        $currentImage = ($this->oldAttributes['image']) ? $this->oldAttributes['image'] : '';
        $currentThumb = ($this->oldAttributes['thumbnail']) ? $this->oldAttributes['thumbnail'] : '';

        $newImage = UploadedFile::getInstance($this, 'image');

        if(!is_null($newImage)) {
            $image->image = $newImage;
            $image->catalog = $this->getCatalog();
            $images = $image->uploadImage();

            $this->image = $images[$image->catalog][0]['image'];
            $this->thumbnail = $images[$image->catalog][1]['thumbnail'];
        } else {
            $this->image = $currentImage;
            $this->thumbnail = $currentThumb;
        }
    }

    /**
     * @return string
     */
    public function getCatalog()
    {
        return 'products';
    }

    /**
     * Возвращает путь до полного изображения
     * @return mixed
     */
    public function getImage()
    {
        if($this->image) {
            return Yii::$app->storage->getFile($this->image, $this->getCatalog());
        } else {
            return Yii::$app->storage->getFile('no-image.png');
        }

    }

    /**
     * Возвращает путь до уменьшенного изображения
     * @return mixed
     */
    public function getThumb()
    {
        if($this->thumbnail) {
            return Yii::$app->storage->getFile($this->thumbnail, $this->getCatalog());
        } else {
            return Yii::$app->storage->getFile('no-image.png');
        }
    }

    public function deleteImages()
    {
        if($this->image)
        {
            $imagePath = ImageUpload::getStoragePath($this->getCatalog()) . $this->image;
            if(file_exists($imagePath))
                unlink(ImageUpload::getStoragePath($this->getCatalog()) . $this->image);
            unset($imagePath);

        }

        if($this->thumbnail)
        {
            $thumbPath = ImageUpload::getStoragePath($this->getCatalog()) . $this->thumbnail;
            if(file_exists($thumbPath))
                unlink($thumbPath);
            unset($thumbPath);
        }
    }

    public function getSizeWeight()
    {
        $text = '';

        if(!empty($this->size))
        {
            if(!empty($this->weight))
            {
                $text = $this->size . ' / ' . $this->weight;
            }
            else
            {
                $text = $this->size;
            }
        }
        if(!empty($this->weight))
        {
            if(!empty($this->size))
            {
                $text = $this->size . ' / ' . $this->weight;
            }
            else
            {
                $text = $this->weight;
            }
        }

        return $text;
    }

    public function updateCountSales()
    {
        $this->sales_count = OrderItem::find()->where(['product_id' => $this->id])->count();
        return $this->sales_count;
    }

    public static function hits()
    {
        return self::find()->orderBy(['sales_count' => SORT_DESC])->limit(4)->all();
    }

    public function getDrinks()
    {
        return self::find()->where(['category_id' => '5'])->orderBy(['sales_count' => SORT_DESC])->limit(4)->all();
    }

    public function getPizzas()
    {
        return self::find()->where(['category_id' => '1'])->orderBy(['sales_count' => SORT_DESC])->limit(4)->all();
    }
}
