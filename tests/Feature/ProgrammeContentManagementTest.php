<?php

namespace Tests\Feature;

use App\Livewire\Admin\ProgrammeManager;
use App\Models\Programme;
use App\Models\ProgrammePageContent;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\TestCase;

class ProgrammeContentManagementTest extends TestCase
{
    use RefreshDatabase;

    public function test_only_administrators_can_manage_programmes(): void
    {
        $this->get(route('admin.programmes.index'))->assertRedirect(route('admin.login'));
        $this->actingAs(User::factory()->create())->get(route('admin.programmes.index'))->assertForbidden();
    }

    public function test_manager_imports_and_displays_the_existing_catalogue(): void
    {
        $administrator = User::factory()->superAdmin()->create();

        $this->actingAs($administrator)->get(route('admin.programmes.index'))->assertOk()
            ->assertSee('Manage programmes.')
            ->assertSee('Leadership Development')
            ->assertSee('Governance &amp; Public Policy', false);

        $this->assertDatabaseCount('programmes', 6);
    }

    public function test_administrator_can_edit_and_publish_a_programme(): void
    {
        $administrator = User::factory()->superAdmin()->create();
        Programme::importDefaultsIfEmpty();
        $programme = Programme::query()->where('slug', 'christian-leadership')->firstOrFail();

        Livewire::actingAs($administrator)
            ->test(ProgrammeManager::class)
            ->call('selectProgramme', $programme->id)
            ->set('programme.headline', 'A renewed leadership pathway.')
            ->set('programme.status', 'published')
            ->call('saveProgramme')
            ->assertHasNoErrors()
            ->assertSet('saved', true)
            ->assertDispatched('dashboard-toast', message: 'The programme was saved successfully.', type: 'success');

        $this->assertSame($administrator->id, $programme->fresh()->updated_by);
        $this->get(route('programmes.show', $programme->slug))->assertOk()->assertSee('A renewed leadership pathway.');
    }

    public function test_draft_programmes_stay_private_until_published(): void
    {
        $administrator = User::factory()->superAdmin()->create();

        Livewire::actingAs($administrator)
            ->test(ProgrammeManager::class)
            ->call('newProgramme')
            ->set('programme.slug', 'emerging-leaders-lab')
            ->set('programme.name', 'Emerging Leaders Lab')
            ->set('programme.headline', 'Prepare to lead with purpose.')
            ->set('programme.category', 'Leadership')
            ->set('programme.summary', 'A clearly labelled draft programme summary.')
            ->set('programme.overview', 'A clearly labelled draft programme overview.')
            ->set('programme.audience', 'Emerging young leaders.')
            ->set('programme.objectives.0', 'Develop one practical leadership goal.')
            ->set('programme.curriculum.0.title', 'Purpose and preparation')
            ->set('programme.curriculum.0.description', 'Connect personal purpose with practical preparation.')
            ->call('saveProgramme')
            ->assertHasNoErrors();

        $this->assertDatabaseHas('programmes', ['slug' => 'emerging-leaders-lab', 'status' => 'draft']);
        $this->get(route('programmes.show', 'emerging-leaders-lab'))->assertNotFound();
        $this->get(route('programmes.index'))->assertDontSee('Emerging Leaders Lab');
    }

    public function test_administrator_can_update_the_directory_page_copy(): void
    {
        $administrator = User::factory()->superAdmin()->create();

        Livewire::actingAs($administrator)
            ->test(ProgrammeManager::class)
            ->set('pageContent.hero.title', 'A renewed programme directory.')
            ->call('savePage')
            ->assertHasNoErrors();

        $this->assertSame($administrator->id, ProgrammePageContent::current()->updated_by);
        $this->get(route('programmes.index'))->assertOk()->assertSee('A renewed programme directory.');
    }
}
