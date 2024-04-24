<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Category; //this represents the categories table

class CategorySeeder extends Seeder
{
    private $category;

    public function __construct(Category $category)
    {
        $this->category = $category;
    }

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        /** Note: make sure there is no DUPLICATE name in categories table */
        $categories = [
            [
                'name' => 'Travel',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Food',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Music',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Technology',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Career',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Movie',
                'created_at' => now(),
                'updated_at' => now()
            ]
           
            /** note: you can add any name of categories as much as you can */
        ];

        $this->category->insert($categories);
    }
}
