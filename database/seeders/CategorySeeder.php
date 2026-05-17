<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            '3 Star Umrah',
            '4 Star Umrah',
            '5 Star Umrah',
            'Ramadan Umrah',
            'Luxury Umrah',
        ];

        foreach ($categories as $name) {
            Category::firstOrCreate(['name' => $name]);
        }
    }
}
