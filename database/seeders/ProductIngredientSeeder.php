<?php

namespace Database\Seeders;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class ProductIngredientSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('ingredient_product')->insert([
            'product_id' => 1,
            'ingredient_id' => 1,
            'quantity' => 150
        ]);

        DB::table('ingredient_product')->insert([
            'product_id' => 1,
            'ingredient_id' => 2,
            'quantity' => 30
        ]);

        DB::table('ingredient_product')->insert([
            'product_id' => 1,
            'ingredient_id' => 3,
            'quantity' => 20
        ]);
    }
}
