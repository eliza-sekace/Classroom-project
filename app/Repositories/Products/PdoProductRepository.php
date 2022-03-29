<?php

namespace App\Repositories\Products;

use App\Database\Connection;
use App\Models\Product;

class PdoProductRepository implements ProductRepository
{
    public function getAll(): array
    {
        $products = Connection::connect()
            ->createQueryBuilder()
            ->select('id', 'title', 'description', 'price', 'available')
            ->from('product')
            ->executeQuery()
            ->fetchAllAssociative();

        $result = [];
        foreach ($products as $product) {
            $result[] = new Product(
                $product['id'],
                $product['title'],
                $product['description'],
                $product['available'],
                $product['price']);
        }
        return $result;
    }

    public function getById(?int $id): Product
    {
        $connection = Connection::connect();
        $result = $connection
            ->createQueryBuilder()
            ->select('id', 'title', 'description', 'available', 'price')
            ->from('product')
            ->where('id = ?')
            ->setParameter(0, $id)
            ->executeQuery()
            ->fetchAssociative();

        return new Product(
            $id,
            $result['title'],
            $result['description'],
            $result['available'],
            $result['price']
        );
    }

    public function save(Product $product)
    {
        Connection::connect()
            ->insert('product', [
                'title' => $product->getTitle(),
                'description' => $product->getDescription(),
                'available' => $product->getAvailable(),
                'price' => $product->getPrice()
            ]);
    }

}


