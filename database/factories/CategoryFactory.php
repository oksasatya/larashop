<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\User;
use Faker\Factory as FakerFactory;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class CategoryFactory extends Factory
{

    protected $model = Category::class;
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $faker = FakerFactory::create('id_ID');
        $title = $faker->unique()->sentence(5);
        $slug = Str::slug($title, '-');
        return [
            'name' => $title,
            'slug' =>  $slug,
            'created_by' => User::all()->random()->id,
            'created_at' => now()
        ];
    }
}
