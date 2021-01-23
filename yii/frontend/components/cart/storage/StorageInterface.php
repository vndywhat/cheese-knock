<?php
namespace frontend\components\cart\storage;

interface StorageInterface
{
    /**
     * @param array $params (configuration params)
     */
    public function __construct(array $params);
    /**
     * @param $key
     * @return \frontend\components\cart\models\CartItem[]
     */
    public function load(string $key);
    /**
     * @param \frontend\components\cart\models\CartItem[] $items
     * @param $key
     */
    public function save(array $items, string $key);
}