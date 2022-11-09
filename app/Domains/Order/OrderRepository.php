<?php

namespace App\Domains\Order;
use App\Models\Order;
class OrderRepository
{
    public function __construct(Order $model)
    {
        $this->model = $model;
    }

    public function createOrder($user_id){
        return $this->model->create([
            'user_id' => $user_id
        ]);
    }

    public function addProductsToOrder($order, $product_id, $quantity){
        $order->products()->attach($product_id,['quantity' => $quantity]); 
    }

}