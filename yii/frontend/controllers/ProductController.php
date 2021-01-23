<?php

namespace frontend\controllers;

use common\models\Product;
use common\models\Related;
use frontend\models\CartModel;
use yii\web\NotFoundHttpException;

class ProductController extends MainController
{
    public function actionView($slug)
    {
        /*var_dump(Related::find()->with('ingredients')->all());die;*/

        $additional = new CartModel();
        $product = $this->findModelBySlug($slug);

        $this->view->registerMetaTag(['name' => 'description', 'content' => $product->meta_description]);
        $this->view->registerMetaTag(['name' => 'keywords', 'content' => $product->meta_keywords]);

        return $this->render('view', [
            'product' => $product,
            'additional' => $additional,
        ]);
    }

    public function findModelBySlug($slug)
    {
        if (($model = Product::findOne(['slug' => $slug])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('Страница не найдена.');
    }

}
