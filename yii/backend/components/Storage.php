<?php


namespace backend\components;


use yii\base\Component;
use yii\helpers\FileHelper;
use yii\web\UploadedFile;

class Storage extends Component implements StorageInterface
{
    private $fileName;
    private $catalog;

    /**
     * Сохраняет файл
     * @param UploadedFile $file
     * @param string $catalog
     * @return null|string
     * @throws \yii\base\Exception
     */
    public function saveUploadedFile(UploadedFile $file, string $catalog = '')
    {
        $this->catalog = $catalog;

        $path = $this->preparePath($file);

        if($path && $file->saveAs($path)) {
            return $this->fileName;
        } else {
            return null;
        }
    }

    /**
     * Подготавливает файл к загрузке, создаёт необходимые папки, возвращает путь к файлу xx/xx/some.ext
     * @param UploadedFile $file
     * @return string
     * @throws \yii\base\Exception
     */
    protected function preparePath(UploadedFile $file)
    {
        $this->fileName = $this->getFileName($file);

        $path = $this->getStoragePath() . $this->fileName;

        $path = FileHelper::normalizePath($path);
        if(FileHelper::createDirectory(dirname($path))) {
            return $path;
        }
    }

    /**
     * Генерирует название файла в виде xx/xx/some.ext
     * @param UploadedFile $file
     * @return string
     */
    protected function getFileName(UploadedFile $file)
    {
        $hash = sha1_file($file->tempName);

        $name = substr_replace($hash, '/', 2, 0);
        $name = substr_replace($name, '/', 5, 0);

        return $name . '.' . $file->extension;
    }

    protected function getStoragePath()
    {
        return \Yii::getAlias(\Yii::$app->params['storagePath']) . $this->getCatalog();
    }

    protected function getStorageUri()
    {
        return \Yii::getAlias(\Yii::$app->params['storageUri']);
    }

    protected function getCatalog()
    {
        $catalog = '';

        switch ($this->catalog)
        {
            case 'categories':
                $catalog = 'categories/';
                break;

            case 'products':
                $catalog = 'products/';
                break;

            case 'slider':
                $catalog = 'slider/';
                break;
        }
        return $catalog;
    }

    public function getFile(string $filename, string $catalog = '')
    {
        $this->catalog = $catalog;
        return $this->getStorageUri() . $this->getCatalog() . $filename;
    }

}