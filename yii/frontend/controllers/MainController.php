<?php

namespace frontend\controllers;

use common\models\Config;
use Yii;
use frontend\models\CallForm;

class MainController extends \yii\web\Controller
{
    /**
     * @var CallForm
     */
    public $callForm;

    public function beforeAction($action)
    {
        if (!parent::beforeAction($action)) {
            return false;
        }

        $data = Config::find()->where(['id' => 1])->asArray()->one();

        $cart = Yii::$app->session->get('cart-data');

        if(!$cart) {
            $cart['amount'] = (float) 0.00;
            $cart['products'] = [];
            Yii::$app->session->set('cart-data', $cart);
        }

        $this->callForm = new CallForm();
        $this->view->params['callForm'] = $this->callForm;
        $this->view->params['addTitle'] = 'Доставка итальянской пиццы Cheese Knock';
        $this->view->params['cart'] = $cart;
        $this->view->params['cart-test'] = Yii::$app->cart;
        $this->view->params['config'] = $data;

        return true; // or false to not run the action
    }

}
