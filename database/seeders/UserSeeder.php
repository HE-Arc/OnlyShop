<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = [
            ['firstname' => 'Lucas', 'lastname' => 'Perrin', 'email' => 'lucas.perrin1@he-arc.ch', 'password' => '123456'],
            ['firstname' => 'Rui Marco', 'lastname' => 'Loureiro', 'email' => 'rui.loureiro@he-arc.ch', 'password' => '123456'],
            ['firstname' => 'Miguel', 'lastname' => 'Moreira', 'email' => 'miguel.moreira@he-arc.ch', 'password' => '123456'],
        ];

        foreach ($users as $user) {
            User::create([
                'firstname' => $user['firstname'],
                'lastname' => $user['lastname'],
                'email' => $user['email'],
                'password' => $user['password'],
            ]);
        };
    }
}
