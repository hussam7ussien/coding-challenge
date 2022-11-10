<?php

namespace Tests\Feature;
use Tests\TestCase;
use App\Domains\Order\OrderService;

use function PHPUnit\Framework\assertTrue;

class OrderTest extends TestCase
{
    protected $payload;
    protected $order_service;
    protected $stock_service;


    public function setUp() : void
    {
        parent::setUp();
        $this->before();

    }

    private function before()
    {
        $this->order_service = app(OrderService::class);
        $this->stock_service = $this->order_service->stock_service;
        $this->order_payload = [
            'products' => [
                [
                    'product_id' => 1,
                    'quantity' => 1,
                ],
            ]

        ];
    }

    
    /**
     * Test if new order is creating
     *
     * @return void
     */
    public function test_new_order_is_creating()
    {
        $orders_count =  $this->order_service->order_repository->count();
        $this->order_service->createOrder($this->order_payload['products']);
        $this->assertDatabaseCount('orders', $orders_count+1);
    }
    
    /**
     * Test if stock is updating
     *
     * @return void
     */
    public function test_stock_is_updating()
    {
        $product = $this->stock_service->product_repository->find($this->order_payload['products'][0]['product_id']);
        $ingredients_before_order = $this->stock_service->getProductIngredients($product);
        $this->order_service->createOrder($this->order_payload['products']);
        $product = $this->stock_service->product_repository->find($this->order_payload['products'][0]['product_id']);
        $ingredients_after_order = $this->stock_service->getProductIngredients($product);
        $stock_updated_correctly = true;
        foreach($ingredients_after_order as $index => $ingredient){
            $stock_updated_correctly = $ingredient['available_stock'] == ($ingredients_before_order[$index]['available_stock'] - $ingredients_before_order[$index]['pivot']['quantity']);
            if(!$stock_updated_correctly) break;
        }
        assertTrue($stock_updated_correctly);
    }

}
