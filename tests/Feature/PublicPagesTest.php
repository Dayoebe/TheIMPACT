<?php

namespace Tests\Feature;

use App\Livewire\LeadershipPage;
use App\Livewire\MentorshipPage;
use App\Livewire\VisionMissionPage;
use App\Models\MentorshipPageContent;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PublicPagesTest extends TestCase
{
    use RefreshDatabase;

    public function test_vision_and_mission_page_contains_the_complete_statements_and_philosophy(): void
    {
        $response = $this->get(route('about.vision-mission'));

        $response->assertOk()->assertSeeLivewire(VisionMissionPage::class)
            ->assertSee(config('impact.vision'))
            ->assertSee(config('impact.mission'))
            ->assertSeeInOrder(['Identify', 'Connect', 'Equip', 'Mentor', 'Deploy'])
            ->assertSee('<title>Vision &amp; Mission — THE IMPACT</title>', false);

        foreach (config('impact.philosophy') as $value) {
            $response->assertSee($value['description']);
        }
    }

    public function test_leadership_directory_only_renders_confirmed_profiles(): void
    {
        $response = $this->get(route('leadership'))->assertOk()->assertSeeLivewire(LeadershipPage::class)
            ->assertSee('Pst. Feyisara Samuel')
            ->assertSee('PRESIDENT &amp; CONVENER', false)
            ->assertDontSee('SAMPLE PROFILE')
            ->assertDontSee('illustrative content')
            ->assertDontSee('Grace Okafor');
    }

    public function test_mentorship_explains_participation_without_inactive_application_controls(): void
    {
        $this->get(route('mentorship'))->assertOk()->assertSeeLivewire(MentorshipPage::class)
            ->assertSeeInOrder(['WHY MENTORSHIP MATTERS', 'WHO THE INITIATIVE IS FOR', 'HOW MATCHING WORKS', 'MENTORSHIP AREAS', 'TAKE PART'])
            ->assertSee('id="become-a-mentor"', false)
            ->assertSee('id="join-as-a-mentee"', false)
            ->assertSee('Consider the areas where you can offer useful guidance')
            ->assertDontSee('Applications not yet open')
            ->assertDontSee('<dialog', false)
            ->assertDontSee('type="email"', false);
    }

    public function test_confirmed_mentorship_application_links_are_displayed(): void
    {
        $record = MentorshipPageContent::current();
        $content = $record->content;
        $content['take_part']['roles']['mentor']['application_url'] = 'https://example.org/apply/mentor';
        $content['take_part']['roles']['mentee']['application_url'] = 'https://example.org/apply/mentee';
        $record->update(['content' => $content]);

        $this->get(route('mentorship'))->assertOk()
            ->assertSee('href="https://example.org/apply/mentor"', false)
            ->assertSee('href="https://example.org/apply/mentee"', false)
            ->assertDontSee('Applications not yet open');
    }

    public function test_shared_navigation_reaches_every_public_page_and_has_one_active_mobile_item(): void
    {
        foreach (['home', 'about', 'about.vision-mission', 'about.philosophy-focus', 'leadership', 'programmes.index', 'programmes.cohorts', 'mentorship'] as $routeName) {
            $response = $this->get(route($routeName))->assertOk();
            foreach (['home', 'about', 'about.vision-mission', 'about.philosophy-focus', 'leadership', 'programmes.index', 'programmes.cohorts', 'mentorship'] as $destination) {
                $response->assertSee('href="'.route($destination).'"', false);
            }
            preg_match('/<nav class="app-nav".*?<\/nav>/s', $response->getContent(), $matches);
            $this->assertNotEmpty($matches, $routeName);
            $this->assertSame(1, substr_count($matches[0], 'aria-current="page"'), $routeName);
        }
    }
}
