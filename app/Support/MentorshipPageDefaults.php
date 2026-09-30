<?php

namespace App\Support;

class MentorshipPageDefaults
{
    /** @return array<string, mixed> */
    public static function content(): array
    {
        return [
            'meta' => ['title' => 'Mentorship — THE IMPACT', 'description' => 'Discover the mentorship initiative, who it is for, the intended matching approach and opportunities to participate as a mentor or mentee.'],
            'hero' => ['eyebrow' => 'Mentorship', 'title' => 'You don’t have to grow alone.', 'description' => 'A purposeful connection between experience and potential. Explore a mentorship initiative rooted in faith, honest reflection and the responsibility to serve.', 'mentor_action' => 'Become a mentor', 'mentee_action' => 'Join as a mentee'],
            'why' => ['label' => 'WHY MENTORSHIP MATTERS', 'title_line_one' => 'Perspective for the questions.', 'title_emphasis' => 'Encouragement for the journey.', 'image' => 'images/leadership-circle-960.webp', 'image_alt' => 'AI-generated illustration of young African adults learning together.', 'image_caption' => 'Experience shared. Potential encouraged.', 'lead' => 'A thoughtful conversation can help someone see their next step more clearly.', 'paragraphs' => ['Emerging leaders often face questions about purpose, character, work and service. Mentorship creates space to think through those questions with someone willing to listen, share experience and offer constructive challenge.', 'For THE IMPACT, mentoring connects personal growth with responsibility to others. The intention is to support young Christians as they develop the judgement, competence and courage to contribute in their own contexts.', 'A mentor offers perspective and encouragement. The mentee remains responsible for their own decisions, preparation and progress.']],
            'participation' => ['label' => 'WHO THE INITIATIVE IS FOR', 'title_line_one' => 'Different experiences.', 'title_emphasis' => 'A shared commitment.', 'introduction' => 'Mentorship works best when both people arrive ready to listen, learn and honour the relationship.', 'roles' => [
                'mentor' => ['eyebrow' => 'FOR MENTORS', 'title' => 'Share what experience has taught you.', 'description' => 'The initiative is intended for Christians with relevant leadership, professional or community experience and a willingness to support emerging leaders.', 'points' => ['Model integrity, humility and respect.', 'Offer time for purposeful conversations and follow-through.', 'Listen well and give thoughtful, constructive feedback.', 'Respect agreed boundaries and the mentee’s agency.'], 'link_label' => 'Explore becoming a mentor'],
                'mentee' => ['eyebrow' => 'FOR MENTEES', 'title' => 'Bring your questions. Own your growth.', 'description' => 'The initiative is intended for young Christians seeking guidance as they develop in leadership, professional life or community service.', 'points' => ['Identify areas in which you want to grow.', 'Prepare for conversations and remain open to feedback.', 'Commit time to agreed actions and reflection.', 'Respect your mentor’s time and experience.'], 'link_label' => 'Explore joining as a mentee'],
            ]],
            'matching' => ['label' => 'HOW MATCHING WORKS', 'title_line_one' => 'A connection shaped', 'title_emphasis' => 'around your goals.', 'introduction' => 'The intended process considers development needs, relevant experience and availability. A match is an invitation to a conversation, not a guarantee of a placement.', 'steps' => [
                ['icon' => 'identify', 'title' => 'Share your interests', 'description' => 'A future application will ask about your background, areas of interest, development goals and availability.'],
                ['icon' => 'connect', 'title' => 'Consider a suitable match', 'description' => 'The team will look for alignment between a mentee’s goals and a mentor’s experience, interests and capacity.'],
                ['icon' => 'mentor', 'title' => 'Agree the relationship', 'description' => 'Both participants should agree expectations, communication, boundaries and the purpose of their conversations.'],
                ['icon' => 'growth', 'title' => 'Reflect and progress', 'description' => 'Regular reflection helps both participants review progress and decide what support or next steps are useful.'],
            ]],
            'areas' => ['label' => 'MENTORSHIP AREAS', 'title_line_one' => 'Where could', 'title_emphasis' => 'guidance help?', 'introduction' => 'These areas reflect the network’s purpose. A future match will depend on the interests and experience of available mentors.'],
            'take_part' => ['label' => 'TAKE PART', 'title_line_one' => 'Make room', 'title_emphasis' => 'for someone’s next step.', 'introduction' => 'Explore the two ways to participate. This initiative is currently presented as a preview.', 'closed_label' => 'Applications not yet open', 'preview_label' => 'MENTORSHIP PREVIEW', 'preview_notice' => 'Applications are not being collected in this preview. Confirmed participation details will be published before applications open.', 'back_label' => 'Back to mentorship', 'roles' => [
                'mentor' => ['title' => 'Become a mentor', 'description' => 'Offer experience, perspective and encouragement to an emerging leader.', 'preparation' => 'Consider the areas where you can offer useful guidance, the experience you would bring and the time you could commit.', 'application_url' => null],
                'mentee' => ['title' => 'Join as a mentee', 'description' => 'Find space to reflect, ask questions and plan your next steps.', 'preparation' => 'Think about your development goals, the questions you want to explore and your availability for mentoring conversations.', 'application_url' => null],
            ]],
        ];
    }
}
