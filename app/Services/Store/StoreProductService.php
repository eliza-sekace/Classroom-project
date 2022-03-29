<?php

namespace App\Services\Store;

use App\Models\Product;
use App\Repositories\Products\PdoProductRepository;
use App\Repositories\Products\ProductRepository;

class StoreProductService
{
    private ProductRepository $productRepository;

    public function __construct(ProductRepository $productRepository)
    {
     $this->productRepository = new PdoProductRepository();
    }

    public function execute(StoreProductRequest $request): Product
    {
        $id = null;
        $product = new Product(
            $request->getId(),
         //   $id,
            $request->getTitle(),
            $request->getDescription(),
            $request->getAvailable(),
            $request->getPrice()
        );
        $this->productRepository->save($product);
        return $product;
    }
}






