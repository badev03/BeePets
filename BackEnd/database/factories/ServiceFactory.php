<?php

namespace Database\Factories;

use Arr;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Service>
 */
class ServiceFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->name(),
            'slug' => $this->faker->slug(),
            'description' => $this->faker->text(),
            'price' => $this->faker->numberBetween(10, 1000),
            'ser_image' => $this->faker->imageUrl(),
            'service_categorie_id' => function () {
                $randomServiceCategorie = \App\Models\Service_categorie::inRandomOrder()->first();

                // Kiểm tra xem có ServiceCategorie nào không
                if ($randomServiceCategorie) {
                    return $randomServiceCategorie->id;
                }
            
                // Nếu không có bản ghi ServiceCategorie, trả về một giá trị mặc định hoặc xử lý khác
                return null;
            },
        ];
    }
}
