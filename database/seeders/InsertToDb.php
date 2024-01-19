<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class InsertToDb extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $userData = [
            [
                'name' => 'han',
                'email'=> 'han@gmail.com',
                'role' => 'admin',
                'password' => bcrypt("password")
            ],

            [
                'name' => 'pit',
                'email'=> 'pit@gmail.com',
                'role' => 'user',
                'password' => bcrypt("password")
            ]
            ];

        foreach($userData as $key => $val){
            User::create($val);
        }
    }
}
