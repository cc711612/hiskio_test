<?php
/**
 * @Author: Roy
 * @DateTime: 2023/2/8 下午 09:49
 */


use Tests\TestCase;
use App\Libraries\Item;
use App\Libraries\Discount;
use App\Libraries\Cart;

class CartTest extends TestCase
{

    public function test_init_cart_success()
    {
        $cart = $this->getCart();
        $this->assertTrue(true);
    }

    public function test_calculate_cart_success()
    {
        $cart = $this->getCart();
        $item1 = new Item(1, "item 1", 100, 2);
        $item2 = new Item(2, "item 2", 200, 1);
        $cart->addItem($item1);
        $cart->addItem($item2);
        $this->assertEquals($cart->getTotal(), $item1->getTotal() + $item2->getTotal());
        $this->assertEquals($cart->getCount(), 2);
    }

    public function test_calculate_remove_item1_cart_success()
    {
        $cart = $this->getCart();
        $item1 = new Item(1, "item 1", 100, 2);
        $item2 = new Item(2, "item 2", 200, 1);
        $cart->addItem($item1);
        $cart->addItem($item2);
        $this->assertEquals($cart->getTotal(), $item1->getTotal() + $item2->getTotal());
        $this->assertEquals($cart->getCount(), 2);
        $cart->removeItem($item1);
        $this->assertEquals($cart->getTotal(), $item2->getTotal());
        $this->assertEquals($cart->getCount(), 1);
    }

    public function test_calculate_update_quantity_item_cart_success()
    {
        $cart = $this->getCart();
        $item = new Item(1, "item 1", 100, 2);
        $cart->addItem($item);
        $this->assertEquals($cart->getTotal(), $item->getTotal());
        $this->assertEquals($cart->getCount(), 1);
        $cart->updateQuantity($item, 2);
        $this->assertEquals($item->getQuantity(), 2);
        $this->assertEquals($cart->getTotal(), $item->getPrice() * $item->getQuantity());
    }

    public function test_calculate_add_amount_discount_cart_success()
    {
        $cart = $this->getCart();
        $item = new Item(1, "item 1", 100, 2);
        $cart->addItem($item);
        $this->assertEquals($cart->getTotal(), $item->getTotal());
        $this->assertEquals($cart->getCount(), 1);
        $discount = new Discount("優惠折扣10元", 10, Discount::DISCOUNT_TYPE_AMOUNT);
        $cart->setItemDiscount($item, $discount);
        $this->assertEquals($item->getTotal(), $item->getPrice() * $item->getQuantity() - 10);
    }

    public function test_calculate_add_percentage_discount_cart_success()
    {
        $cart = $this->getCart();
        $item = new Item(1, "item 1", 100, 2);
        $cart->addItem($item);
        $this->assertEquals($cart->getTotal(), $item->getTotal());
        $this->assertEquals($cart->getCount(), 1);
        $discount = new Discount("優惠八五折", 0.85, Discount::DISCOUNT_TYPE_PERCENTAGE);
        $cart->setItemDiscount($item, $discount);
        $this->assertEquals($item->getTotal(), $item->getPrice() * $item->getQuantity() * 0.85);
    }

    private function getCart(): Cart
    {
        return app(Cart::class);
    }
}
