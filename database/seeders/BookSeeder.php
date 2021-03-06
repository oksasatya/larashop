<?php

namespace Database\Seeders;

use App\Models\book;
use Database\Factories\BookFactory;
use Illuminate\Database\Seeder;

class BookSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $book = new BookFactory();
        $book
        ->count(20)
        ->create();
    }
}
