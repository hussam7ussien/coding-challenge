<?php

namespace App\Domains\Stock;
use App\Models\Ingredient;
class IngredientRepository
{
    public function __construct(Ingredient $model)
    {
        $this->model = $model;
    }
    
    /**
     * Update Quantity
     *
     * @param  mixed $id
     * @param  mixed $quantity
     * @return void
     */
    public function updateQuantity($id,$quantity){
        $this->model::where('id', $id)
        ->update(['available_stock' => $quantity]);
    }

}