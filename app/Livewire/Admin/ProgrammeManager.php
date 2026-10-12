<?php

namespace App\Livewire\Admin;

use App\Models\Programme;
use App\Models\ProgrammePageContent;
use App\Support\InteractsWithDashboardNotifications;
use App\Support\ProgrammeDefaults;
use App\Support\ProgrammeMedia;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Illuminate\View\View;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\Features\SupportFileUploads\WithFileUploads;

#[Layout('layouts.admin')]
class ProgrammeManager extends Component
{
    use InteractsWithDashboardNotifications;
    use WithFileUploads;

    /** @var array<string, mixed> */
    public array $pageContent = [];

    /** @var array<string, mixed> */
    public array $programme = [];

    public ?int $programmeId = null;

    public bool $saved = false;

    /** @var array{type: string, title: string, external_url: string} */
    public array $mediaForm = ['type' => 'image', 'title' => '', 'external_url' => ''];

    public mixed $mediaFile = null;

    public function mount(): void
    {
        Programme::importDefaultsIfEmpty();
        $this->pageContent = ProgrammePageContent::current()->content;
        $firstProgramme = Programme::query()->orderBy('sort_order')->orderBy('id')->first();

        $firstProgramme ? $this->selectProgramme($firstProgramme->id) : $this->newProgramme();
    }

    /** @return Collection<int, Programme> */
    public function getProgrammesProperty(): Collection
    {
        return Programme::query()->orderBy('sort_order')->orderBy('id')->get();
    }

    public function selectProgramme(int $programmeId): void
    {
        $record = Programme::query()->findOrFail($programmeId);
        $this->programmeId = $record->id;
        $this->programme = $record->only(['slug', 'name', 'headline', 'icon', 'category', 'summary', 'overview', 'audience', 'duration', 'registration_url', 'objectives', 'curriculum', 'facilitators', 'cohorts', 'status', 'sort_order']);
        $this->programme['media'] = $record->media ?? [];
        $this->resetMediaForm();
        $this->saved = false;
        $this->resetValidation();
    }

    public function newProgramme(): void
    {
        $this->programmeId = null;
        $this->programme = [
            'slug' => '', 'name' => '', 'headline' => '', 'icon' => 'equip', 'category' => '', 'summary' => '', 'overview' => '', 'audience' => '', 'duration' => '', 'registration_url' => null,
            'objectives' => [''], 'curriculum' => [['title' => '', 'description' => '']], 'facilitators' => [], 'cohorts' => [], 'media' => [], 'status' => 'draft', 'sort_order' => (int) Programme::query()->max('sort_order') + 1,
        ];
        $this->resetMediaForm();
        $this->saved = false;
        $this->resetValidation();
    }

    /** @return array<string, mixed> */
    protected function rules(): array
    {
        return [
            'pageContent.meta.*' => ['required', 'string', 'max:500'],
            'pageContent.hero.*' => ['required', 'string', 'max:1000'],
            'pageContent.directory.*' => ['required', 'string', 'max:1000'],
            'pageContent.mentorship.*' => ['required', 'string', 'max:1000'],
            'programme.slug' => ['required', 'string', 'max:160', 'regex:/^[a-z0-9]+(?:-[a-z0-9]+)*$/', Rule::unique('programmes', 'slug')->ignore($this->programmeId)],
            'programme.name' => ['required', 'string', 'max:200'],
            'programme.headline' => ['required', 'string', 'max:300'],
            'programme.icon' => ['required', 'string', 'max:50'],
            'programme.category' => ['required', 'string', 'max:150'],
            'programme.summary' => ['required', 'string', 'max:1000'],
            'programme.overview' => ['required', 'string', 'max:4000'],
            'programme.audience' => ['required', 'string', 'max:2000'],
            'programme.duration' => ['nullable', 'string', 'max:150'],
            'programme.registration_url' => ['nullable', 'url:http,https', 'max:500'],
            'programme.objectives' => ['required', 'array', 'min:1', 'max:12'],
            'programme.objectives.*' => ['required', 'string', 'max:1000'],
            'programme.curriculum' => ['required', 'array', 'min:1', 'max:20'],
            'programme.curriculum.*.title' => ['required', 'string', 'max:200'],
            'programme.curriculum.*.description' => ['required', 'string', 'max:2000'],
            'programme.facilitators' => ['array', 'max:20'],
            'programme.facilitators.*.name' => ['required', 'string', 'max:200'],
            'programme.facilitators.*.role' => ['required', 'string', 'max:300'],
            'programme.cohorts' => ['array', 'max:20'],
            'programme.cohorts.*.name' => ['required', 'string', 'max:200'],
            'programme.cohorts.*.starts' => ['required', 'string', 'max:200'],
            'programme.cohorts.*.format' => ['required', 'string', 'max:200'],
            'programme.cohorts.*.location' => ['required', 'string', 'max:300'],
            'programme.status' => ['required', Rule::in(['draft', 'published'])],
            'programme.sort_order' => ['required', 'integer', 'min:0', 'max:9999'],
        ];
    }

    public function savePage(): void
    {
        $this->validate([
            'pageContent.meta.*' => ['required', 'string', 'max:500'],
            'pageContent.hero.*' => ['required', 'string', 'max:1000'],
            'pageContent.directory.*' => ['required', 'string', 'max:1000'],
            'pageContent.mentorship.*' => ['required', 'string', 'max:1000'],
        ]);
        ProgrammePageContent::current()->update(['content' => $this->pageContent, 'updated_by' => auth()->id()]);
        $this->saved = true;
        $this->notifyDashboard('Programme directory settings were saved and published.');
    }

    public function saveProgramme(): void
    {
        $validated = $this->validate()['programme'];
        $record = $this->programmeId ? Programme::query()->findOrFail($this->programmeId) : new Programme;
        $record->fill([...$validated, 'updated_by' => auth()->id()])->save();
        $this->selectProgramme($record->id);
        $this->saved = true;
        $this->notifyDashboard('The programme was saved successfully.');
    }

    public function deleteProgramme(): void
    {
        abort_if($this->programmeId === null, 404);
        $programme = Programme::query()->findOrFail($this->programmeId);
        Storage::disk('public')->deleteDirectory('programme-media/'.$programme->id);
        $programme->delete();
        $next = Programme::query()->orderBy('sort_order')->orderBy('id')->first();
        $next ? $this->selectProgramme($next->id) : $this->newProgramme();
        $this->saved = true;
        $this->notifyDashboard('The programme was deleted.');
    }

    public function addObjective(): void
    {
        $this->programme['objectives'][] = '';
    }

    public function removeObjective(int $index): void
    {
        unset($this->programme['objectives'][$index]);
        $this->programme['objectives'] = array_values($this->programme['objectives']);
    }

    public function addCurriculum(): void
    {
        $this->programme['curriculum'][] = ['title' => '', 'description' => ''];
    }

    public function removeCurriculum(int $index): void
    {
        unset($this->programme['curriculum'][$index]);
        $this->programme['curriculum'] = array_values($this->programme['curriculum']);
    }

    public function addFacilitator(): void
    {
        $this->programme['facilitators'][] = ['name' => '', 'role' => ''];
    }

    public function removeFacilitator(int $index): void
    {
        unset($this->programme['facilitators'][$index]);
        $this->programme['facilitators'] = array_values($this->programme['facilitators']);
    }

    public function addCohort(): void
    {
        $this->programme['cohorts'][] = ['name' => '', 'starts' => '', 'format' => '', 'location' => ''];
    }

    public function removeCohort(int $index): void
    {
        unset($this->programme['cohorts'][$index]);
        $this->programme['cohorts'] = array_values($this->programme['cohorts']);
    }

    public function addMedia(): void
    {
        abort_if($this->programmeId === null, 404);

        $rules = [
            'mediaForm.type' => ['required', Rule::in(['image', 'audio', 'video'])],
            'mediaForm.title' => ['required', 'string', 'max:200'],
            'mediaForm.external_url' => ['nullable', 'url:http,https', 'max:2000'],
        ];
        $rules['mediaFile'] = match ($this->mediaForm['type']) {
            'image' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:5120'],
            'audio' => ['nullable', 'file', 'mimes:mp3,wav,ogg,m4a,aac', 'max:51200'],
            'video' => ['nullable', 'file', 'mimes:mp4,webm,mov,m4v', 'max:204800'],
        };
        $this->validate($rules);

        if (! $this->mediaFile && blank($this->mediaForm['external_url'])) {
            $this->addError('mediaFile', 'Choose a local file or enter an external media URL.');

            return;
        }

        $programme = Programme::query()->findOrFail($this->programmeId);
        $media = $programme->media ?? [];
        $item = [
            'id' => (string) Str::uuid(),
            'type' => $this->mediaForm['type'],
            'title' => $this->mediaForm['title'],
        ];

        if ($this->mediaFile) {
            $item['source'] = 'upload';
            $item['path'] = $this->mediaFile->store('programme-media/'.$programme->id.'/'.$this->mediaForm['type'], 'public');
            $item['mime'] = $this->mediaFile->getMimeType();
        } else {
            $item['source'] = 'link';
            $item['url'] = $this->mediaForm['external_url'];
        }

        $media[] = $item;
        $programme->update(['media' => $media, 'updated_by' => auth()->id()]);
        $this->programme['media'] = $media;
        $this->resetMediaForm();
        $this->saved = true;
        $this->notifyDashboard(ucfirst($item['type']).' added to the programme media library.');
    }

    public function removeMedia(int $index): void
    {
        abort_if($this->programmeId === null, 404);
        $programme = Programme::query()->findOrFail($this->programmeId);
        $media = $programme->media ?? [];
        abort_unless(isset($media[$index]), 404);

        if (($media[$index]['source'] ?? null) === 'upload' && str_starts_with($media[$index]['path'] ?? '', 'programme-media/')) {
            Storage::disk('public')->delete($media[$index]['path']);
        }

        unset($media[$index]);
        $media = array_values($media);
        $programme->update(['media' => $media, 'updated_by' => auth()->id()]);
        $this->programme['media'] = $media;
        $this->saved = true;
        $this->notifyDashboard('Media removed from the programme.');
    }

    /** @param array<string, mixed> $media
     *  @return array<string, mixed>
     */
    public function mediaPreview(array $media): array
    {
        return ProgrammeMedia::present($media);
    }

    public function restorePageDefaults(): void
    {
        $this->pageContent = ProgrammeDefaults::page();
        ProgrammePageContent::current()->update(['content' => $this->pageContent, 'updated_by' => auth()->id()]);
        $this->saved = true;
        $this->notifyDashboard('The programme directory defaults were restored.');
    }

    public function render(): View
    {
        return view('livewire.admin.programme-manager');
    }

    private function resetMediaForm(): void
    {
        $this->mediaForm = ['type' => 'image', 'title' => '', 'external_url' => ''];
        $this->reset('mediaFile');
        $this->resetValidation();
    }
}
