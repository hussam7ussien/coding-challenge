<?php

namespace Database\Seeders;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class IngredientSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $ingredients = [
            [
                'name' => 'Beef',
                'max_available_stock' => 20000,
                'available_stock' => 20000,
                'min_stock_level' => .5
            ],
            [
                'name' => 'Cheese',
                'max_available_stock' => 5000,
                'available_stock' => 5000,
                'min_stock_level' => .5
            ],
            [
                'name' => 'Onion',
                'max_available_stock' => 1000,
                'available_stock' => 1000,
                'min_stock_level' => .5
            ],
            ];

        foreach ($ingredients as $key => $ingredient) {

            DB::table('ingredients')->insert($ingredient);
        }

    }
}
