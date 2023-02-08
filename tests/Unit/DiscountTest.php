<?php
/**
 * @Author: Roy
 * @DateTime: 2023/2/8 下午 09:49
 */


use Tests\TestCase;
use Illuminate\Support\Str;
use App\Libraries\Discount;

class DiscountTest extends TestCase
{
    public function test_init_discount_amount_success()
    {
        $name = Str::random(10);
        $amount = rand(10, 100);
        $type = Discount::DISCOUNT_TYPE_AMOUNT;
        $discount = new Discount($name, $amount, $type);
        $this->assertEquals($discount->name, $name);
        $this->assertEquals($discount->amount, $amount);
        $this->assertEquals($discount->type, $type);
    }

    public function test_init_discount_percentage_success()
    {
        $name = Str::random(10);
        $amount = 0.85;
        $type = Discount::DISCOUNT_TYPE_PERCENTAGE;
        $discount = new Discount($name, $amount, $type);
        $this->assertEquals($discount->name, $name);
        $this->assertEquals($discount->amount, $amount);
        $this->assertEquals($discount->type, $type);
    }
}
