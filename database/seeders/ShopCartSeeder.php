<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Shopcart;

class ShopCartSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $shopcarts = [
            ['user_id' => 1],
            ['user_id' => 2],
            ['user_id' => 3],
        ];

        foreach($shopcarts as $shopcart)
        {
            Shopcart::create([
                'user_id' => $shopcart['user_id'],
            ]);
        };
    }
}
