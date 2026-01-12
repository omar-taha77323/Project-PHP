<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class SuperAdminSeeder extends Seeder
{
    public function run()
    {
        User::updateOrCreate(
            ['email' => 'omar@gmail.com'], // غيّر الإيميل
            [
                'name' => 'Super Admin',
                'password' => Hash::make('123456789'), // غيّر الباسورد
                'role_id' => 1,
            ]
        );
    }
}
