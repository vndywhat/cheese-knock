<?php
namespace frontend\controllers;


use common\models\Category;
use yii\web\NotFoundHttpException;

/**
 * Category controller
 */
class CategoryController extends MainController
{
    public function actionView($slug)
    {
        $category = $this->findModelBySlug($slug);
        $products = $category->products;

        $this->view->registerMetaTag(['name' => 'description', 'content' => $category->meta_description]);
        $this->view->registerMetaTag(['name' => 'keywords', 'content' => $category->keywords]);

        return $this->render('view', [
            'category' => $category,
            'products' => $products,
        ]);
    }

    public function actionAll()
    {
        $categories = Category::find()->where('thumbnail != ""')->orderBy(['id' => SORT_ASC])->with('products')->all();

        return $this->render('all', [
            'categories' => $categories,
        ]);
    }

    public function findModelBySlug($slug)
    {
        if (($model = Category::find()->where(['slug' => $slug])->orderBy(['id' => SORT_DESC])->with('products')->one()) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('Страница не найдена.');
    }
}