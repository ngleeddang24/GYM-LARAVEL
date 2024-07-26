<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Product;
use Faker\Factory as Faker;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Sử dụng Faker để tạo dữ liệu ngẫu nhiên
        $faker = Faker::create();

        // Tạo 20 sản phẩm ngẫu nhiên
        for ($i = 0; $i < 20; $i++) {
            Product::create([
                'name' => $faker->sentence(3),
                'img' => $faker->imageUrl(),
                'description' => $faker->paragraph(4),
                'price' => $faker->randomFloat(2, 10, 100),
                'quantity' => $faker->numberBetween(1, 100),
                'category_id' => $faker->numberBetween(1, 2), // Giả sử có 5 danh mục
            ]);
        }
    }
}
