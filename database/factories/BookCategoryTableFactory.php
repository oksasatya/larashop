<?php

namespace Database\Factories;

use App\Models\book;
use App\Models\book_category_table;
use Illuminate\Database\Eloquent\Factories\Factory;
use Faker\Factory as FakerFactory;
class BookCategoryTableFactory extends Factory
{
    protected $model = book_category_table::class;
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $faker = FakerFactory::create();
        return [
            'book_id' => $faker->randomDigitNotNull(),
        ];
    }


    public function book($bookId){
        $this->book = book::where('id','=',$bookId)->first();

        return $this->state([
            'book_id' => $this->book->id,
        ]);
    }
}
