<?php

namespace Tests\Feature;

use App\Livewire\Admin\AboutPageEditor;
use App\Models\AboutPageContent;
use App\Models\User;
use App\Support\AboutPageDefaults;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Livewire\Livewire;
use Tests\TestCase;

class AboutPageContentManagementTest extends TestCase
{
    use RefreshDatabase;

    public function test_only_administrators_can_open_the_about_page_editor(): void
    {
        $this->get(route('admin.about-page.edit'))->assertRedirect(route('admin.login'));

        $this->actingAs(User::factory()->create())
            ->get(route('admin.about-page.edit'))
            ->assertForbidden();
    }

    public function test_editor_loads_every_about_page_section(): void
    {
        $administrator = User::factory()->superAdmin()->create();
        AboutPageContent::current();

        $this->actingAs($administrator)->get(route('admin.about-page.edit'))->assertOk()
            ->assertSee('Edit About page.')
            ->assertSee('Hero &amp; SEO', false)
            ->assertSee('Who we are')
            ->assertSee('Why we exist')
            ->assertSee('The problem')
            ->assertSee('Philosophy')
            ->assertSee('Our approach')
            ->assertSee('Our difference')
            ->assertSee('Closing message');
    }

    public function test_administrator_can_edit_content_and_publish_it_to_the_about_page(): void
    {
        $administrator = User::factory()->superAdmin()->create();
        AboutPageContent::current();

        Livewire::actingAs($administrator)
            ->test(AboutPageEditor::class)
            ->set('content.hero.title_line_one', 'A renewed shared purpose.')
            ->set('content.difference.cards.0.description', 'A changed public leadership commitment.')
            ->call('save')
            ->assertHasNoErrors()
            ->assertSet('saved', true)
            ->assertDispatched('dashboard-toast', message: 'About page changes were saved and published.', type: 'success');

        $record = AboutPageContent::current();
        $this->assertSame('A renewed shared purpose.', $record->content['hero']['title_line_one']);
        $this->assertSame($administrator->id, $record->updated_by);

        $this->get(route('about'))->assertOk()
            ->assertSee('A renewed shared purpose.')
            ->assertSee('A changed public leadership commitment.');
    }

    public function test_administrator_can_replace_about_page_images(): void
    {
        Storage::fake('public');
        $administrator = User::factory()->superAdmin()->create();
        AboutPageContent::current();

        Livewire::actingAs($administrator)
            ->test(AboutPageEditor::class)
            ->set('heroImage', UploadedFile::fake()->image('about-hero.jpg', 1200, 800))
            ->set('approachImage', UploadedFile::fake()->image('approach.png', 1200, 800))
            ->call('save')
            ->assertHasNoErrors();

        $content = AboutPageContent::current()->content;
        Storage::disk('public')->assertExists($content['hero']['image']);
        Storage::disk('public')->assertExists($content['approach']['image']);
    }

    public function test_restore_defaults_replaces_edited_content(): void
    {
        $administrator = User::factory()->superAdmin()->create();
        $content = AboutPageDefaults::content();
        $content['closing']['button_label'] = 'Changed label';
        AboutPageContent::current()->update(['content' => $content]);

        Livewire::actingAs($administrator)
            ->test(AboutPageEditor::class)
            ->call('restoreDefaults')
            ->assertSet('content.closing.button_label', AboutPageDefaults::content()['closing']['button_label']);
    }
}
