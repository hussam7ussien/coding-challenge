<?php

namespace App\Domains\Order;
use App\Models\Order;
class OrderRepository
{
    public function __construct(Order $model)
    {
        $this->model = $model;
    }
    
    /**
     * Create Order
     *
     * @param  mixed $user_id
     * @return void
     */
    public function createOrder($user_id){
        return $this->model->create([
            'user_id' => $user_id
        ]);
    }
    
    /**
     * add Products To Order
     *
     * @param  mixed $order
     * @param  mixed $product_id
     * @param  mixed $quantity
     * @return void
     */
    public function addProductsToOrder($order, $product_id, $quantity){
        $order->products()->attach($product_id,['quantity' => $quantity]); 
    }

    public function count(){
        return $this->model->count();
    }

}