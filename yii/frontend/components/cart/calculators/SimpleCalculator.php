<?php
namespace frontend\components\cart\calculators;

use devanych\cart\calculators\CalculatorInterface;
use frontend\components\cart\models\CartItem;

class SimpleCalculator implements CalculatorInterface
{
    /**
     * @param CartItem[] $items
     * @return integer
     */
    public function getCost(array $items)
    {
        $cost = 0;
        foreach ($items as $item) {
            $cost += $item->getCost();
        }
        return $cost;
    }

    /**
     * @param CartItem[] $items
     * @return integer
     */
    public function getCount(array $items)
    {
        return count($items);
    }
}