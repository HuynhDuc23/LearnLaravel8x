<?php

namespace Database\Seeders;

use App\Models\Data as ModelsData;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class Data extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ModelsData::factory()->count(5)->hasRoles(rand(1, 3))->create();
    }
}
