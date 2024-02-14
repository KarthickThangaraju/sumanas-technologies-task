<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Product;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $products = [
            [
                'title' => 'Allen solly', 
                'stripe_plan' => 'price_1Oj0fbSGeemnsbFl26AKvDWQ', 
                'price' => 999, 
                'description' => 'Allen solly shirts',
                'created_at' =>  now(),
                'updated_at' => now()
            ],
            [
                'title' => 'Louis philippe', 
                'stripe_plan' => 'price_1Oj0kJSGeemnsbFlWVYL9Skb', 
                'price' => 1200, 
                'description' => 'Louis Philippe shirt',
                'created_at' =>  now(),
                'updated_at' => now()
            ],
            [
                'title' => 'otto', 
                'stripe_plan' => 'price_1Oj0ksSGeemnsbFl0n4rlu4E', 
                'price' => 799, 
                'description' => 'otto shirts',
                'created_at' =>  now(),
                'updated_at' => now()
            ],
            [
                'title' => 'Indian terrain', 
                'stripe_plan' => 'price_1Oj0ljSGeemnsbFls6nMYy5G', 
                'price' => 1599, 
                'description' => 'indian terrain shirts',
                'created_at' =>  now(),
                'updated_at' => now()
            ],
            [
                'title' => 'marco polo', 
                'stripe_plan' => 'price_1Oj0m4SGeemnsbFlSR0wXKoP', 
                'price' => 899, 
                'description' => 'marco polo tshirts',
                'created_at' =>  now(),
                'updated_at' => now()
            ],
            [
                'title' => 'crocodile', 
                'stripe_plan' => 'price_1Oj0nGSGeemnsbFlC7dBMIh6', 
                'price' => 599, 
                'description' => 'crocodile t shirts',
                'created_at' =>  now(),
                'updated_at' => now()
            ]
        ];
        foreach ($products as $product) {
            Product::create($product);
        }
        // foreach ($products as $product) {
        //     DB::table('product')->insert([
        //         'title' => $product['title'],
        //         'stripe_plan' => $product['stripe_plan'],
        //         'price' =>  $product['price'],
        //         'description' => $product['description'],
        //         'created_at' =>  now(),
        //         'updated_at' => now()
        //     ]);
        // }
    }
}
