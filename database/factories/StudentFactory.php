<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Student>
 */
class StudentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name'=>fake()->name(),
            'phone'=> fake()->phoneNumber(),
            'email'=> fake()->unique()->safeEmail(),
            'birth_date'=>fake()->dateTimeBetween('-26 years','2018-01-01'),
            'registration_date'=>fake()->date('Y-m-d','now')
        ];

    }
}
