<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class CreateUsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //create users 
        $user = [
            [
                'name' => 'admin',
                'password' => bcrypt('admin12345'),
                'role' => 'admin',
            ],
            [
                'name' => 'karyawan',
                'password' => bcrypt('karyawan12345'),
                'role' => 'karyawan',
            ]
        ];

        foreach ($user as $key => $value) {
            User::create($value);
        }
    }
}
