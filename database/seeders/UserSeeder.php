<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserSeeder extends Seeder
{
    public function run()
    {
        
        User::create([
            'name' => 'Admin',
            'email' => 'boghtml@gmail.com',
            'password' => Hash::make('1234567890HTML'), 
            'role' => 'admin', 
        ]);

        User::create([
            'name' => 'Adnrii',
            'email' => 'viewer@gmail.com',
            'password' => Hash::make('1234567890HTML'), 
            'role' => 'viewer',
        ]);
    }
}
