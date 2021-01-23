<?php

namespace frontend\components\cart\storage;

//use devanych\cart\storage\StorageInterface;
use frontend\components\cart\Cart;
use frontend\components\cart\models\CartItem;
use Yii;

class SessionStorage implements StorageInterface
{
    /**
     * @var array $params Custom configuration params
     */
    private $params;

    public function __construct(array $params)
    {
        $this->params = $params;
    }

    /**
     * @param string $key
     * @return CartItem[]
     */
    public function load(string $key = null)
    {
        if(is_null($key)) {
            $key = $this->params['key'];
        }

        return Yii::$app->session->get($key, []);
    }

    /**
     * @param CartItem[] $items
     * @param string $key
     * @return void
     */
    public function save(array $items, string $key = null)
    {
        if(is_null($key)) {
            $key = $this->params['key'];
        }

        Yii::$app->session->set($key, $items);
    }
}