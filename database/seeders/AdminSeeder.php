<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Atmin Laba',
            'username' => 'atminlaba',
            'email' => 'atminlaba@example.com',
            'password' => Hash::make('password'),
            'role' => 'superadmin',
            'status' => 'active',
            'phone' => '0000000000',
        ]);
    }
}
