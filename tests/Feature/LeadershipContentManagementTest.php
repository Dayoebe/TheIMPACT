<?php

namespace Tests\Feature;

use App\Livewire\Admin\LeadershipEditor;
use App\Models\LeadershipPageContent;
use App\Models\User;
use App\Support\LeadershipPageDefaults;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\TestCase;

class LeadershipContentManagementTest extends TestCase
{
    use RefreshDatabase;

    public function test_only_administrators_can_open_the_leadership_editor(): void
    {
        $this->get(route('admin.leadership.edit'))->assertRedirect(route('admin.login'));
        $this->actingAs(User::factory()->create())->get(route('admin.leadership.edit'))->assertForbidden();
    }

    public function test_editor_loads_the_directory_and_profiles(): void
    {
        $administrator = User::factory()->superAdmin()->create();

        $this->actingAs($administrator)->get(route('admin.leadership.edit'))->assertOk()
            ->assertSee('Edit Leadership.')
            ->assertSee('Directory disclosure')
            ->assertSee('Founder / President')
            ->assertSee('Pastor Feyisara Samuel');
    }

    public function test_administrator_can_publish_page_and_profile_changes(): void
    {
        $administrator = User::factory()->superAdmin()->create();

        Livewire::actingAs($administrator)
            ->test(LeadershipEditor::class)
            ->set('content.hero.title', 'Leadership shaped by service.')
            ->set('content.directory.groups.0.people.0.role', 'Founding Convener')
            ->call('save')
            ->assertHasNoErrors()
            ->assertSet('saved', true);

        $record = LeadershipPageContent::current();
        $this->assertSame($administrator->id, $record->updated_by);
        $this->get(route('leadership'))->assertOk()
            ->assertSee('Leadership shaped by service.')
            ->assertSee('Founding Convener');
    }

    public function test_administrator_can_add_and_remove_profiles(): void
    {
        $administrator = User::factory()->superAdmin()->create();

        Livewire::actingAs($administrator)
            ->test(LeadershipEditor::class)
            ->call('addPerson', 0)
            ->assertSet('content.directory.groups.0.people.1.name', 'New profile')
            ->call('removePerson', 0, 1)
            ->assertCount('content.directory.groups.0.people', 1);
    }

    public function test_restore_defaults_replaces_edited_content(): void
    {
        $administrator = User::factory()->superAdmin()->create();
        $content = LeadershipPageDefaults::content();
        $content['hero']['title'] = 'Changed title';
        LeadershipPageContent::current()->update(['content' => $content]);

        Livewire::actingAs($administrator)
            ->test(LeadershipEditor::class)
            ->call('restoreDefaults')
            ->assertSet('content.hero.title', LeadershipPageDefaults::content()['hero']['title']);
    }
}
