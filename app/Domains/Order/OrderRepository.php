<?php

namespace App\Domains\Order;
use App\Models\Order;
class OrderRepository
{
    public function __construct(Order $model)
    {
        $this->model = $model;
    }

    public function createOrder($user_id,$products){
        $order = $this->model->create([
            'user_id' => $user_id
        ]);

        foreach($products as $key => $product){
            $order->products()->attach($product['product_id'],['quantity' => $product['quantity']]); 
        }

        return $order->toArray();
        
    }

}