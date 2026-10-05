<?php

namespace App\Support;

class CohortPageDefaults
{
    /** @return array<string, mixed> */
    public static function content(): array
    {
        return [
            'meta' => ['title' => 'Cohorts & Registration — THE IMPACT', 'description' => 'Review programme cohort schedules and registration availability across THE IMPACT’s leadership, service and development pathways.'],
            'hero' => ['eyebrow' => 'Cohorts & Registration', 'title' => 'Find the right programme moment.', 'description' => 'Review announced cohort details, understand how each programme is delivered and follow confirmed registration links when applications open.', 'button_label' => 'View cohort directory'],
            'directory' => ['label' => 'COHORT DIRECTORY', 'title_line_one' => 'Find your pathway.', 'title_emphasis' => 'Take the next step.', 'introduction' => 'Explore each programme and review available cohort and registration details.', 'registration_open' => 'Registration open', 'view_programme' => 'View programme', 'apply_label' => 'Registration details'],
            'guidance' => ['label' => 'BEFORE YOU REGISTER', 'title_line_one' => 'Review the programme.', 'title_emphasis' => 'Prepare with clarity.', 'lead' => 'Each programme page explains its purpose, intended audience, learning objectives and curriculum.', 'description' => 'Confirmed participation requirements, dates and any costs should be reviewed before submitting an application.', 'button_label' => 'Browse all programmes'],
        ];
    }
}
