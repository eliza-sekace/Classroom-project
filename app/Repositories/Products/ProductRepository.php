<?php

namespace App\Repositories\Products;

use App\Models\Product;

interface ProductRepository
{
    public function getAll():array;
    public function getById(?int $id ):Product;

}