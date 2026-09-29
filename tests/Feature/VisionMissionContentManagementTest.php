<?php

namespace Tests\Feature;

use App\Livewire\Admin\VisionMissionEditor;
use App\Models\User;
use App\Models\VisionMissionContent;
use App\Support\VisionMissionDefaults;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\TestCase;

class VisionMissionContentManagementTest extends TestCase
{
    use RefreshDatabase;

    public function test_only_administrators_can_open_the_vision_and_mission_editor(): void
    {
        $this->get(route('admin.vision-mission.edit'))->assertRedirect(route('admin.login'));

        $this->actingAs(User::factory()->create())
            ->get(route('admin.vision-mission.edit'))
            ->assertForbidden();
    }

    public function test_editor_loads_every_vision_and_mission_section(): void
    {
        $administrator = User::factory()->superAdmin()->create();
        VisionMissionContent::current();

        $this->actingAs($administrator)->get(route('admin.vision-mission.edit'))->assertOk()
            ->assertSee('Edit Vision & Mission.', false)
            ->assertSee('Hero &amp; SEO', false)
            ->assertSee('Our vision')
            ->assertSee('Our mission')
            ->assertSee('Six-part philosophy')
            ->assertSee('Closing message');
    }

    public function test_administrator_can_publish_changes_to_the_public_page(): void
    {
        $administrator = User::factory()->superAdmin()->create();
        VisionMissionContent::current();

        Livewire::actingAs($administrator)
            ->test(VisionMissionEditor::class)
            ->set('content.vision.statement', 'A renewed vision for responsible leadership.')
            ->set('content.mission.steps.0.description', 'A renewed first step for emerging leaders.')
            ->call('save')
            ->assertHasNoErrors()
            ->assertSet('saved', true);

        $record = VisionMissionContent::current();
        $this->assertSame($administrator->id, $record->updated_by);

        $this->get(route('about.vision-mission'))->assertOk()
            ->assertSee('A renewed vision for responsible leadership.')
            ->assertSee('A renewed first step for emerging leaders.');
    }

    public function test_restore_defaults_replaces_edited_content(): void
    {
        $administrator = User::factory()->superAdmin()->create();
        $content = VisionMissionDefaults::content();
        $content['closing']['button_label'] = 'Changed label';
        VisionMissionContent::current()->update(['content' => $content]);

        Livewire::actingAs($administrator)
            ->test(VisionMissionEditor::class)
            ->call('restoreDefaults')
            ->assertSet('content.closing.button_label', VisionMissionDefaults::content()['closing']['button_label']);
    }

    public function test_public_navigation_exposes_the_about_pages_as_a_group(): void
    {
        $response = $this->get(route('about.vision-mission'))->assertOk();

        $response->assertSee('class="nav-dropdown"', false)
            ->assertSee('About overview')
            ->assertSee('Vision &amp; Mission', false)
            ->assertSee('href="'.route('about').'"', false)
            ->assertSee('href="'.route('about.vision-mission').'"', false);
    }
}
