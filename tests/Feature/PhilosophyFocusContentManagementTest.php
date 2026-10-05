<?php

namespace Tests\Feature;

use App\Livewire\Admin\PhilosophyFocusEditor;
use App\Livewire\PhilosophyFocusPage;
use App\Models\PhilosophyFocusContent;
use App\Models\User;
use App\Support\PhilosophyFocusDefaults;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\TestCase;

class PhilosophyFocusContentManagementTest extends TestCase
{
    use RefreshDatabase;

    public function test_public_page_contains_the_complete_philosophy_and_focus_areas(): void
    {
        $response = $this->get(route('about.philosophy-focus'))->assertOk()
            ->assertSeeLivewire(PhilosophyFocusPage::class)
            ->assertSee('<title>Philosophy &amp; Focus Areas — THE IMPACT</title>', false);

        foreach (config('impact.philosophy') as $value) {
            $response->assertSee($value['name'])->assertSee($value['description']);
        }

        foreach (PhilosophyFocusDefaults::content()['focus']['areas'] as $area) {
            $response->assertSee($area['name'])->assertSee($area['description']);
        }
    }

    public function test_only_administrators_can_open_the_editor(): void
    {
        $this->get(route('admin.philosophy-focus.edit'))->assertRedirect(route('admin.login'));
        $this->actingAs(User::factory()->create())->get(route('admin.philosophy-focus.edit'))->assertForbidden();
    }

    public function test_administrator_can_publish_changes_to_the_public_page(): void
    {
        $administrator = User::factory()->superAdmin()->create();
        PhilosophyFocusContent::current();

        Livewire::actingAs($administrator)
            ->test(PhilosophyFocusEditor::class)
            ->set('content.philosophy.values.0.description', 'A renewed statement about faith and public responsibility.')
            ->set('content.focus.areas.0.title', 'Govern with renewed integrity.')
            ->call('save')
            ->assertHasNoErrors()
            ->assertSet('saved', true)
            ->assertDispatched('dashboard-toast', message: 'Philosophy and focus area changes were saved and published.', type: 'success');

        $record = PhilosophyFocusContent::current();
        $this->assertSame($administrator->id, $record->updated_by);

        $this->get(route('about.philosophy-focus'))->assertOk()
            ->assertSee('A renewed statement about faith and public responsibility.')
            ->assertSee('Govern with renewed integrity.');
    }

    public function test_restore_defaults_replaces_edited_content(): void
    {
        $administrator = User::factory()->superAdmin()->create();
        $content = PhilosophyFocusDefaults::content();
        $content['closing']['button_label'] = 'Changed label';
        PhilosophyFocusContent::current()->update(['content' => $content]);

        Livewire::actingAs($administrator)
            ->test(PhilosophyFocusEditor::class)
            ->call('restoreDefaults')
            ->assertSet('content.closing.button_label', PhilosophyFocusDefaults::content()['closing']['button_label']);
    }

    public function test_navigation_contains_the_philosophy_and_focus_page(): void
    {
        $response = $this->get(route('about'))->assertOk();

        $response->assertSee('Philosophy & Focus Areas', false)
            ->assertSee('href="'.route('about.philosophy-focus').'"', false);
    }
}
