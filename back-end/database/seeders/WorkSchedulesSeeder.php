<?php

namespace Database\Seeders;

use App\Models\Work_schedule;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class WorkSchedulesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data= [
            'day_of_week' => 'Thứ 2',
            'word_shift' => 2,
            'day' => '2023-10-03',
            'start_time' => '9:00:00',
            'end_time' => '10:00:00',
            'doctor_id' => 1,
        ];
        Work_schedule::insert($data);
    }
}
