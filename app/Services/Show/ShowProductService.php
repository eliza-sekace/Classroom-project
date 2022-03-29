<?php

namespace App\Services\Show;


use App\Models\Product;
use App\Repositories\Products\PdoProductRepository;
use App\Repositories\Products\ProductRepository;

class ShowProductService
{
    private ProductRepository $productRepository;

    public function __construct()
    {
        $this->productRepository = new PdoProductRepository();
    }

    public function execute(ShowProductRequest $request): Product
    {
        $result = $this->productRepository;
        $productId = $result->getById($request->getProductId());

        return $productId;
    }

}






