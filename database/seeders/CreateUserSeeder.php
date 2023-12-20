<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;


class CreateUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = [
            ['name' => 'dlo',
            'email' => 'dlo@gmail.com',
            'password' => '33333333',
            'role' => '1',]
        ];

        foreach($users as $user){
            User::create($user);
        }
    }
}
