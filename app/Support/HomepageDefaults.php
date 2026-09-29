<?php

namespace App\Support;

class HomepageDefaults
{
    /**
     * @return array<string, mixed>
     */
    public static function content(): array
    {
        return [
            'hero' => [
                'eyebrow' => 'Faith-led. Service-driven. Africa-focused.',
                'title_line_one' => 'Rooted in faith.',
                'title_line_two' => 'Built for',
                'title_emphasis' => 'impact.',
                'description' => 'A generation of Christ-centred young leaders. Equipped to serve. Ready to shape the future of our communities and nations.',
                'primary_button_label' => 'Discover The IMPACT',
                'secondary_button_label' => 'Explore the journey',
                'footnote_line_one' => 'Christian Youth Leadership',
                'footnote_line_two' => '& Public Impact Network',
                'image' => 'images/leadership-circle-960.webp',
                'image_alt' => 'AI-generated illustration of young African adults sharing ideas around a table, with notebooks and a Bible.',
                'badge' => 'A shared calling',
                'caption_eyebrow' => 'Faith brings us together.',
                'caption_title' => 'Purpose moves us forward.',
                'bottom_statement' => 'Conviction becomes contribution.',
            ],
            'philosophy' => ['Faith', 'Leadership', 'Competence', 'Service', 'Influence', 'Transformation'],
            'about' => [
                'label' => '01 / WHO WE ARE',
                'title_line_one' => 'Faith is our foundation.',
                'title_emphasis' => 'Society is our field.',
                'image' => 'images/community-service-960.webp',
                'image_alt' => 'AI-generated illustration of young African volunteers planting a tree together in a community garden.',
                'image_caption' => 'Conviction grows through service.',
                'lead' => 'We believe young Christians have a vital role to play in the future of Africa.',
                'paragraphs' => [
                    'The IMPACT is a network of Christian young leaders focused on governance, public policy, leadership, service and societal transformation.',
                    'We bring faith and public responsibility together, connecting a generation with the purpose, competence and courage to turn conviction into meaningful contribution.',
                ],
                'link_label' => 'More about THE IMPACT',
            ],
            'vision' => [
                'eyebrow' => 'THE FUTURE WE SEE',
                'title' => 'Our vision',
                'statement' => "To become Africa's leading network for developing Christ-centred young leaders who shape institutions, influence public policy and build solutions that transform communities and nations.",
                'caption' => 'A vision for Africa. A calling for a generation.',
            ],
            'mission' => [
                'eyebrow' => 'THE WORK WE ARE CALLED TO DO',
                'title' => 'Our mission',
                'statement' => 'The IMPACT exists to identify, connect, equip, mentor and deploy young Christians with the character, competence and courage to provide solutions, influence public policy, serve their communities and lead transformational change in society.',
                'caption' => 'Purpose, put into practice.',
            ],
            'focus' => [
                'label' => '02 / OUR FOCUS',
                'title_line_one' => 'Conviction.',
                'title_emphasis' => 'With real-world purpose.',
                'introduction' => 'Five connected areas. One shared commitment: to serve people and contribute to a better society.',
                'link_label' => 'Explore our programmes',
                'areas' => [
                    ['name' => 'Governance', 'icon' => 'governance', 'title' => 'Lead with integrity.', 'description' => 'Responsible leadership begins with character. Our focus is on young Christians who bring integrity, accountability and a spirit of service to institutions and public life.', 'eyebrow' => 'Character in public life'],
                    ['name' => 'Public policy', 'icon' => 'policy', 'title' => 'Bring solutions to the table.', 'description' => 'We believe faith-informed values and practical competence can help young leaders engage thoughtfully with public policy and the decisions that shape everyday life.', 'eyebrow' => 'Ideas that serve people'],
                    ['name' => 'Leadership', 'icon' => 'leadership', 'title' => 'Grow into your calling.', 'description' => 'Leadership is a responsibility to develop. Through connection, equipping and mentorship, our mission is to help young Christians grow in character, competence and courage.', 'eyebrow' => 'Purpose meets preparation'],
                    ['name' => 'Service', 'icon' => 'service', 'title' => 'Start where you are.', 'description' => 'Meaningful contribution begins with people. Serving communities puts our convictions into practice and keeps leadership rooted in the needs of others.', 'eyebrow' => 'People at the centre'],
                    ['name' => 'Societal transformation', 'icon' => 'growth', 'title' => 'Build for lasting change.', 'description' => 'Our vision reaches beyond individual success to solutions that strengthen communities, shape institutions and contribute to the transformation of nations.', 'eyebrow' => 'A future shaped together'],
                ],
            ],
            'journey' => [
                'label' => '03 / THE JOURNEY',
                'title_line_one' => 'From a sense of calling',
                'title_line_two' => 'to a life of',
                'title_emphasis' => 'contribution.',
                'introduction' => 'Our mission follows a clear path: identify, connect, equip, mentor and deploy.',
                'steps' => [
                    ['name' => 'Identify', 'icon' => 'identify', 'label' => 'Recognise purpose', 'description' => 'Identify young Christians with the character and desire to make a difference.'],
                    ['name' => 'Connect', 'icon' => 'connect', 'label' => 'Find your people', 'description' => 'Connect young leaders through a shared commitment to faith and public impact.'],
                    ['name' => 'Equip', 'icon' => 'equip', 'label' => 'Build competence', 'description' => 'Equip leaders with the understanding and capabilities to provide solutions.'],
                    ['name' => 'Mentor', 'icon' => 'mentor', 'label' => 'Grow with guidance', 'description' => 'Mentor emerging leaders as they develop the courage and character to serve.'],
                    ['name' => 'Deploy', 'icon' => 'deploy', 'label' => 'Put faith into action', 'description' => 'Deploy leaders to serve their communities and contribute to transformational change.'],
                ],
            ],
            'closing' => [
                'eyebrow' => 'THE FUTURE CALLS FOR MORE OF US',
                'title_line_one' => 'A grounded faith.',
                'title_line_two' => 'A prepared generation.',
                'title_emphasis' => 'A transformed society.',
                'button_label' => 'Explore our Vision & Mission',
            ],
        ];
    }
}
