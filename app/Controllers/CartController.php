<?php
namespace App\Controllers;

use App\Views\View;

class CartController
{
    public function show()
    {
        return new View("cart.html");
    }

    public function add()
    {

    }
}