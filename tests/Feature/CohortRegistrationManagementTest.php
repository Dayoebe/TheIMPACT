<?php

namespace Tests\Feature;

use App\Livewire\Admin\CohortRegistrationManager;
use App\Livewire\CohortsRegistrationPage;
use App\Models\CohortPageContent;
use App\Models\Programme;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\TestCase;

class CohortRegistrationManagementTest extends TestCase
{
    use RefreshDatabase;

    public function test_public_page_lists_published_programme_cohorts_and_registration_state(): void
    {
        $response = $this->get(route('programmes.cohorts'))->assertOk()
            ->assertSeeLivewire(CohortsRegistrationPage::class)
            ->assertSee('Leadership Development')
            ->assertSee('Foundations cohort · preview')
            ->assertSee('Registration not open');

        $this->assertDatabaseCount('programmes', 6);
    }

    public function test_only_administrators_can_manage_cohorts(): void
    {
        $this->get(route('admin.cohorts.index'))->assertRedirect(route('admin.login'));
        $this->actingAs(User::factory()->create())->get(route('admin.cohorts.index'))->assertForbidden();
    }

    public function test_administrator_can_update_a_schedule_and_open_registration(): void
    {
        $administrator = User::factory()->superAdmin()->create();
        Programme::importDefaultsIfEmpty();
        $programme = Programme::query()->where('slug', 'christian-leadership')->firstOrFail();

        Livewire::actingAs($administrator)
            ->test(CohortRegistrationManager::class)
            ->call('selectProgramme', $programme->id)
            ->set('cohorts.0.name', 'Confirmed leadership cohort')
            ->set('cohorts.0.starts', '15 January 2027')
            ->set('registrationUrl', 'https://example.org/register/leadership')
            ->call('saveProgrammeSchedule')
            ->assertHasNoErrors()
            ->assertSet('saved', true);

        $programme->refresh();
        $this->assertSame($administrator->id, $programme->updated_by);
        $this->assertSame('Confirmed leadership cohort', $programme->cohorts[0]['name']);

        $this->get(route('programmes.cohorts'))->assertOk()
            ->assertSee('Confirmed leadership cohort')
            ->assertSee('15 January 2027')
            ->assertSee('href="https://example.org/register/leadership"', false)
            ->assertSee('Registration open');
    }

    public function test_draft_programmes_are_not_exposed_in_the_cohort_directory(): void
    {
        Programme::factory()->create(['name' => 'Private Draft Cohort', 'status' => 'draft']);

        $this->get(route('programmes.cohorts'))->assertOk()->assertDontSee('Private Draft Cohort');
    }

    public function test_administrator_can_update_public_cohort_page_content(): void
    {
        $administrator = User::factory()->superAdmin()->create();

        Livewire::actingAs($administrator)
            ->test(CohortRegistrationManager::class)
            ->set('pageContent.hero.title', 'A renewed cohort directory.')
            ->call('savePage')
            ->assertHasNoErrors();

        $this->assertSame($administrator->id, CohortPageContent::current()->updated_by);
        $this->get(route('programmes.cohorts'))->assertOk()->assertSee('A renewed cohort directory.');
    }

    public function test_programmes_navigation_exposes_directory_and_cohorts(): void
    {
        $response = $this->get(route('programmes.cohorts'))->assertOk();

        $response->assertSee('Programme Directory')
            ->assertSee('Cohorts & Registration', false)
            ->assertSee('href="'.route('programmes.index').'"', false)
            ->assertSee('href="'.route('programmes.cohorts').'"', false);
    }
}
