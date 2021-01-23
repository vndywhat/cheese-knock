<?php

namespace frontend\components\cart\models;

class CartItem
{
    /**
     * @var object $product
     */
    public $product;
    /**
     * @var object $ingredients
     */
    public $ingredients;
    /**
     * @var integer $quantity
     */
    public $quantity;
    /**
     * @var array $params Custom configuration params
     */
    private $params;

    public function __construct($product, $ingredients, $quantity, array $params)
    {
        $this->product = $product;
        $this->ingredients = $ingredients;
        $this->quantity = $quantity;
        $this->params = $params;
    }

    /**
     * Returns the id of the item
     * @return string
     */
    public function getId()
    {
        if(!is_null($this->ingredients)) {
            $ingredientsIds = [];
            foreach ($this->ingredients as $ingredient) {
                $ingredientsIds[] = $ingredient->id;
            }
            ksort($ingredientsIds, SORT_NUMERIC);
            return sha1(serialize($this->product) . serialize($ingredientsIds));
        } else {
            return sha1(serialize($this->product));
        }

    }

    /**
     * Returns the price of the item
     * @return integer|float
     */
    public function getPrice()
    {
        $price = $this->product->{$this->params['productFieldPrice']};

        if(!is_null($this->ingredients)) {
            foreach ($this->ingredients as $ingredient)
            {
                $price = $price + $ingredient->price;
            }
        }

        return $price;
    }

    /**
     * Returns the product, AR model
     * @return object
     */
    public function getProduct()
    {
        return $this->product;
    }

    /**
     * Returns the ingredients, AR model
     * @return object
     */
    public function getIngredients()
    {
        return $this->ingredients;
    }

    /**
     * Returns the cost of the item
     * @return integer|float
     */
    public function getCost()
    {
        return ceil($this->getPrice() * $this->quantity);
    }

    /**
     * Returns the quantity of the item
     * @return integer
     */
    public function getQuantity()
    {
        return $this->quantity;
    }

    /**
     * Sets the quantity of the item
     * @param integer $quantity
     * @return void
     */
    public function setQuantity($quantity)
    {
        $this->quantity = $quantity;
    }

    /**
     * Delete ingredient from item
     * @param integer $ingredientId
     * @return void
     */
    public function removeIngredient($ingredientId)
    {
        $ingredients = $this->getIngredients();
        foreach ($ingredients as $i => $ingredient)
        {
            if($ingredient->id === $ingredientId) unset($ingredients[$i]);
        }
        $this->ingredients = $ingredients;
    }
}