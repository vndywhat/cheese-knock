<?php

namespace frontend\assets;

use yii\web\AssetBundle;

/**
 * Main frontend application asset bundle.
 */
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        //'css/bootstrap.min.css',
        'css/cart.css',
        'css/style.css',
        'css/checkout.css',
        'css/responsive.css',
       'css/menu.css',
        '//cdnjs.cloudflare.com/ajax/libs/jquery-jgrowl/1.4.1/jquery.jgrowl.min.css',
    ];
    public $js = [
        //'js/bootstrap.min.js',
        'js/jquery.mask.js',
        'js/custom.js',
        'js/menu.js',
        'js/ppm-plugin.js',
        '//cdnjs.cloudflare.com/ajax/libs/jquery-jgrowl/1.4.1/jquery.jgrowl.min.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapPluginAsset',
    ];
}
