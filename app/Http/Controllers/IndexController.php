<?php
/**
 * @Author: Roy
 * @DateTime: 2023/2/7 下午 10:34
 */

namespace App\Http\Controllers;

use App\Libraries\Item;
use App\Libraries\Cart;
use App\Libraries\Discount;

class IndexController extends \Illuminate\Routing\Controller
{
    public function index()
    {
        $cart = new Cart;

        $item1 = new Item(1, "item 1", 100);
        $item2 = new Item(2, "item 2", 200);
        $discount1 = new Discount("優惠八五折", 0.85, 2);
        $discount2 = new Discount("優惠折扣10元", 10);
        $cart->addItem($item1);
        $cart->addItem($item2);
        $cart->setItemDiscount($item1, $discount2);
        $cart->setItemDiscount($item2,$discount1);
//        dump($cart->getItems());
//        dump($cart->getTotal());
//        $cart->updateQuantity($item2,2);
//        dump($cart->getItems());
//        dump($cart->getTotal());
//        dump($cart->getTotal());
//        $items = $cart->getItems();
//        dump($items);
//        dump($cart->getTotal());
//        $cart->updateQuantity($item1, 2);
//        dump($cart->getItems());
//        dump($cart->getTotal());
        return 1;
    }
}
