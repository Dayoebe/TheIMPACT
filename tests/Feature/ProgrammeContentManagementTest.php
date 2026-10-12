<?php

namespace Tests\Feature;

use App\Livewire\Admin\ProgrammeManager;
use App\Models\Programme;
use App\Models\ProgrammePageContent;
use App\Models\User;
use App\Support\ProgrammeMedia;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
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

    public function test_administrator_can_add_and_preview_uploaded_and_linked_programme_media(): void
    {
        Storage::fake('public');
        $administrator = User::factory()->superAdmin()->create();
        Programme::importDefaultsIfEmpty();
        $programme = Programme::query()->where('slug', 'christian-leadership')->firstOrFail();

        $component = Livewire::actingAs($administrator)
            ->test(ProgrammeManager::class)
            ->call('selectProgramme', $programme->id)
            ->set('mediaForms.image.title', 'Leadership workshop')
            ->set('mediaFiles.image', UploadedFile::fake()->image('workshop.jpg', 1200, 800))
            ->call('addMedia', 'image')
            ->assertHasNoErrors()
            ->assertDispatched('dashboard-toast', message: 'Image added to the programme media library.', type: 'success');

        $image = $programme->fresh()->media[0];
        Storage::disk('public')->assertExists($image['path']);

        $component
            ->set('mediaForms.image.title', 'Online programme picture')
            ->set('mediaForms.image.external_url', 'https://images.example.org/programme.jpg')
            ->call('addMedia', 'image')
            ->assertHasNoErrors()
            ->set('mediaForms.audio.title', 'Leadership conversation')
            ->set('mediaForms.audio.external_url', 'https://open.spotify.com/episode/123ABC')
            ->call('addMedia', 'audio')
            ->assertHasNoErrors()
            ->set('mediaForms.audio.title', 'Uploaded programme audio')
            ->set('mediaFiles.audio', UploadedFile::fake()->create('programme-audio.mp3', 1024, 'audio/mpeg'))
            ->call('addMedia', 'audio')
            ->assertHasNoErrors()
            ->set('mediaForms.video.title', 'Programme introduction')
            ->set('mediaForms.video.external_url', 'https://www.youtube.com/watch?v=dQw4w9WgXcQ')
            ->call('addMedia', 'video')
            ->assertHasNoErrors()
            ->set('mediaForms.video.title', 'Uploaded programme video')
            ->set('mediaFiles.video', UploadedFile::fake()->create('programme-video.mp4', 2048, 'video/mp4'))
            ->call('addMedia', 'video')
            ->assertHasNoErrors();

        $media = $programme->fresh()->media;
        $this->assertCount(6, $media);
        Storage::disk('public')->assertExists($media[3]['path']);
        Storage::disk('public')->assertExists($media[5]['path']);
        $this->get(route('programmes.show', $programme->slug))->assertOk()
            ->assertSee('Leadership workshop')
            ->assertSee('Online programme picture')
            ->assertSee('https://images.example.org/programme.jpg', false)
            ->assertSee('Leadership conversation')
            ->assertSee('https://open.spotify.com/embed/episode/123ABC', false)
            ->assertSee('Uploaded programme audio')
            ->assertSee('Programme introduction')
            ->assertSee('https://www.youtube-nocookie.com/embed/dQw4w9WgXcQ', false)
            ->assertSee('Uploaded programme video');
    }

    public function test_administrator_sees_media_previews_before_saving_them(): void
    {
        Storage::fake('public');
        $administrator = User::factory()->superAdmin()->create();
        Programme::importDefaultsIfEmpty();
        $programme = Programme::query()->where('slug', 'christian-leadership')->firstOrFail();

        $component = Livewire::actingAs($administrator)
            ->test(ProgrammeManager::class)
            ->call('selectProgramme', $programme->id)
            ->set('mediaForms.video.external_url', 'https://www.youtube.com/watch?v=dQw4w9WgXcQ')
            ->assertSee('Instant preview')
            ->assertSee('https://www.youtube-nocookie.com/embed/dQw4w9WgXcQ', false)
            ->set('mediaForms.image.external_url', 'https://images.example.org/programme.jpg')
            ->assertSee('https://images.example.org/programme.jpg', false)
            ->set('mediaFiles.audio', UploadedFile::fake()->create('preview.mp3', 256, 'audio/mpeg'))
            ->assertSee('<audio controls', false);

        $this->assertNotEmpty($component->instance()->pendingMediaPreview('audio')['resolved_url']);
        $this->assertNull($programme->fresh()->media);
    }

    public function test_removing_uploaded_media_deletes_its_managed_file(): void
    {
        Storage::fake('public');
        $administrator = User::factory()->superAdmin()->create();
        Programme::importDefaultsIfEmpty();
        $programme = Programme::query()->where('slug', 'christian-leadership')->firstOrFail();

        $component = Livewire::actingAs($administrator)
            ->test(ProgrammeManager::class)
            ->call('selectProgramme', $programme->id)
            ->set('mediaForms.image.title', 'Temporary picture')
            ->set('mediaFiles.image', UploadedFile::fake()->image('temporary.jpg'))
            ->call('addMedia', 'image');

        $path = $programme->fresh()->media[0]['path'];
        Storage::disk('public')->assertExists($path);

        $component->call('removeMedia', 0)->assertHasNoErrors();

        Storage::disk('public')->assertMissing($path);
        $this->assertSame([], $programme->fresh()->media);
    }

    public function test_supported_media_platform_links_are_converted_to_safe_embeds(): void
    {
        $this->assertSame(
            'https://audiomack.com/embed/impact/song/leadership-conversation',
            ProgrammeMedia::embedUrl(['type' => 'audio', 'source' => 'link', 'url' => 'https://audiomack.com/impact/song/leadership-conversation']),
        );
        $this->assertSame(
            'https://w.soundcloud.com/player/?url=https%3A%2F%2Fsoundcloud.com%2Fimpact%2Fleadership',
            ProgrammeMedia::embedUrl(['type' => 'audio', 'source' => 'link', 'url' => 'https://soundcloud.com/impact/leadership']),
        );
        $this->assertSame(
            'https://player.vimeo.com/video/123456789',
            ProgrammeMedia::embedUrl(['type' => 'video', 'source' => 'link', 'url' => 'https://vimeo.com/123456789']),
        );
        $this->assertNull(
            ProgrammeMedia::embedUrl(['type' => 'video', 'source' => 'link', 'url' => 'https://untrusted.example.org/watch/123']),
        );
    }
}
