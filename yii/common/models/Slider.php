<?php

namespace common\models;

use backend\models\ImageUpload;
use Yii;
use yii\web\UploadedFile;

/**
 * This is the model class for table "slider".
 *
 * @property int $id
 * @property string $title
 * @property string $subtitle
 * @property int $price
 * @property string $excerpt
 * @property string $link
 * @property string $image
 * @property int $created_at
 */
class Slider extends \yii\db\ActiveRecord
{

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'slider';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title', 'created_at'], 'required'],
            [['price', 'created_at'], 'integer'],
            [['excerpt', 'link'], 'string'],
            [['title', 'subtitle'], 'string', 'max' => 255],
            [['image'], 'file', 'skipOnEmpty' => true, 'extensions' => 'png, jpg'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Заголовок',
            'subtitle' => 'Подзаголовок',
            'price' => 'Цена',
            'excerpt' => 'Отрывок',
            'link' => 'Ссылка',
            'image' => 'Изображение',
            'created_at' => 'Дата',
        ];
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
        }
    }

    public function updateImage()
    {
        $image = new ImageUpload();

        $currentImage = isset($this->oldAttributes['image']) ? $this->oldAttributes['image'] : '';

        $newImage = UploadedFile::getInstance($this, 'image');

        if(!is_null($newImage)) {
            $image->image = $newImage;
            $image->catalog = $this->getCatalog();
            $images = $image->uploadImage();

            $this->image = $images[$image->catalog][0]['image'];
        } else {
            $this->image = $currentImage;
        }
    }

    /**
     * @return string
     */
    public function getCatalog()
    {
        return 'slider';
    }

    /**
     * Возвращает путь до полного изображения
     * @return mixed
     */
    public function getImage()
    {
        return Yii::$app->storage->getFile($this->image, $this->getCatalog());
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
    }
}
