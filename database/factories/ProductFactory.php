<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Category;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->word(), // Tên sản phẩm ngẫu nhiên
            'description' => fake()->sentence(), // Mô tả sản phẩm là một câu ngẫu nhiên
            'image' => fake()->imageUrl(640, 480, 'products', true), // URL hình ảnh ngẫu nhiên
            'price' => fake()->randomFloat(2, 1, 1000), // Giá ngẫu nhiên từ 1 đến 1000, có 2 chữ số thập phân
            'quantity' => fake()->numberBetween(1, 100), // Số lượng ngẫu nhiên từ 1 đến 100
            'view' => fake()->numberBetween(0, 1000), // Lượt xem ngẫu nhiên từ 0 đến 1000
            'status' => fake()->randomElement(['available', 'out of stock', 'discontinued']), // Trạng thái sản phẩm ngẫu nhiên
            'category_id' => Category::factory(),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}