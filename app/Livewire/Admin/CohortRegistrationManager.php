<?php

namespace App\Livewire\Admin;

use App\Models\CohortPageContent;
use App\Models\Programme;
use App\Support\CohortPageDefaults;
use App\Support\InteractsWithDashboardNotifications;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\View\View;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('layouts.admin')]
class CohortRegistrationManager extends Component
{
    use InteractsWithDashboardNotifications;

    /** @var array<string, mixed> */
    public array $pageContent = [];

    /** @var array<int, array<string, string>> */
    public array $cohorts = [];

    public ?int $programmeId = null;

    public ?string $registrationUrl = null;

    public bool $saved = false;

    public function mount(): void
    {
        Programme::importDefaultsIfEmpty();
        $this->pageContent = CohortPageContent::current()->content;
        $first = Programme::query()->orderBy('sort_order')->orderBy('id')->first();

        if ($first) {
            $this->selectProgramme($first->id);
        }
    }

    /** @return Collection<int, Programme> */
    public function getProgrammesProperty(): Collection
    {
        return Programme::query()->orderBy('sort_order')->orderBy('id')->get();
    }

    public function selectProgramme(int $programmeId): void
    {
        $programme = Programme::query()->findOrFail($programmeId);
        $this->programmeId = $programme->id;
        $this->cohorts = $programme->cohorts;
        $this->registrationUrl = $programme->registration_url;
        $this->saved = false;
        $this->resetValidation();
    }

    public function addCohort(): void
    {
        $this->cohorts[] = ['name' => '', 'starts' => '', 'format' => '', 'location' => ''];
    }

    public function removeCohort(int $index): void
    {
        unset($this->cohorts[$index]);
        $this->cohorts = array_values($this->cohorts);
    }

    public function saveProgrammeSchedule(): void
    {
        abort_if($this->programmeId === null, 404);
        $validated = $this->validate([
            'registrationUrl' => ['nullable', 'url:http,https', 'max:500'],
            'cohorts' => ['array', 'max:20'],
            'cohorts.*.name' => ['required', 'string', 'max:200'],
            'cohorts.*.starts' => ['required', 'string', 'max:200'],
            'cohorts.*.format' => ['required', 'string', 'max:200'],
            'cohorts.*.location' => ['required', 'string', 'max:300'],
        ]);
        Programme::query()->findOrFail($this->programmeId)->update([
            'cohorts' => $validated['cohorts'],
            'registration_url' => $validated['registrationUrl'],
            'updated_by' => auth()->id(),
        ]);
        $this->saved = true;
        $this->notifyDashboard('Cohort schedule and registration details were saved.');
    }

    public function savePage(): void
    {
        $this->validate([
            'pageContent.meta.*' => ['required', 'string', 'max:500'],
            'pageContent.hero.*' => ['required', 'string', 'max:1000'],
            'pageContent.directory.*' => ['required', 'string', 'max:1000'],
            'pageContent.guidance.*' => ['required', 'string', 'max:1000'],
        ]);
        CohortPageContent::current()->update(['content' => $this->pageContent, 'updated_by' => auth()->id()]);
        $this->saved = true;
        $this->notifyDashboard('Cohort page settings were saved and published.');
    }

    public function restorePageDefaults(): void
    {
        $this->pageContent = CohortPageDefaults::content();
        CohortPageContent::current()->update(['content' => $this->pageContent, 'updated_by' => auth()->id()]);
        $this->saved = true;
        $this->notifyDashboard('The cohort page defaults were restored.');
    }

    public function render(): View
    {
        return view('livewire.admin.cohort-registration-manager');
    }
}
