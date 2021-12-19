<?php

namespace Database\Seeders;

use App\Models\book;
use Database\Factories\BookCategoryTableFactory;
use Illuminate\Database\Seeder;
use Faker\Factory;
class BookCategoryTableSeeder extends Seeder
{

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $factory = new BookCategoryTableFactory();

        $factory->count(20)->create();

    }
}
