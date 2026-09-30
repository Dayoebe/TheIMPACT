<?php

namespace Database\Factories;

use App\Models\Programme;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Programme>
 */
class ProgrammeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'slug' => fake()->unique()->slug(2),
            'name' => fake()->words(3, true),
            'headline' => fake()->sentence(),
            'icon' => 'equip',
            'category' => 'Leadership',
            'summary' => fake()->paragraph(),
            'overview' => fake()->paragraphs(2, true),
            'audience' => fake()->sentence(),
            'duration' => 'To be announced',
            'registration_url' => null,
            'objectives' => [fake()->sentence()],
            'curriculum' => [['title' => fake()->sentence(3), 'description' => fake()->sentence()]],
            'facilitators' => [],
            'cohorts' => [],
            'status' => 'draft',
            'sort_order' => 0,
            'updated_by' => null,
        ];
    }
}
