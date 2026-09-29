<?php

namespace Database\Factories;

use App\Models\HomepageContent;
use App\Support\HomepageDefaults;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<HomepageContent>
 */
class HomepageContentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'key' => 'home',
            'content' => HomepageDefaults::content(),
        ];
    }
}
