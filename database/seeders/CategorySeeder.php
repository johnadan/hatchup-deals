<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            'Food and Beverages',
            'Professional Services',
            'Leisure and Entertainment',
            'Finance and Banking',
            'Health and Fitness',
            'Beauty and Personal Care',
            'Home and Household',
            'Apparel and Accessories',
        ];

        foreach ($categories as $category) {
            Category::create(['name' => $category]);
        }
    }
}
