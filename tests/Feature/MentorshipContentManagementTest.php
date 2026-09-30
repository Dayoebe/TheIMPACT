<?php

namespace Tests\Feature;

use App\Livewire\Admin\MentorshipEditor;
use App\Models\MentorshipPageContent;
use App\Models\User;
use App\Support\MentorshipPageDefaults;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Livewire\Livewire;
use Tests\TestCase;

class MentorshipContentManagementTest extends TestCase
{
    use RefreshDatabase;

    public function test_only_administrators_can_open_the_mentorship_editor(): void
    {
        $this->get(route('admin.mentorship.edit'))->assertRedirect(route('admin.login'));
        $this->actingAs(User::factory()->create())->get(route('admin.mentorship.edit'))->assertForbidden();
    }

    public function test_editor_loads_every_mentorship_section(): void
    {
        $administrator = User::factory()->superAdmin()->create();

        $this->actingAs($administrator)->get(route('admin.mentorship.edit'))->assertOk()
            ->assertSee('Edit Mentorship.')
            ->assertSee('Why mentorship matters')
            ->assertSee('Who it is for')
            ->assertSee('Matching process')
            ->assertSee('Take part');
    }

    public function test_administrator_can_publish_content_and_application_links(): void
    {
        $administrator = User::factory()->superAdmin()->create();

        Livewire::actingAs($administrator)
            ->test(MentorshipEditor::class)
            ->set('content.hero.title', 'Grow through purposeful guidance.')
            ->set('content.take_part.roles.mentor.application_url', 'https://example.org/mentor/apply')
            ->call('save')
            ->assertHasNoErrors()
            ->assertSet('saved', true);

        $record = MentorshipPageContent::current();
        $this->assertSame($administrator->id, $record->updated_by);
        $this->get(route('mentorship'))->assertOk()
            ->assertSee('Grow through purposeful guidance.')
            ->assertSee('href="https://example.org/mentor/apply"', false);
    }

    public function test_administrator_can_replace_the_mentorship_image(): void
    {
        Storage::fake('public');
        $administrator = User::factory()->superAdmin()->create();

        Livewire::actingAs($administrator)
            ->test(MentorshipEditor::class)
            ->set('whyImage', UploadedFile::fake()->image('mentorship.jpg', 1200, 800))
            ->call('save')
            ->assertHasNoErrors();

        Storage::disk('public')->assertExists(MentorshipPageContent::current()->content['why']['image']);
    }

    public function test_restore_defaults_closes_application_links(): void
    {
        $administrator = User::factory()->superAdmin()->create();
        $content = MentorshipPageDefaults::content();
        $content['take_part']['roles']['mentor']['application_url'] = 'https://example.org/apply';
        MentorshipPageContent::current()->update(['content' => $content]);

        Livewire::actingAs($administrator)
            ->test(MentorshipEditor::class)
            ->call('restoreDefaults')
            ->assertSet('content.take_part.roles.mentor.application_url', null);
    }
}
