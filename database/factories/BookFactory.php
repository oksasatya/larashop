<?php

namespace Database\Factories;

use App\Models\book_category_table;
use App\Models\User;
use Illuminate\Support\Str;
use Faker\Factory as FakerFactory;
use Illuminate\Database\Eloquent\Factories\Factory;

class BookFactory extends Factory
{

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $faker = FakerFactory::create('id_ID');
        $title =  $faker->unique()->sentence(5);
        $slug = Str::slug($title, '-');
        return [
            'title' => $title,
            'slug' => $slug,
            'description' => $faker->unique()->sentence(10),
            'author' => $faker->name(),
            'publisher' => $faker->year(),
            'cover' => $faker->image('public/storage/',640,480, null, false),
            'price' => $faker->numberBetween($min=1000,$max=6000),
            'views' =>$faker->randomDigit(),
            'stock' =>$faker->numberBetween(0,100),
            'status'=> $faker->randomElement(['PUBLISH','DRAFT']),
            'created_by' => User::all()->random()->id,
            'created_at' => now(),
        ];
    }
}
