<?php

namespace App\Domains\Stock;
use App\Domains\Stock\ProductRepository;
use App\Domains\Stock\IngredientRepository;
use Mail;
/**
 * StockService
 */
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

    
    /**
     * Get Product Ingredients
     *
     * @param  mixed $product
     * @return void
     */
    private function getProductIngredients($product){
        return $this->product_repository->getIngredientsFor($product);
    }
        
    /**
     * Take Ingredient From Stock
     *
     * @param  mixed $ingredient
     * @param  mixed $quantity
     * @return void
     */
    private function takeIngredientFromStock($ingredient,$quantity){
        
        $new_stock = $ingredient['available_stock'] - ($ingredient['pivot']['quantity'] * $quantity);
        $old_stock_level = $ingredient['available_stock']/$ingredient['max_available_stock'];
        //check if alert already sent
        if($old_stock_level >= $ingredient['min_stock_level']){
            $stock_level = $new_stock/$ingredient['max_available_stock'];
            //if limit is less than minimum stock
            if( ($stock_level) < $ingredient['min_stock_level']){
                $this->sendStockAlertMail($ingredient['name'],$stock_level * 100);
            }
        }

        $this->ingredient_repository->updateQuantity($ingredient['id'],$new_stock);
    }
    
    /**
     * Process Order Line
     *
     * @param  mixed $product_id
     * @param  mixed $quantity
     * @return void
     */
    public function processOrderLine($product_id,$quantity){
        $product = $this->product_repository->find($product_id);
        $ingredients = $this->getProductIngredients($product);
        foreach($ingredients as $key => $ingredient){
            $this->takeIngredientFromStock($ingredient,$quantity);
        }
    }

    
    /**
     * Send Stock Alert Mail
     *
     * @param  mixed $ingredient_name
     * @param  mixed $level
     * @return void
     */
    private function sendStockAlertMail($ingredient_name,$level){
            $details = [
            'title' => 'Stock Alert Mail',
            'body' => "This to inform you that stock level of $ingredient_name reached $level%",
            'reciever' => 'admin@my_app.com',
            ];

            //queue email to avoid breaking the implementation
            dispatch(new \App\Jobs\SendEmailJob($details));
    }
}