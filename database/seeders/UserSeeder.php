<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'username' => 'Abdul',
            'name' => 'Abdulah',
            'email' => 'abdul@example.com',
            'password' => Hash::make('Abdul123'),
            'role' => 'guest',
            'status' => 'inactive',
        ]);
        User::create([
            'username' => 'Catrin',
            'name' => 'Catrina',
            'email' => 'catrina@example.com',
            'password' => Hash::make('Catrina123'),
            'role' => 'guest',
            'status' => 'active',
        ]);
    }
}