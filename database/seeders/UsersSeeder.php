<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = [
            [
                'name' => 'ABSX SUPORTE',
                'email' => 'absx.suporte@mailinator.com',
                'password' => bcrypt('12345678'),
                'phone_number' => '62992944643',
                'user_type' => 'adm'
            ],
            [
                'name' => 'Felipe',
                'email' => 'felipe.absx@mailinator.com',
                'password' => bcrypt('12345678'),
                'phone_number' => '62992944643',
                'user_type' => 'agent'
            ],
            [
                'name' => 'Marcos',
                'email' => 'marcos.absx@mailinator.com',
                'password' => bcrypt('12345678'),
                'phone_number' => '62992944643',
                'user_type' => 'agent'
            ],
            [
                'name' => 'João',
                'email' => 'joao.absx@mailinator.com',
                'password' => bcrypt('12345678'),
                'phone_number' => '62992944643',
                'user_type' => 'agent'
            ],
            [
                'name' => 'Rodrigo',
                'email' => 'rodrigom.21amorim@gmail.com',
                'password' => bcrypt('12345678'),
                'phone_number' => '62992944643',
                'user_type' => 'client'
            ]
        ];

        User::insert($users);
    }
}
