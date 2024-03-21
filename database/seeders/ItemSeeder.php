<?php

namespace Database\Seeders;

use App\Models\Item;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $itemsData = [
            ['name' => 'Item One', 'description' => 'Item One Description', 'image' => NULL, 'user_id' => 1],
            ['name' => 'Item Two', 'description' => 'Item Two Description', 'image' => NULL, 'user_id' => 2],
            ['name' => 'Item Three', 'description' => 'Item Three Description', 'image' => NULL, 'user_id' => 1],
        ];

        foreach ($itemsData as $itemData) {
            Item::create($itemData);
        }
    }
}
