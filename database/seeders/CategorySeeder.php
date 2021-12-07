<?php

namespace Database\Seeders;

use Database\Factories\CategoryFactory;
use Faker\Factory;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {


        $category = new CategoryFactory;

        $category
            ->count(20)
            ->create();
    }
}
