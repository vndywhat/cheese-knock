<?php

namespace common\models;

use backend\components\SlugBehavior;
use backend\models\ImageUpload;
use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;
use yii\web\UploadedFile;

/**
 * This is the model class for table "category".
 *
 * @property int $id
 * @property int $parent_id
 * @property string $title
 * @property string $description
 * @property string $keywords
 * @property string $meta_description
 * @property string $slug
 * @property string $image
 * @property string $thumbnail
 * @property int $created_at
 * @property int $updated_at
 */
class Category extends ActiveRecord
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
        return 'category';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['parent_id', 'created_at', 'updated_at',], 'integer'],
            [['title'], 'required'],
            [['title', 'description', 'keywords', 'meta_description', 'slug'], 'string', 'max' => 255],
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
            'parent_id' => 'Родительская категория',
            'title' => 'Название категории',
            'description' => 'Описание категории',
            'image' => 'Изображение',
            'keywords' => 'Мета-тег keywords',
            'meta_description' => 'Мета-тег description',
            'slug' => 'ЧПУ',
        ];
    }

    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)) {

            if(!$this->parent_id || $this->id === $this->parent_id) $this->parent_id = 0;
            return true;
        }

        return false;

    }
    /**
     * Возвращает родительскую категорию
     */
    public function getParent() {
        return $this->hasOne(self::class, ['id' => 'parent_id']);
    }

    /**
     * Возвращает дочерние категории
     */
    public function getChildren() {
        return $this->hasMany(self::class, ['parent_id' => 'id']);
    }

    /**
     * Возвращает товары категории
     */
    public function getProducts() {
        // связь таблицы БД `category` с таблицей `product`
        return $this->hasMany(Product::class, ['category_id' => 'id'])->orderBy(['id' => SORT_DESC]);
    }

    public static function getAllCategories()
    {
        return self::find()->where(['parent_id' => 0])->all();
    }

    public function getCategoriesDropDownList()
    {
        $arr = [];
        $arr[0] = 'Нет родительской категории';
        $categories = self::getAllCategories();

        foreach ($categories as $category) {
            if($this->id !== $category->id) {
                $arr[$category->id] = $category->title;
            }
        }

        return $arr;
    }

    public static function findBySlug($slug)
    {
        return self::findOne(['slug' => $slug]);
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
        return 'categories';
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
}
