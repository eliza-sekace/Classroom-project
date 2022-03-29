<?php
namespace App\Controllers;

use App\Redirect;
use App\Repositories\Products\PdoProductRepository;
use App\Services\Store\StoreProductRequest;
use App\Services\Store\StoreProductService;
use App\Views\View;

class ProductsController
{
    public function index()
    {
        $products = new PdoProductRepository();
        return new View("Products/index.html", [
            'products' => $products->getAll()
        ]);
    }

   public function show($vars)
   {
       $products = new PdoProductRepository();
       return new View("Products/show.html", [
           'product' => $products->getById($vars['id'])
       ]);
   }

    public function create($vars)
    {
        return new View("Products/create.html", [
            'inputs' => $_SESSION['inputs'] ?? [],
        ]);
    }

    public function store(): Redirect
    {
        $res = new PdoProductRepository();
        $service = new StoreProductService($res);
        $service->execute(new StoreProductRequest(
            null,
            $_POST['title'],
            $_POST['description'],
            $_POST['available'],
            $_POST['price']));

    return new Redirect('/products');
    }

}