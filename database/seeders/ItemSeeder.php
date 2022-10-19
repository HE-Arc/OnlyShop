<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Item;

class ItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $items = [
            ['name' => 'test1', 'description' => 'description1', 'price' => 10, 'user_id' => '1'],
            ['name' => 'test2', 'description' => 'description2', 'price' => 20, 'user_id' => '2'],
            ['name' => 'test3', 'description' => 'description3', 'price' => 30, 'user_id' => '3'],
        ];

        foreach($items as $item)
        {
            Item::create([
                'name' => $item['name'],
                'description' => $item['description'],
                'price' => $item['price'],
                'user_id' => $item['user_id'],
            ]);
        };
    }
}
