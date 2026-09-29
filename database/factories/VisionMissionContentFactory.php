<?php

namespace Database\Factories;

use App\Models\VisionMissionContent;
use App\Support\VisionMissionDefaults;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<VisionMissionContent>
 */
class VisionMissionContentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'key' => 'vision-mission',
            'content' => VisionMissionDefaults::content(),
            'updated_by' => null,
        ];
    }
}
