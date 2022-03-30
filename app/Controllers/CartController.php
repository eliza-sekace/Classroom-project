<?php

namespace App\Controllers;

use App\Models\Item;
use App\Redirect;
use App\Repositories\Products\PdoProductRepository;
use App\Services\CartService;
use App\Views\View;

class CartController
{

    public function show()
    {
        $service = new CartService();
        return new View("cart.html", [
            'cart' => $service->getCart()
        ]);
    }

    public function add($vars)
    {
        $repository = new PdoProductRepository();
        $product = $repository->getById($vars['id']);

//        $cart = $_SESSION['cart'] ?? [];
        $item = new Item($product, $_POST['amount']);

        $service = new CartService();
        $service->add($item);
        return new Redirect("/products/{$vars['id']}");
    }
}