<?php

namespace Database\Seeders;

use App\Models\Type_pet;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
class TypePetSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();
        $data = [];
        for ($i=0; $i < 10; $i++) {
            $data['name'] = $faker->name;
            $data['slug'] = $faker->slug;
            Type_pet::insert($data);
        }

    }
}
