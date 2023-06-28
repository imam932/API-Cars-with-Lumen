<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            [
                'name' => 'Owner Imam',
                'email' => 'owner@gmail.com',
                'password' => Hash::make('test12345'),
                'is_owner' => true
            ],
            [
                'name' => 'user Any',
                'email' => 'any@gmail.com',
                'password' => Hash::make('any12345'),
                'is_owner' => false
            ],
        ];
        $users = User::insert($data);
    }
}
