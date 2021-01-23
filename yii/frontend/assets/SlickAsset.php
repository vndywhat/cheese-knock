<?php

namespace frontend\assets;

use yii\web\AssetBundle;

/**
 * Slick-JS asset
 */
class SlickAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'css/slick/slick.css',
        'css/slick/slick-theme.css',
    ];
    public $js = [
        'js/slick/slick.min.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
    ];
}
