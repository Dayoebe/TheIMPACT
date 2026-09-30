<?php

namespace App\Support;

class ProgrammeDefaults
{
    /** @return array<string, mixed> */
    public static function page(): array
    {
        return [
            'meta' => ['title' => 'Programmes — THE IMPACT', 'description' => 'Explore programme outlines in leadership, governance, practical skills, Christian character, community service and mentorship.'],
            'hero' => ['eyebrow' => 'Programmes', 'title' => 'Grow in purpose. Prepare to contribute.', 'description' => 'Explore six connected pathways for Christ-centred leadership, practical competence and meaningful service.', 'button_label' => 'Find a programme'],
            'directory' => ['label' => 'THE PROGRAMME DIRECTORY', 'title_line_one' => 'Where conviction', 'title_emphasis' => 'meets preparation.', 'introduction' => 'Explore each outline to understand its purpose, learning objectives and who it is for.', 'notice_title' => 'Programme preview.', 'notice_text' => 'Curricula, facilitators and cohort schedules are illustrative. Applications are not being collected.', 'card_action' => 'Explore programme'],
            'mentorship' => ['label' => 'GROWTH IS PERSONAL', 'title_line_one' => 'Looking for', 'title_emphasis' => 'guidance along the way?', 'lead' => 'Mentorship connects the learning journey with reflection, experience and encouragement.', 'description' => 'Discover the initiative, explore the intended matching process and see how you could participate as a mentor or mentee.', 'button_label' => 'Explore mentorship'],
        ];
    }

    /** @return array<string, array<string, mixed>> */
    public static function programmes(): array
    {
        return config('programmes');
    }
}
