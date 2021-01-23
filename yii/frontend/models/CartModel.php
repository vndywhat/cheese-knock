<?php

namespace frontend\models;

use common\models\Ingredient;
use common\models\Product;
use Yii;
use yii\base\Model;
use yii\helpers\Html;
use yii\helpers\Url;

class CartModel extends Model
{

    public static function addItem(int $product_id, array $ingredients, int $num)
    {
        /**
         * @var $product Product
         */
        if($product = Product::find()->where(['id' => $product_id])->one()) {
            $cart = Yii::$app->session->get('cart-data');

            $additional = 0.00;
            $info = '';

            foreach ($ingredients['oil'] as $o => $choose) {
                if(isset(self::$oil[$o])) $info .= 'Масло: '.self::$oil[$o].'; ';
            }

            if(count($ingredients['green']) > 0) {
                $info .= 'Овощи, грибы, зелень, орехи: ';
                foreach ($ingredients['green'] as $g => $value) {
                    if(isset(self::$green[$g])) {
                        $info .= self::$green[$g]['title'].'; ';
                        $additional = $additional + (float) self::$green[$g]['price'];
                    } else {
                        $info .= '---; ';
                    }

                }
            }

            if(count($ingredients['cheese']) > 0) {
                $info .= 'Сыры: ';
                foreach ($ingredients['cheese'] as $ch => $item) {
                    if(isset(self::$cheese[$ch])) {
                        $info .= self::$cheese[$ch]['title'].'; ';
                        $additional = $additional + (float) self::$cheese[$ch]['price'];
                    } else {
                        $info .= '---; ';
                    }

                }
            }

            if(count($ingredients['meat']) > 0) {
                $info .= 'Мясо и морепродукты: ';
                foreach ($ingredients['meat'] as $m => $it) {
                    if(isset(self::$meat[$m])) {
                        $info .= self::$meat[$m]['title'].'; ';
                        $additional = $additional + (float) self::$meat[$m]['price'];
                    } else {
                        $info .= '---; ';
                    }

                }
            }

            $price = (float) round($num * ((float) $product->price + $additional), 2);

            $order = [
                'product_id' => $product_id,
                'ingredients' => $ingredients,
                'info' => $info,
                'num' => $num,
                'price' => (float) $price,
            ];

            if(count($cart['products']) > 0) {
                $addToCart = true;
                foreach ($cart['products'] as  $p => $val)
                {
                    if($cart['products'][$p]['product_id'] === $order['product_id'] && $cart['products'][$p]['ingredients'] === $order['ingredients']) {
                        $addToCart = false;
                        $cart['products'][$p]['num'] = $cart['products'][$p]['num'] + $order['num'];
                        $cart['products'][$p]['price'] = round($cart['products'][$p]['price'] + (float) $order['price'], 2);
                    } else {
                        $addToCart = true;
                    }
                }
                if($addToCart) $cart['products'][] = $order;
                $cart['amount'] = (float) round($cart['amount'] + (float) $order['price'], 2);
            } else {
                $cart['products'][] = $order;
                $cart['amount'] = (float) round($cart['amount'] + (float) $order['price'], 2);
            }

            Yii::$app->session->set('cart-data', $cart);

            return true;
        } else {
            return false;
        }
    }

    public static function removeItem(string $key)
    {
        $cart = Yii::$app->cart;

        $items = $cart->getItems();

        if(count($items) < 1) {
            return false;
        }

        if(isset($items[$key])) {
            $removedItems[$key] = $items[$key];
            //Yii::$app->session->set('removed-items', $removedItems);
            $cart->remove($key);
        } else {
            return false;
        }

        return true;
    }

    public static function clear()
    {
        $cart = Yii::$app->cart;

        $cart->clear();

        return true;
    }

    public static function restoreItem(string $id)
    {
        $cart = Yii::$app->cart;

        $cart->restoreItem($id);

        return true;
    }

    public static function buildCart()
    {
        $cart = Yii::$app->cart->getItems();

        if(!empty($cart)) {
            $html = self::buildTable();
        } else {
            $html = self::buildEmptyCart();
        }

        return $html;
    }

    public static function buildEmptyCart()
    {
        $html = '<div class="woocommerce-notices-wrapper"></div>';
        $html .= '
            <p class="cart-empty">Ваша корзина пока пуста.</p>	
            <p class="return-to-shop">
                '.Html::a('Вернуться в магазин', ['/category/all'], ['class' => 'button wc-backward']).'
	        </p>';

        return $html;
    }

    public static function buildTable()
    {
        $cart = Yii::$app->cart;

        $html = '<div class="woocommerce-notices-wrapper"></div>';
        $html .= '<table class="shop_table shop_table_responsive cart woocommerce-cart-form__contents" cellspacing="0">';
            $html .= '<thead>';
                $html .= '<tr>';
                    $html .= '<th class="product-remove">&nbsp;</th>';
                     $html .= '<th class="product-thumbnail">&nbsp;</th>';
                     $html .= '<th class="product-name">Товар</th>';
                     $html .= '<th class="product-price">Цена</th>';
                     $html .= '<th class="product-quantity">Количество</th>';
                     $html .= '<th class="product-subtotal">Итого</th>';
                $html .= '</tr>';
            $html .= '</thead>';
            $html .= '<tbody>';
                $html .= self::getTable();
            $html .= '</tbody>';
        $html .= '</table>';
        $html .= '<div class="cart-collaterals" style="float: right; width: auto;">';
            $html .= '<div class="cart_totals ">';
                $html .= '<h2>Сумма заказов</h2>';
                $html .= '<table cellspacing="0" class="shop_table shop_table_responsive">';
                $html .= '<tbody>';
                    $html .= '<tr class="cart-subtotal">';
                        $html .= '<th>Подытог</th>';
                        $html .= '<td data-title="Подытог">';
                            $html .= '<span class="woocommerce-Price-amount amount"><span id="price-total">'.$cart->getTotalCost().'</span><span class="woocommerce-Price-currencySymbol">₽</span></span>';
                        $html .= '</td>';
                    $html .= '</tr>';
                $html .= '</tbody>';
                $html .= '</table>';
                $html .= '<div class="wc-proceed-to-checkout">';
                        $html .= Html::a('Оформить заказ', ['/cart/checkout'], ['class' => 'checkout-button button alt wc-forward']);
                $html .= '</div>';
            $html .= '</div>';
        $html .= '</div>';
        return $html;
    }

    public static function getTable()
    {
        $cartItems = Yii::$app->cart->getItems();

        $itemHtml = '';

        foreach ($cartItems as $item)
        {

            $itemHtml .= '<tr id="cart-item-'.$item->getId().'" class="woocommerce-cart-form__cart-item cart_item">';
            $itemHtml .= '<td class="product-remove">';
            $itemHtml .= '<a href="#" onclick="removeItem(\''.$item->getId().'\'); return false;" class="remove" aria-label="Удалить эту позицию">×</a>';
            $itemHtml .= '</td>';
            $itemHtml .= '<td class="product-thumbnail">';
            $itemHtml .= '<a href="/product/'.$item->getProduct()->slug.'">';
            $itemHtml .= '<img width="300" height="300" src="'.$item->getProduct()->getThumb().'" class="attachment-woocommerce_thumbnail size-woocommerce_thumbnail" alt="">';
            $itemHtml .= '</a>';
            $itemHtml .= '</td>';
            $itemHtml .= '<td class="product-name" data-title="Товар"> ';
            $itemHtml .= Html::a($item->getProduct()->title, ['/product/view', 'slug' => $item->getProduct()->slug]);
            $itemHtml .= '<span> × '.$item->getQuantity().'</span>';
            $itemHtml .= '</td>';
            $itemHtml .= '<td class="product-price" data-title="Цена">';
            $itemHtml .= self::getIngredients($item->getIngredients(), $item->getId());
            $itemHtml .= '</td>';
            $itemHtml .= '<td class="product-quantity" data-title="Количество">';
            $itemHtml .= '<span class="text-center">';
            $itemHtml .= Html::a('+', '#', [
                'class' => 'plus',
                'onclick' => 'changeItem(\''.$item->getId().'\', 1); return false;',
            ]);
            $itemHtml .= Html::a('-', '#', [
                'class' => 'minus',
                'onclick' => 'changeItem(\''.$item->getId().'\', 0); return false;',
            ]);
            $itemHtml .= '</span>';
            $itemHtml .= '</td>';
            $itemHtml .= '<td class="product-subtotal" data-title="Итого">';
            $itemHtml .= '<span class="woocommerce-Price-amount amount"> '.$item->getCost().'<span class="woocommerce-Price-currencySymbol">₽</span></span>';
            $itemHtml .= '</td>';
            $itemHtml .= '</tr>';
        }

        return $itemHtml;
    }

    public static function getIngredients($ingredients, $key = null)
    {
        if(count($ingredients) > 0) {
            $ingredientsHtml = '<dl class="variation"><table class="wdm_options_table"><tbody>';

            foreach ($ingredients as $ingredient)
            {
                if($ingredient->type === 4) {
                    $ingredientsHtml .= '<tr><td> Масло: '.mb_strtolower($ingredient->title).'</td></tr>';
                } else {
                    if(!is_null($key)) {
                        $ingredientsHtml .= "<tr id='k".$key."_i".$ingredient->id."'><td> ".$ingredient->title." ".$ingredient->weight." <div class='btn-group'><a class='remove' onclick=\"removeIngredient('".$key."', '".$ingredient->id."'); return false;\" href='#'>×</a></div></td></tr>";
                    } else {
                        $ingredientsHtml .= '<tr><td> '.$ingredient->title.' '.$ingredient->weight.'</td></tr>';
                    }
                }
            }
            $ingredientsHtml .= '</tbody></table></dl>';

            return $ingredientsHtml;
        }

        return '';
    }

    public static function getOrderReview()
    {
        $cart = Yii::$app->cart;

        $orderReview = '<table class="shop_table woocommerce-checkout-review-order-table">';
        $orderReview .= '<thead>';
        $orderReview .= '<tr>';
        $orderReview .= '<th class="product-name">Товар</th>';
        $orderReview .= '<th class="product-total">Итого</th>';
        $orderReview .= '</tr>';
        $orderReview .= '</thead>';
        $orderReview .= '<tbody>';
        foreach ($cart->getItems() as $item)
        {
            $orderReview .= '<tr class="cart_item">';
            $orderReview .= '<td class="product-name">';
            $orderReview .= $item->getProduct()->title;
            $orderReview .= self::getIngredients($item->getIngredients());
            $orderReview .= '</td>';
            $orderReview .= '<td class="product-total">';
            $orderReview .= '<span class="woocommerce-Price-amount amount">'.$item->getCost();
            $orderReview .= '<span class="woocommerce-Price-currencySymbol">₽</span>';
            $orderReview .= '</span>';
            $orderReview .= '</td>';
            $orderReview .= '</tr>';
        }
        $orderReview .= '</tbody>';
        $orderReview .= '<tfoot>';
        $orderReview .= '<tr class="cart-subtotal">';
        $orderReview .= '<th>Подытог</th>';
        $orderReview .= '<td>';
        $orderReview .= '<span class="woocommerce-Price-amount amount">'.$cart->getTotalCost();
        $orderReview .= '<span class="woocommerce-Price-currencySymbol">₽</span>';
        $orderReview .= '</span>';
        $orderReview .= '</td>';
        $orderReview .= '</tr>';
        $orderReview .= '<tr class="shipping">';
        $orderReview .= '<th>Доставка</th>';
        $orderReview .= '<td data-title="Доставка">';
        $orderReview .= 'Доставка по Омску';
        $orderReview .= '<input type="hidden" name="shipping_method[0]" data-index="0"
                                       id="shipping_method_0" value="flat_rate:1"
                                       class="shipping_method"
                                >';
        $orderReview .= '</td>';
        $orderReview .= '</tr>';
        $orderReview .= '<tr class="order-total">';
        $orderReview .= '<th>Итого</th>';
        $orderReview .= '<td>';
        $orderReview .= '<strong>';
        $orderReview .= '<span class="woocommerce-Price-amount amount">'.$cart->getTotalCost();
        $orderReview .= '<span class="woocommerce-Price-currencySymbol">₽</span>';
        $orderReview .= '</span>';
        $orderReview .= '</strong>';
        $orderReview .= '</td>';
        $orderReview .= '</tr>';
        $orderReview .= '</tfoot>';
        $orderReview .= '</table>';

        return $orderReview;
    }

    public static function changeQuantity($mode, $key)
    {
        Yii::$app->cart->change($key, 1, $mode);

        return true;

    }

    /**
     * @param Product $product
     * @param $ingredients
     * @param $num
     * @return string
     */
    public static function buildReview(Product $product, $ingredients, $num)
    {
        $price = $product->price;
        $additionalCount = 0;
        $ingredientsHtml = '';
        $hiddenForm = '';
        $html = '<div class="col-sm-12">';
            $html .= '<div class="col-sm-6">';
                $html .= '<div class="text-center">';
                    $html .= "<a href='".Url::to(['/product/view', 'slug' => $product->slug])."'>";
                        $html .= '<img alt="Product Image" class="rounded img-thumbnail"
                                         src="'.$product->getThumb().'">';
                    $html .= '</a>';
                $html .= '</div>';
            $html .= '</div>';
            $html .= '<div class="col-sm-6">';
                $html .= '<div class="list-group">';
                    if(count($ingredients) > 0)
                    {
                        $ingredientsHtml .= '<a href="#" class="list-group-item list-group-item-action">';
                        $ingredientsHtml .= '<h5 class="list-group-item-heading"><b>Доп. ингредиенты:</b></h5>';
                        foreach ($ingredients as $ingredient)
                        {
                            /**
                             * @var $ingredient Ingredient
                             */
                            if($ingredient->type === 4)
                            {
                                $html .= '<a href="#" class="list-group-item list-group-item-action">';
                                $html .= '<h5 class="list-group-item-heading"><b>Масло:</b></h5>';
                                $html .= '<p class="list-group-item-text text-muted">'.mb_strtolower($ingredient->title).'</p>';
                                $html .= '</a>';
                            }
                            else
                            {
                                $additionalCount++;
                                $ingredientsHtml .= '<p class="list-group-item-text text-muted">'.$ingredient->title.' <span class="pull-right"><i>+ '.$ingredient->price.' р.</i></span></p>';
                            }
                            $price += $ingredient->price;
                            $hiddenForm .= '<input type="checkbox" checked name="ingredients['.$ingredient->id.']">';
                        }
                        $ingredientsHtml .= '</a>';
                    }
                    if($product->composition)
                    {
                        $html .= '<a href="#" class="list-group-item list-group-item-action">';
                            $html .= '<h5 class="list-group-item-heading"><b>Состав:</b></h5>';
                            $html .= '<p class="list-group-item-text text-muted">'.$product->composition.'</p>';
                        $html .= '</a>';
                    }

                    if($additionalCount > 0)
                    {
                        $html .= $ingredientsHtml;
                    } else {
                        if(!$product->is_drink)
                        {
                            $html .= '<a href="#" class="list-group-item list-group-item-action">';
                                $html .= '<h5 class="list-group-item-heading"><b>Доп. ингредиенты:</b></h5>';
                                $html .= '<p class="list-group-item-text text-muted">не выбраны</p>';
                            $html .= '</a>';
                        }
                    }
                    $html .= '<a href="#" class="list-group-item list-group-item-action">';
                        $html .= '<h5 class="list-group-item-heading"><b>Кол-во:</b></h5>';
                        $html .= '<p class="list-group-item-text text-muted">'.$num.' шт.</p>';
                    $html .= '</a>';
                $html .= '</div>';
            $html .= '</div>';
        $html .= '</div>';
        $html .= '<div class="col-sm-12">';
            $html .= '<div class="list-group pull-right">';
                $html .= '<a href="#" class="list-group-item list-group-item-action">';
                    $html .= '<h5 class="list-group-item-heading"><b>Итого:</b></h5>';
                    $html .= '<p class="list-group-item-text text-muted">'.ceil($price * $num).' Р</p>';
                $html .= '</a>';
            $html .= '</div>';
        $html .= '</div>';

        $form = '<form action="/cart/add" method="post" id="formPopup" class="hidden">';
        $form .= Html::hiddenInput(Yii::$app->getRequest()->csrfParam, Yii::$app->getRequest()->getCsrfToken(), []);
        $form .= Html::hiddenInput('product_id', $product->id, []);
        $form .= $hiddenForm;
        $form .= Html::hiddenInput('quantity', $num, []);
        $form .= '</form>';

        return $html . $form;
    }
}