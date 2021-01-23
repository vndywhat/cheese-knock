<?php
namespace frontend\controllers;

use common\models\Ingredient;
use common\models\Order;
use common\models\Product;
use frontend\models\CartModel;
use Yii;
use yii\db\ActiveRecord;
use yii\web\Response;

class CartController extends MainController
{
    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionCheckout()
    {
        $cart = Yii::$app->cart;

        if($cart->getTotalCost() <= 0) {
            return $this->redirect(['/cart/index']);
        }

        $model = new Order();

        if($model->load(Yii::$app->request->post()))
        {
            $model->status = 0;
            if($model->validate())
            {
                if($model->delivery_type === '0' && !$model->address)
                {
                    $model->pick_zone = 3;
                    $model->addError('address', 'Необходимо заполнить «Адрес»');
                    return $this->render('checkout', [
                        'cart' => $cart,
                        'model' => $model,
                    ]);
                }
                $model->hash = Yii::$app->cart->getHashCart();
                $model->insert();
                $model->addItems($cart);
                CartModel::clear();
                Yii::$app->session->set('success', $model);
                return $this->redirect(['/cart/success', 'hash' => $model->hash]);
            } else {
                return $this->render('checkout', [
                    'cart' => $cart,
                    'model' => $model,
                ]);
            }

        }

        return $this->render('checkout', [
            'cart' => $cart,
            'model' => $model,
        ]);
    }

    public function actionSuccess($hash)
    {
        if($model = Order::find()->where(['hash' => $hash])->limit(1)->one()) {
            return $this->render('success', [
                'model' => $model,
            ]);
        } else {
            return $this->redirect(['/category/all']);
        }
    }

    public function actionReview()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        if(Yii::$app->request->isAjax){
            $product_id = (int) Yii::$app->request->post('product_id');
            $product = $this->getProduct($product_id);
            if(!empty(Yii::$app->request->post('ingredients'))) {
                $ingredientsIds = array_keys(Yii::$app->request->post('ingredients'));
                $ingredients = $this->getIngredients($ingredientsIds);
            } else {
                $ingredients = [];
            }

            $num = (int) Yii::$app->request->post('quantity');

            $html = CartModel::buildReview($product, $ingredients, $num);

            return ['success' => true, 'html' => $html];
        }
        return ['success' => false];
    }

    public function actionAdd()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;

        if(Yii::$app->request->isAjax)
        {
            $product_id = (int) Yii::$app->request->post('product_id');
            $product = $this->getProduct($product_id);
            if(!empty(Yii::$app->request->post('ingredients'))) {
                $ingredientsIds = array_keys(Yii::$app->request->post('ingredients'));
                $ingredients = $this->getIngredients($ingredientsIds);
            } else {
                $ingredients = [];
            }

            $num = (int) Yii::$app->request->post('quantity');

            Yii::$app->cart->add($product, $num, $ingredients);

            return ['success' => true, 'message' => 'Товар успешно добавлен в корзину', 'amount' => Yii::$app->cart->getTotalCost(), 'count' => Yii::$app->cart->getTotalCount()];
        }

        return ['success' => false];

    }

    public function actionRemove()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        if(Yii::$app->request->isAjax)
        {
            $cart = Yii::$app->cart;
            $removeId = (string) Yii::$app->request->post('id');

            $product = Product::find()->where(['id' => $cart->getItem($removeId)->getProduct()->id])->limit(1)->one();

            if(CartModel::removeItem($removeId)) {
                $cart = Yii::$app->cart;
                $message = '<div class="woocommerce-message">“'.$product->title.'” удален. <a onclick="restoreItem(\''.$removeId.'\'); return false;" href="#" class="restore-item">Отменить?</a></div>';
                $html = CartModel::buildCart();
                return ['success' => true, 'id' => $removeId, 'amount' => $cart->getTotalCost(), 'count' => $cart->getTotalCount(), 'message' => $message, 'html' => $html];
            }
            else
            {
                return ['success' => false];
            }
        }
        return ['success' => false];
    }

    public function actionRemoveIngredient()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        if(Yii::$app->request->isAjax)
        {
            $cart = Yii::$app->cart;
            $key = (string) Yii::$app->request->post('key');
            $removeId = (int) Yii::$app->request->post('id');

            if($cart->removeIngredient($key, $removeId)) {
                $cart = Yii::$app->cart;
                $html = CartModel::buildCart();
                return ['success' => true, 'key' => $key, 'id' => $removeId, 'amount' => (float) $cart->getTotalCost(), 'count' => $cart->getTotalCount(), 'html' => $html];
            }
            else
            {
                return ['success' => false];
            }
        }
        return ['success' => false];
    }

    public function actionClear()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        if(Yii::$app->request->isAjax)
        {
            Yii::$app->cart->clear();

            return ['success' => true, 'amount' => Yii::$app->cart->getTotalCost(), 'count' => Yii::$app->cart->getTotalCount()];
        }
        return ['success' => false];
    }

    public function actionRestoreItem()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        if(Yii::$app->request->isAjax) {
            $restoreId = (string) Yii::$app->request->post('id');
            if(CartModel::restoreItem($restoreId)) {
                $cart = Yii::$app->cart;
                $html = CartModel::buildCart();
                return ['success' => true, 'amount' => (float) $cart->getTotalCost(), 'count' => $cart->getTotalCount(), 'html' => $html];
            } else {
                return ['success' => false];
            }

        }
        return ['success' => false];
    }

    public function actionChangeQuantity()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        if(Yii::$app->request->isAjax) {
            $mode = Yii::$app->request->post('mode');
            $itemId = (string) Yii::$app->request->post('id');
            if($mode) {
                Yii::$app->cart->plus($itemId, 1);
            } else {
                Yii::$app->cart->minus($itemId, 1);
            }
            $cart = Yii::$app->cart;
            $html = CartModel::buildCart();
            return ['success' => true, 'amount' => (float) $cart->getTotalCost(), 'count' => $cart->getTotalCount(), 'html' => $html];

        }
        return ['success' => false];
    }

    /**
     * @param integer $id
     * @return Product the loaded model
     * @throws \DomainException if the product cannot be found
     */
    private function getProduct($id)
    {
        if (($product = Product::findOne((int)$id)) !== null) {
            return $product;
        }
        throw new \DomainException('Товар не найден');
    }

    /**
     * @param array $ids
     * @return array|ActiveRecord
     * @throws \DomainException if the product cannot be found
     */
    private function getIngredients($ids)
    {
        if (($ingredients = Ingredient::find()->where(['id' => $ids])->orderBy(['id' => SORT_DESC])->all()) !== null) {
            return $ingredients;
        }
        throw new \DomainException('Товар не найден');
    }
}