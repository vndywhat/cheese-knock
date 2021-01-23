<?php

namespace frontend\components\cart;

use frontend\components\cart\models\CartItem;
use yii\base\BaseObject;
use yii\base\InvalidConfigException;

class Cart extends BaseObject
{
    /**
     * @var string $storageClass
     */
    public $storageClass = 'frontend\components\cart\storage\SessionStorage';

    /**
     * @var string $calculatorClass
     */
    public $calculatorClass = 'frontend\components\cart\calculators\SimpleCalculator';

    /**
     * @var array $params Custom configuration params
     */
    public $params = [];

    /**
     * @var array $defaultParams
     */
    private $defaultParams = [
        'key' => 'cart',
        'expire' => 604800,
        'productClass' => 'app\model\Product',
        'productFieldId' => 'id',
        'productFieldPrice' => 'price',
    ];

    /**
     * @var \frontend\components\cart\models\CartItem[]
     */
    private $items;

    /**
     * @var \frontend\components\cart\models\CartItem[]
     */
    private $removed;

    /**
     * @var \frontend\components\cart\storage\StorageInterface
     */
    private $storage;

    /**
     * @var \devanych\cart\calculators\CalculatorInterface
     */
    private $calculator;

    /**
     * @inheritdoc
     * @throws InvalidConfigException
     */
    public function init()
    {
        parent::init();

        $this->params = array_merge($this->defaultParams, $this->params);

        if (!class_exists($this->params['productClass'])) {
            throw new InvalidConfigException('productClass `' . $this->params['productClass'] . '` not found');
        }
        if (!class_exists($this->storageClass)) {
            throw new InvalidConfigException('storageClass `' . $this->storageClass . '` not found');
        }
        if (!class_exists($this->calculatorClass)) {
            throw new InvalidConfigException('calculatorClass `' . $this->calculatorClass . '` not found');
        }

        $this->storage = new $this->storageClass($this->params);
        $this->calculator = new $this->calculatorClass();
    }

    private function generateKey($product, $ingredients) {
        if(!is_null($ingredients)) {
            $ingredientsIds = [];
            foreach ($ingredients as $ingredient) {
                $ingredientsIds[] = $ingredient->id;
            }
            ksort($ingredientsIds, SORT_NUMERIC);
            $key = sha1(serialize($product) . serialize($ingredientsIds));
        } else {
            $key = sha1(serialize($product));
        }

        return $key;
    }

    public function getHashCart()
    {
        $this->loadItems();
        return sha1(serialize($this->items) . time());
    }

    /**
     * Add an item to the cart
     * @param object $product
     * @param integer $quantity
     * @param array $ingredients
     * @return void
     */
    public function add($product, $quantity, $ingredients = null)
    {
        $this->loadItems();
        $key = $this->generateKey($product, $ingredients);

        if (isset($this->items[$key])) {
            $this->plus($key, $quantity);
        } else {
            $this->items[$key] = new CartItem($product, $ingredients, $quantity, $this->params);
            ksort($this->items, SORT_STRING);
            $this->saveItems();
        }
    }

    /**
     * Adding item quantity in the cart
     * @param string $id
     * @param integer $quantity
     * @return void
     */
    public function plus($id, $quantity)
    {
        $this->loadItems();
        if (isset($this->items[$id])) {
            $this->items[$id]->setQuantity($quantity + $this->items[$id]->getQuantity());
        }
        $this->saveItems();
    }

    /**
     * Removing item quantity in the cart
     * @param string $id
     * @param integer $quantity
     * @return void
     */
    public function minus($id, $quantity)
    {
        $this->loadItems();
        if (isset($this->items[$id])) {
            if(($this->items[$id]->getQuantity() - $quantity) <= 0) {
                $this->remove($id);
            } else {
                $this->items[$id]->setQuantity($this->items[$id]->getQuantity() - $quantity);
            }
        }
        $this->saveItems();
    }

    /**
     * Change item quantity in the cart
     * @param string $id
     * @param integer $quantity
     * @return void
     */
    public function change($id, $quantity)
    {
        $this->loadItems();
        if (array_key_exists($id, $this->items)) {
            $this->items[$id]->setQuantity($quantity);
        }
        $this->saveItems();
    }

    /**
     * Removes an items from the cart
     * @param string $id
     * @return void
     */
    public function remove($id)
    {
        $this->loadItems();
        if (array_key_exists($id, $this->items)) {
            $this->addRemoved($id);
            unset($this->items[$id]);
        }
        $this->saveItems();
    }

    private function addRemoved($id)
    {
        $this->removed[$id] = $this->getItem($id);
        $this->saveItems();
    }

    public function restoreItem($id)
    {
        $this->loadItems();
        if (array_key_exists($id, $this->removed)) {
            $this->add($this->removed[$id]->getProduct(), $this->removed[$id]->getQuantity(), $this->removed[$id]->getIngredients());
            $this->clearRemoved();
        }
        $this->saveItems();
    }

    private function clearRemoved()
    {
        $this->removed = [];
        $this->saveItems();
    }

    /**
     * Removes an item ingredient from the cart
     * @param string $key
     * @param int $ingredientId
     * @return bool
     */
    public function removeIngredient($key, $ingredientId)
    {
        $this->loadItems();
        if (array_key_exists($key, $this->items)) {
            $this->items[$key]->removeIngredient($ingredientId);
            $this->changeHash($key);
        }
        $this->saveItems();
        return true;
    }

    /**
     * Removes all items from the cart
     * @return void
     */
    public function clear()
    {
        $this->items = [];
        $this->saveItems();
    }

    /**
     * Returns all items from the cart
     * @return CartItem[]
     */
    public function getItems()
    {
        $this->loadItems();
        return $this->items;
    }

    /**
     * Returns an item from the cart
     * @param integer $id
     * @return CartItem
     */
    public function getItem($id)
    {
        $this->loadItems();
        return isset($this->items[$id]) ? $this->items[$id] : null;
    }

    private function getRemovedItem($id)
    {
        $this->loadItems();
        return isset($this->removed[$id]) ? $this->removed[$id] : null;
    }

    /**
     * Returns ids array all items from the cart
     * @return array
     */
    public function getItemIds()
    {
        $this->loadItems();
        $items = [];
        foreach ($this->items as $item) {
            $items[] = $item->getId();
        }
        return $items;
    }

    /**
     * Returns total cost all items from the cart
     * @return integer
     */
    public function getTotalCost()
    {
        $this->loadItems();
        return $this->calculator->getCost($this->items);
    }

    /**
     * Returns total count all items from the cart
     * @return integer
     */
    public function getTotalCount()
    {
        $this->loadItems();
        return $this->calculator->getCount($this->items);
    }

    /**
     * Load all items from the cart
     * @return void
     */
    private function loadItems()
    {
        if ($this->items === null) {
            $this->items = $this->storage->load($this->params['key']);
            $this->removed = $this->storage->load('removed');
        }
    }

    /**
     * Save all items to the cart
     * @return void
     */
    private function saveItems()
    {
        $this->storage->save($this->items, $this->params['key']);
        if ($this->removed === null) {
            $this->storage->save([], 'removed');
        } else {
            $this->storage->save($this->removed, 'removed');
        }
    }

    private function changeHash($key) {
        $this->loadItems();
        if(array_key_exists($key, $this->items)) {
            $oldData = $this->items[$key];
            $newKey = $this->items[$key]->getId();
            if(array_key_exists($newKey, $this->items)) {
                $this->plus($newKey, $oldData->getQuantity());
            } else {
                $this->items[$newKey] = $oldData;
            }
            unset($this->items[$key]);

        }
        $this->saveItems();
    }
}
