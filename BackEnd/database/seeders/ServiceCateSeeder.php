<?php

namespace Database\Seeders;

use App\Models\Service;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ServiceCateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\Service_categorie::factory()
        ->count(5) // Số lượng bản ghi ServiceCategorie bạn muốn tạo
        ->create();
    }
}
