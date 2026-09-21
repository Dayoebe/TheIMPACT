<?php

namespace Tests\Feature;

use App\Livewire\ProgrammeDetailPage;
use App\Livewire\ProgrammesPage;
use Livewire\Features\SupportLockedProperties\CannotUpdateLockedPropertyException;
use Livewire\Livewire;
use Tests\TestCase;

class ProgrammePagesTest extends TestCase
{
    public function test_directory_links_to_all_six_programme_details(): void
    {
        $programmes = config('programmes');
        $this->assertCount(6, $programmes);
        $response = $this->get(route('programmes.index'))->assertOk()->assertSeeLivewire(ProgrammesPage::class);

        foreach ($programmes as $slug => $programme) {
            $response->assertSee($programme['name'])
                ->assertSee('href="'.route('programmes.show', $slug).'"', false);
        }
    }

    public function test_each_programme_has_its_own_metadata_and_all_required_detail_sections(): void
    {
        foreach (config('programmes') as $slug => $programme) {
            $response = $this->get(route('programmes.show', $slug))->assertOk()
                ->assertSeeLivewire(ProgrammeDetailPage::class)
                ->assertSee('<title>'.e($programme['name'].' — Programmes | THE IMPACT').'</title>', false)
                ->assertSee($programme['overview'])
                ->assertSee($programme['audience'])
                ->assertSee($programme['duration'])
                ->assertSee('Illustrative programme.')
                ->assertSee('This preview does not collect personal information or reserve a place.');

            foreach (['overview', 'objectives', 'audience', 'curriculum', 'facilitators', 'cohorts', 'registration'] as $section) {
                $response->assertSee('id="'.$section.'"', false);
            }
            foreach ($programme['curriculum'] as $module) {
                $response->assertSee($module['title'])->assertSee($module['description']);
            }
            foreach ($programme['objectives'] as $objective) {
                $response->assertSee($objective);
            }
        }
    }

    public function test_unknown_or_malformed_programme_slugs_return_not_found(): void
    {
        foreach (['not-a-programme', 'christian-leadership.name', 'CHRISTIAN-LEADERSHIP', 'christian--leadership'] as $slug) {
            $this->get('/programmes/'.$slug)->assertNotFound();
        }
    }

    public function test_missing_programme_schedule_fields_have_honest_fallbacks(): void
    {
        config([
            'programmes.christian-leadership.duration' => null,
            'programmes.christian-leadership.facilitators' => [],
            'programmes.christian-leadership.cohorts' => [],
        ]);

        $this->get(route('programmes.show', 'christian-leadership'))->assertOk()
            ->assertSee('To be announced')
            ->assertSee('Facilitators will be announced')
            ->assertSee('No upcoming cohorts have been announced.')
            ->assertSee('Preview registration');
    }

    public function test_programme_content_is_escaped(): void
    {
        config(['programmes.christian-leadership.headline' => '<script>alert("test")</script>']);

        $this->get(route('programmes.show', 'christian-leadership'))->assertOk()
            ->assertSee('&lt;script&gt;', false)
            ->assertDontSee('<script>alert("test")</script>', false);
    }

    public function test_confirmed_programme_registration_link_can_replace_the_preview(): void
    {
        config(['programmes.christian-leadership.registration_url' => 'https://example.org/apply/leadership']);

        $this->get(route('programmes.show', 'christian-leadership'))->assertOk()
            ->assertSee('href="https://example.org/apply/leadership"', false)
            ->assertSee('Register for this programme')
            ->assertDontSee('Preview registration');
    }

    public function test_programme_identity_cannot_be_changed_in_a_livewire_update(): void
    {
        $this->expectException(CannotUpdateLockedPropertyException::class);

        Livewire::test(ProgrammeDetailPage::class, ['slug' => 'christian-leadership'])
            ->set('slug', 'not-a-programme');
    }
}
