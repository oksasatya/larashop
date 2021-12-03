<?php

namespace Database\Factories;

use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use Faker\Factory as FakerFactory;
use Illuminate\Database\Eloquent\Factories\Factory;

class UserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        // $roles = json_encode((['Administrator', 'Staff', 'Customer']));
        $faker = FakerFactory::create('id_ID');
        return [
            'name' => $faker->name(),
            'email' => $faker->unique()->safeEmail(),
            'email_verified_at' => now(),
            'username' => $faker->userName(),
            'password' => bcrypt('12345678'), // password
            'remember_token' => Str::random(10),
            'address' => $faker->streetAddress(),
            'roles' => json_encode([$faker->randomElement((['Administrator', 'Staff', 'Customer']))]),
            'phone' => $faker->phoneNumber(),
            'status' => $faker->randomElement(['ACTIVE', 'INACTIVE']),
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public function unverified()
    {
        return $this->state(function (array $attributes) {
            return [
                'email_verified_at' => null,
            ];
        });
    }
}
