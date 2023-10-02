<?php

namespace Database\Seeders;

use App\Models\Type_pet;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TypePetSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Type_pet::create([
            'name' => fake()->name,
            'slug' => fake()->slug,
        ]);
        $faker = Faker::create();
        $data = [];
        for ($i=0; $i < 10; $i++) {
            $data['name'] = $faker->name;
            $data['slug'] = $faker->slug;
            Type_pet::insert($data);
        }

    }
}
