<?php
/**
 * @Author: Roy
 * @DateTime: 2023/2/7 下午 10:32
 */

namespace App\Libraries;

class Discount
{
    const DISCOUNT_TYPE_AMOUNT     = 1;
    const DISCOUNT_TYPE_PERCENTAGE = 2;

    public $name;
    public $amount;

    public function __construct(string $name, float $amount = 0, int $type = self::DISCOUNT_TYPE_AMOUNT)
    {
        $this->name = $name;
        $this->amount = $amount;
        if ($type == self::DISCOUNT_TYPE_PERCENTAGE) {
            if ($amount > 1) {
                throw new \Exception('折數優惠有誤');
            }
        }
        if ($amount < 0) {
            throw new \Exception('優惠不得為負數');
        }
        $this->type = $type;
    }
}
