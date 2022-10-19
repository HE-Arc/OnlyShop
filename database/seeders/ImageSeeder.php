<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Image;

class ImageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $images = [
            ['imagepath' => './images/item1/image1.png', 'item_id' => 1],
            ['imagepath' => './images/item2/image1.png', 'item_id' => 2],
            ['imagepath' => './images/item3/image1.png', 'item_id' => 3],
        ];

        foreach($images as $image)
        {
            Image::create([
                'imagepath' => $image['imagepath'],
                'item_id' => $image['item_id'],
            ]);
        };
    }
}
