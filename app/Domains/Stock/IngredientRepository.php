<?php

namespace App\Domains\Stock;
use App\Models\Ingredient;
class IngredientRepository
{
    public function __construct(Ingredient $model)
    {
        $this->model = $model;
    }

    public function update_quantity($id,$quantity){
        $this->model::where('id', $id)
        ->update(['available_stock' => $quantity]);
    }

}