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
            '7 Star Umrah',
            'Ramadan Umrah',
            'Luxury Umrah',
            'Cheap Umrah',
            'Easter Umrah Packages',
        ];

        // Delete categories that are no longer part of our core simplified list
        \App\Models\Category::whereNotIn('name', $categories)->delete();

        foreach ($categories as $name) {
            Category::firstOrCreate(['name' => $name]);
        }
    }
}
