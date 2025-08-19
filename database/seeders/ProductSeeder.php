<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
            Product::create([
            'user_id' => '1',
            'category_id' => '1',
            'name' => 'Product Name',
            'description' => 'This is a test product',
            'price' => '19.99',
            'size' => 'M',
            'image' => 'products_images/sample.jpg',
            'qty' => '1',
            'approval_status' => 'approved',
            'segment_id' =>'1',
            'status' => 'available',
            'barangay_id' => '1', 
            ]);
    }
}
