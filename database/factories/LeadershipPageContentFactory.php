<?php

namespace Database\Factories;

use App\Models\LeadershipPageContent;
use App\Support\LeadershipPageDefaults;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<LeadershipPageContent>
 */
class LeadershipPageContentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'key' => fake()->unique()->slug(),
            'content' => LeadershipPageDefaults::content(),
            'updated_by' => null,
        ];
    }
}
