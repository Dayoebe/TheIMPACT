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
                'profile_label' => $id === 'founder-president' ? 'PRESIDENT & CONVENER' : 'LEADERSHIP',
                'photo' => $id === 'founder-president' ? 'images/pst-feyisara-samuel.jpg' : null,
                'photo_alt' => $id === 'founder-president' ? 'Portrait of Pst. Feyisara Samuel, President and Convener of THE IMPACT.' : '',
            ])->all();

            return ['id' => $id, ...$group];
        })->values()->all();

        return [
            'meta' => ['title' => 'Leadership — THE IMPACT', 'description' => 'Explore the leadership structure guiding the vision, mission and work of THE IMPACT.'],
            'hero' => ['eyebrow' => 'Leadership', 'title' => 'People entrusted with purpose.', 'description' => 'Leadership is a responsibility to serve. Meet the roles that guide the vision, steward the mission and support the work of THE IMPACT.', 'action' => 'Explore our leadership'],
            'directory' => ['label' => 'LEADERSHIP', 'groups' => $groups],
            'closing' => ['eyebrow' => 'ONE NETWORK. ONE SHARED PURPOSE.', 'title_line_one' => 'Meet the mission', 'title_emphasis' => 'behind the people.', 'button_label' => 'Vision & Mission'],
        ];
    }
}
