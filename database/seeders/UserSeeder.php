<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
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
            ['firstname' => 'Lucas', 'lastname' => 'Perrin', 'email' => 'lucas.perrin1@he-arc.ch', 'password' => Hash::make('Pa$$w0rd')],
            ['firstname' => 'Rui Marco', 'lastname' => 'Loureiro', 'email' => 'rui.loureiro@he-arc.ch', 'password' => Hash::make('Pa$$w0rd')],
            ['firstname' => 'Miguel', 'lastname' => 'Moreira', 'email' => 'miguel.moreira@he-arc.ch', 'password' => Hash::make('Pa$$w0rd')],
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
