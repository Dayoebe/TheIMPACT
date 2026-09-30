<?php

namespace Database\Factories;

use App\Models\CohortPageContent;
use App\Support\CohortPageDefaults;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<CohortPageContent>
 */
class CohortPageContentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'key' => 'cohorts-registration',
            'content' => CohortPageDefaults::content(),
            'updated_by' => null,
        ];
    }
}
