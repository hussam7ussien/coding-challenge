<?php

namespace App\Domains\Stock;
use App\Domains\Stock\ProductRepository;
use App\Domains\Stock\IngredientRepository;

class StockService
{

    public function __construct(
        ProductRepository $product_repository,
        IngredientRepository $ingredient_repository,
    )
    {
        $this->product_repository = $product_repository;
        $this->ingredient_repository = $ingredient_repository;
    }


    private function getProductIngredients($product){
        return $this->product_repository->getIngredientsFor($product);
    }

    private function takeIngredientFromStock($ingredient,$quantity){
        
        $new_stock = $ingredient['available_stock'] - ($ingredient['pivot']['quantity'] * $quantity);
        if( ($new_stock/$ingredient['max_available_stock']) < $ingredient['min_stock_level']){
            //todo::Send alert
        }
        $this->ingredient_repository->update_quantity($ingredient['id'],$new_stock);
    }

    public function processOrderLine($product_id,$quantity){
        $product = $this->product_repository->find($product_id);
        $ingredients = $this->getProductIngredients($product);
        foreach($ingredients as $key => $ingredient){
            $this->takeIngredientFromStock($ingredient,$quantity);
        }
    }
}