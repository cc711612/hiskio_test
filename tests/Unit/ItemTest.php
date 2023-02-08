<?php
/**
 * @Author: Roy
 * @DateTime: 2023/2/8 下午 09:49
 */

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Support\Str;
use App\Libraries\Item;

class ItemTest extends TestCase
{

    public function test_init_item_success()
    {
        $id = rand(1, 10);
        $name = Str::random(10);
        $price = rand(10, 1000);
        $quantity = rand(1, 10);
        $item = new Item($id, $name, $price, $quantity);
        $this->assertEquals($item->getId(), $id);
        $this->assertEquals($item->getName(), $name);
        $this->assertEquals($item->getQuantity(), $quantity);
        $this->assertEquals($item->getPrice(), $price);
        $this->assertEquals($item->getDiscountAmount(), 0);
        $this->assertEquals($item->getTotal(), $price * $quantity);
    }

}
