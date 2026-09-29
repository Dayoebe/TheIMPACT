<?php

namespace Database\Factories;

use App\Models\PhilosophyFocusContent;
use App\Support\PhilosophyFocusDefaults;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<PhilosophyFocusContent>
 */
class PhilosophyFocusContentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'key' => 'philosophy-focus',
            'content' => PhilosophyFocusDefaults::content(),
            'updated_by' => null,
        ];
    }
}
