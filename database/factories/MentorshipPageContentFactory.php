<?php

namespace Database\Factories;

use App\Models\MentorshipPageContent;
use App\Support\MentorshipPageDefaults;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<MentorshipPageContent>
 */
class MentorshipPageContentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'key' => 'mentorship',
            'content' => MentorshipPageDefaults::content(),
            'updated_by' => null,
        ];
    }
}
