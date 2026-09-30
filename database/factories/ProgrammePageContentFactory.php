<?php

namespace Database\Factories;

use App\Models\ProgrammePageContent;
use App\Support\ProgrammeDefaults;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<ProgrammePageContent>
 */
class ProgrammePageContentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'key' => 'programmes',
            'content' => ProgrammeDefaults::page(),
            'updated_by' => null,
        ];
    }
}
