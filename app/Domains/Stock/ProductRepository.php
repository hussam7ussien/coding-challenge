<?php

namespace App\Domains\Stock;
use App\Models\Product;
class ProductRepository
{
    public function __construct(Product $model)
    {
        $this->model = $model;
    }

    public function find($id){
        return $this->model->findOrFail($id);
    }

    public function getIngredientsFor(Product $product){
        return $product->ingredients->toArray();
    }

}