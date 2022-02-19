<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        //create admin
        User::create([
           'name' => 'Admin',
           'email' => 'admin@gmail.com',
            'password' => Hash::make('password'),
            'is_approved' => 1,
            'is_admin' => 1
        ]);
        //create customer
        User::create([
            'name' => 'Diana',
            'email' => 'diana@gmail.com',
            'password' => Hash::make('password'),
            'is_approved' => 1,
            'is_admin' => 0
        ]);
    }
}
