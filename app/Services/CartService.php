<?php

namespace App\Services;

use App\Models\Cart;
use App\Models\Item;

class CartService
{
    private Cart  $cart;

    public function __construct()
    {
        $this->cart = $_SESSION['cart'] ?? new Cart();
    }

    public function add(Item $item)
    {
        // check if amount is in inventory

        // if differs, reset amount un item

        // save new cart to session
        $this->cart->add($item);

        $_SESSION['cart'] = $this->cart;
    }

    public function getCart(): Cart
    {
        return $this->cart;
    }
}