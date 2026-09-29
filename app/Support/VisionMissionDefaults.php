<?php

namespace App\Support;

class VisionMissionDefaults
{
    /** @return array<string, mixed> */
    public static function content(): array
    {
        return [
            'meta' => ['title' => 'Vision & Mission — THE IMPACT', 'description' => 'Our vision for Christ-centred leadership in Africa, our five-step mission and the six-part philosophy that guides THE IMPACT.'],
            'hero' => ['eyebrow' => 'Vision & Mission', 'title' => 'A clear calling. A shared direction.', 'description' => 'Our vision names the future we hope to help shape. Our mission describes how we prepare a generation to contribute to it.', 'primary_action' => 'Our vision', 'secondary_action' => 'Explore our philosophy'],
            'vision' => ['label' => '01 / OUR VISION', 'title_line_one' => 'Africa’s future.', 'title_emphasis' => 'A generation prepared.', 'statement' => config('impact.vision'), 'caption' => 'THE FUTURE WE ARE WORKING TOWARDS'],
            'mission' => ['label' => '02 / OUR MISSION', 'title_line_one' => 'Purpose needs', 'title_emphasis' => 'a practical path.', 'statement' => config('impact.mission'), 'steps' => config('impact.mission_steps')],
            'philosophy' => ['label' => '03 / OUR SIX-PART PHILOSOPHY', 'title_line_one' => 'From faith', 'title_emphasis' => 'to transformation.', 'introduction' => 'Faith shapes leadership. Competence strengthens it. Service gives it direction. Influence extends its reach. Transformation is the lasting change we seek.', 'values' => config('impact.philosophy')],
            'closing' => ['eyebrow' => 'THE MISSION IN PRACTICE', 'title_line_one' => 'Find your next', 'title_emphasis' => 'step in growth.', 'button_label' => 'Explore programmes'],
        ];
    }
}
