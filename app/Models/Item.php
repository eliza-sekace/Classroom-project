<?php
namespace App\Models;

class Item
{
    private Product $product;
    private int $amount;

    public function __construct($product, $amount)
    {
        $this->product = $product;
        $this->amount = $amount;
    }

    public function getProduct(): Product
    {
        return $this->product;
    }

    public function getAmount(): int
    {
        return $this->amount;
    }

    public function setAmount(int $amount): void
    {
        $this->amount = $amount;
    }

    public function getSum(): float
    {
        return $this->product->getPrice() * $this->amount;
    }

    public function getInfo(): string
    {
        return "{$this->product->getTitle()} | Price per unit: {$this->product->getPrice()} | Amount: {$this->amount} | Total: {$this->getSum()}$";
    }
}