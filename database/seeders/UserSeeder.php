<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     * @return void 
     */
    public function run(): void
    {
        $admin = User::create([
            'name' => 'admin',
            'email' => 'admin@contoh.com',
            'password' => bcrypt('password'),
        ]); 

        $admin->assignRole('admin');

        $user = User::create([
            'name' => 'User',
            'email' => 'user@contoh.com',
            'password' => bcrypt('12345678'),
        ]);

        $user->assignRole('user');
    }
}
