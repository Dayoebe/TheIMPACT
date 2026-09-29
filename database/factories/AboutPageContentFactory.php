<?php

namespace Database\Factories;

use App\Models\AboutPageContent;
use App\Support\AboutPageDefaults;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<AboutPageContent>
 */
class AboutPageContentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'key' => 'about',
            'content' => AboutPageDefaults::content(),
        ];
    }
}
