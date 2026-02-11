<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run()
    {
        User::create([
            'name' => 'Leonardo',
            'email' => 'contato@innsystem.com.br',
            'password' => Hash::make('123456'),
        ]);
    }
}
