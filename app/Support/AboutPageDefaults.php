<?php

namespace App\Support;

class AboutPageDefaults
{
    /** @return array<string, mixed> */
    public static function content(): array
    {
        return [
            'meta' => ['title' => 'About THE IMPACT — Faith, Leadership & Service in Africa', 'description' => 'Discover why THE IMPACT exists, the gap we seek to address, and our approach to developing Christ-centred young leaders for public service and societal transformation.'],
            'hero' => ['eyebrow' => 'ABOUT THE IMPACT', 'title_line_one' => 'A shared faith.', 'title_line_two' => 'A public', 'title_emphasis' => 'purpose.', 'lead' => 'We connect Christian young leaders with the character, competence and courage to serve people and shape a better society.', 'button_label' => 'Get to know us', 'image' => 'images/leadership-circle-960.webp', 'image_alt' => 'AI-generated illustration of young African adults discussing ideas around a table with notebooks and a Bible.', 'image_caption' => 'Rooted in Christ. Connected by purpose.'],
            'contents' => ['Who we are', 'Why we exist', 'The problem', 'Our philosophy', 'Our approach', 'Our difference'],
            'who' => ['label' => '01 / WHO WE ARE', 'title_line_one' => 'A network of people.', 'title_emphasis' => 'A commitment to serve.', 'lead' => 'THE IMPACT is a network of Christian young leaders focused on governance, public policy, leadership, service and societal transformation across Africa.', 'paragraphs' => ['We bring faith and public responsibility together. Our shared conviction is that following Christ should shape how we lead, the decisions we make and the way we respond to the needs of others.', 'We seek to connect young Christians who want to develop their abilities and put them to work in communities, institutions and public life. Character, competence and courage are central to the kind of leadership we want to nurture.']],
            'why' => ['label' => '02 / WHY THE IMPACT EXISTS', 'title_line_one' => 'Conviction needs', 'title_emphasis' => 'a way into action.', 'lead' => 'We exist to help young Christians turn a sense of calling into meaningful contribution.', 'paragraphs' => ['A desire to make a difference needs direction, preparation and people to walk alongside us. THE IMPACT brings these priorities together through a mission to identify, connect, equip, mentor and deploy young leaders.', 'Our vision is to become Africa’s leading network for developing Christ-centred young leaders who shape institutions, influence public policy and build solutions that transform communities and nations.', 'That vision begins with a practical question: how can our faith, abilities and opportunities serve the people around us?'], 'link_label' => 'Read our Vision & Mission'],
            'problem' => ['label' => '03 / THE PROBLEM WE’RE ADDRESSING', 'title_line_one' => 'The gap between potential', 'title_emphasis' => 'and prepared leadership.', 'introduction' => 'We focus on the barriers that can keep a willingness to serve from becoming an informed, sustained contribution.', 'cards' => [
                ['icon' => 'compass', 'title' => 'Conviction without direction', 'description' => 'A strong sense of purpose can remain an intention when there is no clear path into service. Young leaders need ways to understand where their abilities meet real needs.'],
                ['icon' => 'equip', 'title' => 'Passion without preparation', 'description' => 'Good intentions alone cannot resolve complex public challenges. Responsible leadership also calls for practical skills, sound judgement and a willingness to learn.'],
                ['icon' => 'connect', 'title' => 'Potential without connection', 'description' => 'Growing alone can make it harder to find guidance, exchange ideas and sustain a commitment to service. Relationships and mentorship matter.'],
            ]],
            'philosophy' => ['label' => '04 / OUR PHILOSOPHY', 'title_line_one' => 'Faith is the foundation.', 'title_emphasis' => 'Transformation is the aim.', 'introduction' => 'Six connected ideas guide how we think about leadership and the contribution it should make.', 'values' => config('impact.philosophy')],
            'approach' => ['label' => '05 / OUR APPROACH', 'title_line_one' => 'Recognise the calling.', 'title_emphasis' => 'Prepare for the work.', 'introduction' => 'Our mission follows five connected steps. Each keeps personal growth tied to responsibility beyond ourselves.', 'image' => 'images/community-service-960.webp', 'image_alt' => 'AI-generated illustration of young African volunteers planting a tree in a community garden.', 'image_caption' => 'Growth finds its purpose in contribution.', 'steps' => [
                ['icon' => 'identify', 'title' => 'Identify', 'description' => 'Recognise young Christians with the desire and character to take responsibility and make a difference.'],
                ['icon' => 'connect', 'title' => 'Connect', 'description' => 'Bring people together around shared faith, mutual encouragement and a commitment to public impact.'],
                ['icon' => 'equip', 'title' => 'Equip', 'description' => 'Develop the understanding and capabilities needed to engage with challenges and contribute practical solutions.'],
                ['icon' => 'mentor', 'title' => 'Mentor', 'description' => 'Make guidance, reflection and learning from others part of the journey towards responsible leadership.'],
                ['icon' => 'deploy', 'title' => 'Deploy', 'description' => 'Put preparation into practice through service, problem-solving and contribution in communities and institutions.'],
            ]],
            'difference' => ['label' => '06 / WHAT MAKES THE NETWORK DIFFERENT', 'title_line_one' => 'The commitments', 'title_emphasis' => 'that define us.', 'introduction' => 'Our identity comes from bringing these priorities together in one shared purpose.', 'cards' => [
                ['icon' => 'faith', 'title' => 'Christ-centred, publicly engaged', 'description' => 'Faith shapes our character and informs our responsibility in governance, public policy, institutions and everyday community life.'],
                ['icon' => 'leadership', 'title' => 'Character and competence together', 'description' => 'We value both the person a leader becomes and the ability they develop. Integrity, preparation and courage belong together.'],
                ['icon' => 'connect', 'title' => 'Relationships that support growth', 'description' => 'Connection and mentorship are part of our mission. We want young leaders to learn with others and contribute to one another’s development.'],
                ['icon' => 'service', 'title' => 'Africa-focused, service-driven', 'description' => 'Our vision is rooted in the future of African communities and nations. We orient leadership towards people’s needs and the work of building useful solutions.'],
            ]],
            'closing' => ['eyebrow' => 'PURPOSE, PUT INTO PRACTICE', 'title_line_one' => 'See where our', 'title_emphasis' => 'convictions lead.', 'button_label' => 'Explore our programmes'],
        ];
    }
}
