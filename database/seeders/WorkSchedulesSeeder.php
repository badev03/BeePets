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
            'day_of_week' => 'Thứ 2', 'word_shift' => 1, 'day' => '2023-10-03', 'start_time' => '9:00:00', 'end_time' => '11:00:00',
            'doctor_id' => 1,
        ];
        $data1= [
            'day_of_week' => 'Thứ 3', 'word_shift' => 2, 'day' => '2023-10-03', 'start_time' => '11:00:00', 'end_time' => '13:00:00',
            'doctor_id' => 1,
        ];
        $data2= [
            'day_of_week' => 'Thứ 4', 'word_shift' => 3, 'day' => '2023-10-03', 'start_time' => '13:00:00', 'end_time' => '15:00:00',
            'doctor_id' => 1,
        ];
        $data3= [
            'day_of_week' => 'Thứ 2', 'word_shift' => 3, 'day' => '2023-10-03', 'start_time' => '11:00:00', 'end_time' => '13:00:00',
            'doctor_id' => 1,
        ];
        $data4= [
            'day_of_week' => 'Thứ 2', 'word_shift' => 3, 'day' => '2023-10-03', 'start_time' => '13:00:00', 'end_time' => '15:00:00',
            'doctor_id' => 1,
        ];
        Work_schedule::insert([$data , $data1 , $data2 , $data3, $data4]);
    }
}
