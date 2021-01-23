<?php


namespace backend\components;

use yii\web\UploadedFile;

interface StorageInterface
{
    public function saveUploadedFile(UploadedFile $file, string $catalog);
    public function getFile(string $filename, string $catalog);

}