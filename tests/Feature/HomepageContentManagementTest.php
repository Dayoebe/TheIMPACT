<?php

namespace Tests\Feature;

use App\Livewire\Admin\HomepageEditor;
use App\Models\HomepageContent;
use App\Models\User;
use App\Support\HomepageDefaults;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Livewire\Livewire;
use Tests\TestCase;

class HomepageContentManagementTest extends TestCase
{
    use RefreshDatabase;

    public function test_only_administrators_can_open_the_homepage_editor(): void
    {
        $this->get(route('admin.homepage.edit'))->assertRedirect(route('admin.login'));

        $this->actingAs(User::factory()->create())
            ->get(route('admin.homepage.edit'))
            ->assertForbidden();
    }

    public function test_editor_loads_every_existing_homepage_section(): void
    {
        $administrator = User::factory()->superAdmin()->create();
        HomepageContent::current();

        $this->actingAs($administrator)->get(route('admin.homepage.edit'))->assertOk()
            ->assertSee('Edit homepage.')
            ->assertSee('Hero section')
            ->assertSee('Philosophy strip')
            ->assertSee('President &amp; Convener', false)
            ->assertSee('Vision &amp; mission', false)
            ->assertSee('Focus areas')
            ->assertSee('The journey')
            ->assertSee('Programme pathways')
            ->assertSee('Mentorship invitation')
            ->assertSee('Where to begin')
            ->assertSee('Closing message');
    }

    public function test_administrator_can_edit_content_and_publish_it_to_the_homepage(): void
    {
        $administrator = User::factory()->superAdmin()->create();
        HomepageContent::current();

        Livewire::actingAs($administrator)
            ->test(HomepageEditor::class)
            ->set('content.hero.title_line_one', 'A changed homepage heading.')
            ->set('content.focus.areas.0.description', 'A changed governance description.')
            ->set('content.participate.title_emphasis', 'clear next step.')
            ->call('save')
            ->assertHasNoErrors()
            ->assertSet('saved', true)
            ->assertDispatched('dashboard-toast', message: 'Homepage changes were saved and published.', type: 'success');

        $record = HomepageContent::current();
        $this->assertSame('A changed homepage heading.', $record->content['hero']['title_line_one']);
        $this->assertSame($administrator->id, $record->updated_by);

        $this->get(route('home'))->assertOk()
            ->assertSee('A changed homepage heading.')
            ->assertSee('A changed governance description.')
            ->assertSee('clear next step.');
    }

    public function test_administrator_can_replace_homepage_images(): void
    {
        Storage::fake('public');
        $administrator = User::factory()->superAdmin()->create();
        HomepageContent::current();

        Livewire::actingAs($administrator)
            ->test(HomepageEditor::class)
            ->set('heroImage', UploadedFile::fake()->image('hero.jpg', 1200, 800))
            ->set('aboutImage', UploadedFile::fake()->image('community.png', 1200, 800))
            ->set('founderImage', UploadedFile::fake()->image('president.jpg', 900, 1200))
            ->call('save')
            ->assertHasNoErrors();

        $content = HomepageContent::current()->content;
        Storage::disk('public')->assertExists($content['hero']['image']);
        Storage::disk('public')->assertExists($content['about']['image']);
        Storage::disk('public')->assertExists($content['founder']['image']);
    }

    public function test_homepage_introduces_the_president_and_convener(): void
    {
        $this->get(route('home'))->assertOk()
            ->assertSee('Pst. Feyisara Samuel')
            ->assertSee('President &amp; Convener', false)
            ->assertSee('the person behind the initiative')
            ->assertSee('images/pst-feyisara-samuel.jpg', false);
    }

    public function test_restore_defaults_replaces_edited_content(): void
    {
        $administrator = User::factory()->superAdmin()->create();
        $content = HomepageDefaults::content();
        $content['closing']['button_label'] = 'Changed label';
        HomepageContent::current()->update(['content' => $content]);

        Livewire::actingAs($administrator)
            ->test(HomepageEditor::class)
            ->call('restoreDefaults')
            ->assertSet('content.closing.button_label', HomepageDefaults::content()['closing']['button_label']);
    }
}
