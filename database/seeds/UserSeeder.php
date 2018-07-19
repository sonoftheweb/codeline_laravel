<?php

namespace Database\Seeds;

use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run()
    {
        DB::table('users')->delete();
        User::create([
            'name'     => 'John',
            'username' => 'Doe',
            'email'    => 'john@doe.io',
            'password' => Hash::make('password')
        ]);
    }
}