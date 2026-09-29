<?php

namespace App\Support;

class PhilosophyFocusDefaults
{
    /** @return array<string, mixed> */
    public static function content(): array
    {
        return [
            'meta' => ['title' => 'Philosophy & Focus Areas — THE IMPACT', 'description' => 'Explore the six-part philosophy and five focus areas that guide THE IMPACT’s approach to faith, leadership, service and societal transformation.'],
            'hero' => ['eyebrow' => 'Philosophy & Focus Areas', 'title' => 'What grounds us. Where we contribute.', 'description' => 'Our philosophy shapes the kind of leaders we seek to become. Our focus areas show where conviction, competence and service meet public life.', 'primary_action' => 'Our philosophy', 'secondary_action' => 'Explore focus areas'],
            'philosophy' => ['label' => '01 / OUR PHILOSOPHY', 'title_line_one' => 'Faith is the foundation.', 'title_emphasis' => 'Transformation is the aim.', 'introduction' => 'Six connected ideas guide how we think about leadership and the contribution it should make.', 'values' => config('impact.philosophy')],
            'focus' => [
                'label' => '02 / OUR FOCUS',
                'title_line_one' => 'Conviction.',
                'title_emphasis' => 'With real-world purpose.',
                'introduction' => 'Five connected areas. One shared commitment: to serve people and contribute to a better society.',
                'areas' => [
                    ['name' => 'Governance', 'icon' => 'governance', 'title' => 'Lead with integrity.', 'description' => 'Responsible leadership begins with character. Our focus is on young Christians who bring integrity, accountability and a spirit of service to institutions and public life.', 'eyebrow' => 'Character in public life'],
                    ['name' => 'Public policy', 'icon' => 'policy', 'title' => 'Bring solutions to the table.', 'description' => 'We believe faith-informed values and practical competence can help young leaders engage thoughtfully with public policy and the decisions that shape everyday life.', 'eyebrow' => 'Ideas that serve people'],
                    ['name' => 'Leadership', 'icon' => 'leadership', 'title' => 'Grow into your calling.', 'description' => 'Leadership is a responsibility to develop. Through connection, equipping and mentorship, our mission is to help young Christians grow in character, competence and courage.', 'eyebrow' => 'Purpose meets preparation'],
                    ['name' => 'Service', 'icon' => 'service', 'title' => 'Start where you are.', 'description' => 'Meaningful contribution begins with people. Serving communities puts our convictions into practice and keeps leadership rooted in the needs of others.', 'eyebrow' => 'People at the centre'],
                    ['name' => 'Societal transformation', 'icon' => 'growth', 'title' => 'Build for lasting change.', 'description' => 'Our vision reaches beyond individual success to solutions that strengthen communities, shape institutions and contribute to the transformation of nations.', 'eyebrow' => 'A future shaped together'],
                ],
            ],
            'closing' => ['eyebrow' => 'FROM CONVICTION TO CONTRIBUTION', 'title_line_one' => 'See how these priorities', 'title_emphasis' => 'take shape in practice.', 'button_label' => 'Explore our programmes'],
        ];
    }
}
