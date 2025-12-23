<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::insert([
            [
            'name'=>'mohamed',
            'role'=>'مدير',
            'email'=>'admin@mail.com',
            'password'=>Hash::make('123456789')
        ],
            [
            'name'=>'user1',
            'role'=>'موظف',
            'email'=>'user1@mail.com',
            'password'=>Hash::make('123456789')
        ]
        ]);
    }
}
