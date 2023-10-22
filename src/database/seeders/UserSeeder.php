<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            [
                'name' => 'Pedro Almeida',
                'email' => 'jpc.almeida2@gmail.com',
                'password' => Hash::make('12345678'),
                'email_verified_at' => now(),
                'type' => 'admin',
                'created_at' => now(),
            ],
            [
                'name' => 'Almeida Pedro',
                'email' => 'almeida2@gmail.com',
                'password' => Hash::make('12345678'),
                'email_verified_at' => now(),
                'type' => 'applicant',
                'created_at' => now(),
            ],
        ]);

        User::factory()->count(38)->create();
    }
}
