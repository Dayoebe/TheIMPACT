<?php

namespace App\Support;

class LeadershipPageDefaults
{
    /** @return array<string, mixed> */
    public static function content(): array
    {
        $groups = collect(config('impact.leadership'))->map(function (array $group, string $id): array {
            $group['people'] = collect($group['people'])->map(fn (array $person): array => [
                ...$person,
                'profile_label' => $id === 'founder-president' ? 'PRESIDENT & CONVENER' : 'SAMPLE PROFILE',
            ])->all();

            return ['id' => $id, ...$group];
        })->values()->all();

        return [
            'meta' => ['title' => 'Leadership — THE IMPACT', 'description' => 'Explore the leadership structure guiding the vision, mission and work of THE IMPACT.'],
            'hero' => ['eyebrow' => 'Leadership', 'title' => 'People entrusted with purpose.', 'description' => 'Leadership is a responsibility to serve. Meet the roles that guide the vision, steward the mission and support the work of THE IMPACT.', 'action' => 'Explore our leadership'],
            'notice' => ['title' => 'Illustrative leadership directory.', 'text' => 'Names, roles and biographies below are sample content, not confirmed appointments.'],
            'directory' => ['label' => 'LEADERSHIP', 'sample_label' => 'SAMPLE PROFILE', 'empty_label' => 'PROFILES TO FOLLOW', 'empty_text' => 'Leadership profiles for this group will be published once confirmed.', 'groups' => $groups],
            'closing' => ['eyebrow' => 'ONE NETWORK. ONE SHARED PURPOSE.', 'title_line_one' => 'Meet the mission', 'title_emphasis' => 'behind the people.', 'button_label' => 'Vision & Mission'],
        ];
    }
}
