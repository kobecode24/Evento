<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $categories = [
            ['name' => 'Technology'],
            ['name' => 'Art'],
            ['name' => 'Music'],
            ['name' => 'Sports'],
            ['name' => 'Education'],
            ['name' => 'Health'],
            ['name' => 'Science'],
            ['name' => 'Business'],
            ['name' => 'Travel'],
            ['name' => 'Food'],
            ['name' => 'Fashion'],
            ['name' => 'Lifestyle'],
            ['name' => 'Photography'],
            ['name' => 'Film & Media'],
            ['name' => 'Government'],
            ['name' => 'Community'],
            ['name' => 'Hobbies'],
        ];

        DB::table('categories')->insert($categories);
    }
}
