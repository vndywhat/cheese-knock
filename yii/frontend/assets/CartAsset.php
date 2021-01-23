<?php

namespace frontend\assets;

use yii\web\AssetBundle;

/**
 * Cart asset
 */
class CartAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        /*'css/cart.css',*/
        /*'css/checkout.css',*/
    ];
    public $js = [
        'js/cart.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
    ];
}
