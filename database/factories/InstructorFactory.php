<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Instructor>
 */
class InstructorFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            "name"=>fake()->name(),
            "phone"=>fake()->phoneNumber(),
            "email"=>fake()->unique()->safeEmail(),
            "specialization"=>fake()->randomElement([
                'Web Development',
                'Mobile Apps',
                'UI/UX',
                'Data Analysis',
                'Cyber Security',
                'Project Managment',
            ]),
            "experience_years"=>fake()->numberBetween(1,10),
        ];
    }
}
