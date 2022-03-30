<?php

namespace App\Models;

class Cart
{
    private array $items;

    public function __construct(array $items = [])
    {
        $this->items = $items;
    }

    public function add(Item $item): void
    {
        foreach ($this->items as $cartItem) {
            if ($cartItem->getProduct()->getId() === $item->getProduct()->getId()) {
                $amount = $cartItem->getAmount() + $item->getAmount();
                $cartItem->setAmount($amount);
                return;
            }
        }
        $this->items[] = $item;
    }

    public function getTotal(): float
    {
        $total = 0;

        foreach ($this->items as $item) {
            $total += $item->getSum();
        }

        return $total;
    }

    public function all(): array
    {
        return $this->items;
    }
}