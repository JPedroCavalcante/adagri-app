<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Job>
 */
class JobFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $active = $this->faker->randomElement([true, false]);
        $type = $this->faker->randomElement(['clt', 'legal_person', 'freelancer']);

        return [
            'name' => $this->faker->domainName(),
            'type' => $type,
            'salary' => $this->faker->numberBetween(0,1000000),
            'active' => $active,
        ];
    }
}
