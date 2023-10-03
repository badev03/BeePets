<?php

namespace Database\Seeders;

use App\Models\Appointment;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
class AppointmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();
        $data = [];
        for ($i=0; $i < 10; $i++) {
            $data['description'] = $faker->text;
            $data['type_pet_id'] = 1;
            $data['service_id'] = 1;
            $data['doctor_id'] = 1;
            $data['user_id'] = 1;
            $data['status'] = 1;
            Appointment::insert($data);
        }
    }
}
