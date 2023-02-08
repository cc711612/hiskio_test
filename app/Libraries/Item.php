<?php
/**
 * @Author: Roy
 * @DateTime: 2023/2/7 下午 10:31
 */

namespace App\Libraries;

class Item
{
    public $id;

    public $name;
    public $price;
    public $quantity;
    public $total;
    public $discountAmount;
    public $discountTitle;

    public $discount;

    public function __construct($id, $name, $price, $quantity = 1)
    {
        $this->id = $id;
        $this->name = $name;
        $this->price = $price;
        $this->quantity = $quantity;
        $this->discountAmount = 0;
        $this->total = $price * $quantity;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getPrice()
    {
        return $this->price;
    }

    public function getQuantity()
    {
        return $this->quantity;
    }

    public function getDiscountAmount()
    {
        return $this->discountAmount;
    }

    public function getTotal()
    {
        return $this->total;
    }

    public function setDiscount(Discount $discount)
    {
        if ($this->validateDiscount() === false) {
            throw new \Exception('已使用優惠折扣，並且無法加入優惠折扣');
        }
        switch ($discount->type) {
            case Discount::DISCOUNT_TYPE_AMOUNT:
                $discount_amount = $discount->amount;
                break;
            case Discount::DISCOUNT_TYPE_PERCENTAGE:
                $discount_amount = ($this->price * $this->quantity) * (1 - $discount->amount);
                break;
            default:
                throw new \Exception('折扣類別錯誤');
        }
        $this->discount = $discount;
        $this->setDiscountAmount($discount_amount);
        $this->setDiscountTitle($discount->name);
    }

    private function setDiscountAmount($discountAmount)
    {
        $this->discountAmount = $discountAmount;
        $this->total = ($this->price * $this->quantity) - $discountAmount;
        if ($this->total < 0) {
            throw new \Exception('產品優惠完不得為負數');
        }
    }

    private function setDiscountTitle(string $title = null)
    {
        $this->discountTitle = $title;
    }

    private function validateDiscount(): bool
    {
        return is_null($this->discountTitle);
    }

    public function removeDiscount()
    {
        $this->discountAmount = 0;
        $this->discountTitle = null;
        $this->total = $this->price * $this->quantity;
    }

}
