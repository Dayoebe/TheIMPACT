<?php

namespace App\Livewire\Admin;

use App\Models\Programme;
use App\Models\ProgrammePageContent;
use App\Support\ProgrammeDefaults;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Validation\Rule;
use Illuminate\View\View;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('layouts.admin')]
class ProgrammeManager extends Component
{
    /** @var array<string, mixed> */
    public array $pageContent = [];

    /** @var array<string, mixed> */
    public array $programme = [];

    public ?int $programmeId = null;

    public bool $saved = false;

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
        $this->saved = false;
        $this->resetValidation();
    }

    public function newProgramme(): void
    {
        $this->programmeId = null;
        $this->programme = [
            'slug' => '', 'name' => '', 'headline' => '', 'icon' => 'equip', 'category' => '', 'summary' => '', 'overview' => '', 'audience' => '', 'duration' => '', 'registration_url' => null,
            'objectives' => [''], 'curriculum' => [['title' => '', 'description' => '']], 'facilitators' => [], 'cohorts' => [], 'status' => 'draft', 'sort_order' => (int) Programme::query()->max('sort_order') + 1,
        ];
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
    }

    public function saveProgramme(): void
    {
        $validated = $this->validate()['programme'];
        $record = $this->programmeId ? Programme::query()->findOrFail($this->programmeId) : new Programme;
        $record->fill([...$validated, 'updated_by' => auth()->id()])->save();
        $this->selectProgramme($record->id);
        $this->saved = true;
    }

    public function deleteProgramme(): void
    {
        abort_if($this->programmeId === null, 404);
        Programme::query()->findOrFail($this->programmeId)->delete();
        $next = Programme::query()->orderBy('sort_order')->orderBy('id')->first();
        $next ? $this->selectProgramme($next->id) : $this->newProgramme();
        $this->saved = true;
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

    public function restorePageDefaults(): void
    {
        $this->pageContent = ProgrammeDefaults::page();
        ProgrammePageContent::current()->update(['content' => $this->pageContent, 'updated_by' => auth()->id()]);
        $this->saved = true;
    }

    public function render(): View
    {
        return view('livewire.admin.programme-manager');
    }
}
