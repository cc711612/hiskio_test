<?php
/**
 * @Author: Roy
 * @DateTime: 2023/2/7 下午 10:32
 */

namespace App\Libraries;

class Cart
{
    protected $items = [];

    public function addItem(Item $item): void
    {
        $this->items[$item->id] = $item;
    }

    public function removeItem(Item $item): void
    {
        $key = array_search($item, $this->items);
        unset($this->items[$key]);
    }

    public function updateQuantity(Item $item, $quantity): void
    {
        $item->quantity = $quantity;
        $item->removeDiscount();
        if (is_null($item->discount) === false) {
            $item->setDiscount($item->discount);
        }
    }

    public function getItems(): array
    {
        return $this->items;
    }

    public function getCount(): int
    {
        return count($this->items);
    }

    public function getTotal(): int
    {
        $total = 0;
        foreach ($this->items as $item) {
            $total += $item->total;
        }
        return $total;
    }

    public function setItemDiscount(Item $item, Discount $discount): void
    {
        $item->setDiscount($discount);
    }

    public function removeItemDiscount(Item $item): void
    {
        $item->removeDiscount();
    }
}
