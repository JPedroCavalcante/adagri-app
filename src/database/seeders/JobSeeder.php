<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class JobSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('jobs')->insert([
            [
                'name' => 'Analista PHP 1',
                'salary' => 330,
                'type' => 'freelancer',
                'active' => true,
                'created_at' => now(),
            ],
            [
                'name' => 'Analista PHP 2',
                'salary' => 1230,
                'type' => 'clt',
                'active' => true,
                'created_at' => now(),
            ],
            [
                'name' => 'Analista PHP 3',
                'salary' => 51000,
                'type' => 'legal_person',
                'active' => false,
                'created_at' => now(),
            ],
        ]);
    }
}
