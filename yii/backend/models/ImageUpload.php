<?php


namespace backend\models;

use Imagine\Image\Box;
use Yii;
use yii\base\Model;
use yii\imagine\Image;
use yii\web\UploadedFile;

class ImageUpload extends Model
{
    /**
     * @var $image UploadedFile
     */
    public $image;

    /**
     * @var $catalog ['categories', 'products', 'slider']
     */
    public $catalog;

    public $response;

    /**
     * @return bool|string
     */
    public function uploadImage()
    {
        if(is_null($this->image) || empty($this->catalog)) {
            return false;
        }

        $fileName = Yii::$app->storage->saveUploadedFile($this->image, $this->catalog);

        if(!is_null($fileName)) {
            if($this->catalog === 'slider') {
                $this->resizeSlider($fileName);
            } else {
                $this->resizeImage($fileName);
                $this->thumbnail($fileName);
            }

            unlink($this->getDir() . $fileName);

            return $this->response;
        }

        return false;
    }

    protected function getDir()
    {
        return Yii::getAlias(Yii::$app->params['storagePath']) . $this->catalog . '/';
    }

    protected function resizeSlider(string $fileName)
    {
        $image = Image::getImagine()->open($this->getDir() . $fileName);
        $fileName = explode('.', $fileName);
        $saveName = $fileName[0] . '_original';
        $saveExt = '.' . $fileName[1];
        $image->resize(new Box(1024, 457))->save($this->getDir() . $saveName . $saveExt, ['quality' => 90]);

        $this->response[$this->catalog][] = ['image' => $saveName . $saveExt];
    }

    protected function resizeImage(string $fileName)
    {
        $image = Image::getImagine()->open($this->getDir() . $fileName);
        $fileName = explode('.', $fileName);
        $saveName = $fileName[0] . '_original';
        $saveExt = '.' . $fileName[1];

        $image->resize(new Box(1024, 1024))->save($this->getDir() . $saveName . $saveExt, ['quality' => 90]);

        $this->response[$this->catalog][] = ['image' => $saveName . $saveExt];
    }

    protected function thumbnail(string $fileName)
    {
        $image = Image::getImagine()->open($this->getDir() . $fileName);
        $fileName = explode('.', $fileName);
        $saveName = $fileName[0] . '_thumbnail';
        $saveExt = '.' . $fileName[1];

        $image->resize(new Box(300, 300))->save($this->getDir() . $saveName . $saveExt, ['quality' => 90]);

        $this->response[$this->catalog][] = ['thumbnail' => $saveName . $saveExt];
    }

    public static function getStoragePath($catalog = '')
    {
        return Yii::getAlias(Yii::$app->params['storagePath']) . $catalog . '/';
    }

}