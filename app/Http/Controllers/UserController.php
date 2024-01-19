<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function addUser()
    {
        DB::table('users')->insert([
            'name' => 'Han',
            'email' => 'darknesofwiz@gmail.com',
            'password' => Hash::make('password'), // Gunakan Hash::make untuk mengenkripsi password
            'role' => 'user', // Atau 'admin' untuk peran admin
        ]);

        return 'User added successfully!';
    }
}
