<?php

namespace App\Domains\Order;
use App\Domains\Order\OrderRepository;

class OrderService
{
    const USER_ID =  1;

    public function __construct(OrderRepository $order_repository)
    {
        $this->order_repository = $order_repository;
    }

    public function createOrder($products){
        return  $this->order_repository->createOrder(self::USER_ID,$products);
    }

}