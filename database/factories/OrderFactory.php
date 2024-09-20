<?php

namespace Database\Factories;


use Illuminate\Support\Str; // Thêm dòng này để import lớp Str
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Order>
 */
class OrderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'code' => Str::random(10), // Tạo mã ngẫu nhiên dài 10 ký tự
            'status' => fake()->randomElement(['active', 'inactive', 'pending']), // Trạng thái ngẫu nhiên
            'user_id' => User::factory(), // Tạo hoặc liên kết với user ngẫu nhiên
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}