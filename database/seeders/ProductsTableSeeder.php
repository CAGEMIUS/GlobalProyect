<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Product::create([
            'name' => 'Sabor Original',
            'slug' => 'sabor-original',
            'details' => '600 ml',
            'price' => 15900,
            'shipping_cost' => 10500,
            'description' => 'Sabor Original Coca-Cola',
            'category_id' => 1,
            'brand_id' => 1,
            'stock'=> 100,
            'image_path' => 'Compra1.png'
        ]);

        Product::create([
            'name' => 'Almendras',
            'slug' => 'almendras',
            'details' => '946 ml',
            'price' => 17999,
            'shipping_cost' => 12500,
            'description' => 'Leche de Almedras',
            'category_id' => 1,
            'brand_id' => 2,
            'stock'=> 150,
            'image_path' => 'Compra2.png'
        ]);

        Product::create([
            'name' => 'Coca-Cola Sin Azucar',
            'slug' => 'coca-cola-sin-azucar',
            'details' => '400 ml',
            'price' => 9599,
            'shipping_cost' => 7500,
            'description' => 'Coca-Cola Sin Azucar',
            'category_id' => 2,
            'brand_id' => 1,
            'stock'=> 280,
            'image_path' => 'Compra3.png'
        ]);

        Product::create([
            'name' => 'Jugo Piña y Mandarina',
            'slug' => 'jugo-piña-y-mandarina',
            'details' => '500 ml',
            'price' => 14500,
            'shipping_cost' => 10799,
            'description' => 'Jugo Piña y Mandarina',
            'category_id' => 3,
            'brand_id' => 3,
            'stock'=> 39,
            'image_path' => 'Compra4.png'
        ]);

        Product::create([
            'name' => 'Agua Mineral',
            'slug' => 'agua-mineral',
            'details' => '500 ml',
            'price' => 14500,
            'shipping_cost' => 10799,
            'description' => 'Agua Mineral',
            'category_id' => 4,
            'brand_id' => 4,
            'stock'=> 67,
            'image_path' => 'Compra5.png'
        ]);

        Product::create([
            'name' => 'Gaseosa Quatro',
            'slug' => 'gaseosa-quatro',
            'details' => '350 ml',
            'price' => 18599,
            'shipping_cost' => 9500,
            'description' => 'Gaseosa Quatro',
            'category_id' => 5,
            'brand_id' => 4,
            'stock'=> 85,
            'image_path' => 'Compra6.png'
        ]);

        Product::create([
            'name' => 'Gaseosa Quatro',
            'slug' => 'gaseosa-quatro',
            'details' => '350 ml',
            'price' => 18599,
            'shipping_cost' => 9500,
            'description' => 'Gaseosa Quatro',
            'category_id' => 5,
            'brand_id' => 4,
            'stock'=> 85,
            'image_path' => 'Compra6.png'
        ]);
    }
}
