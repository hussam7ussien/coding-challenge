<?php

namespace App\Domains\Order;
use App\Domains\Order\OrderRepository;
use App\Domains\Stock\StockService;

class OrderService
{
    const USER_ID =  1;

    public function __construct(
        OrderRepository $order_repository,
        StockService $stock_service,
    )
    {
        $this->order_repository = $order_repository;
        $this->stock_service = $stock_service;
    }
    
    /**
     * Create Order
     *
     * @param  mixed $products
     * @return void
     */
    public function createOrder($products){
        $order = $this->order_repository->createOrder(self::USER_ID,$products);
        foreach ($products as $key => $product) {
            $this->stock_service->processOrderLine($product['product_id'], $product['quantity']);
            $this->order_repository->addProductsToOrder($order, $product['product_id'], $product['quantity']);
        }

        return $order;
    }

}