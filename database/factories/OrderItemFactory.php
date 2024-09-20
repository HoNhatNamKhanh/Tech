<?php

namespace Database\Factories;

use App\Models\Product;
use App\Models\Order;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\OrderItem>
 */
class OrderItemFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'price' => fake()->randomFloat(2, 1, 1000), // Giá ngẫu nhiên từ 1 đến 1000, có 2 chữ số thập phân
            'quantity' => fake()->numberBetween(1, 100), // Số lượng ngẫu nhiên từ 1 đến 100
            'order_id' => Order::factory(),
            'product_id' => Product::factory(),

            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}