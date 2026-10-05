<?php

namespace App\Livewire\Admin;

use App\Models\VisionMissionContent;
use App\Support\InteractsWithDashboardNotifications;
use App\Support\VisionMissionDefaults;
use Illuminate\View\View;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('layouts.admin')]
class VisionMissionEditor extends Component
{
    use InteractsWithDashboardNotifications;

    /** @var array<string, mixed> */
    public array $content = [];

    public bool $saved = false;

    public function mount(): void
    {
        $this->content = VisionMissionContent::current()->content;
    }

    /** @return array<string, list<string>> */
    protected function rules(): array
    {
        return [
            'content.meta.*' => ['required', 'string', 'max:500'],
            'content.hero.*' => ['required', 'string', 'max:1000'],
            'content.vision.*' => ['required', 'string', 'max:2000'],
            'content.mission.label' => ['required', 'string', 'max:150'],
            'content.mission.title_line_one' => ['required', 'string', 'max:200'],
            'content.mission.title_emphasis' => ['required', 'string', 'max:200'],
            'content.mission.statement' => ['required', 'string', 'max:2000'],
            'content.mission.steps' => ['required', 'array', 'size:5'],
            'content.mission.steps.*.name' => ['required', 'string', 'max:100'],
            'content.mission.steps.*.icon' => ['required', 'string', 'max:50'],
            'content.mission.steps.*.description' => ['required', 'string', 'max:2000'],
            'content.philosophy.label' => ['required', 'string', 'max:150'],
            'content.philosophy.title_line_one' => ['required', 'string', 'max:200'],
            'content.philosophy.title_emphasis' => ['required', 'string', 'max:200'],
            'content.philosophy.introduction' => ['required', 'string', 'max:2000'],
            'content.philosophy.values' => ['required', 'array', 'size:6'],
            'content.philosophy.values.*.name' => ['required', 'string', 'max:100'],
            'content.philosophy.values.*.icon' => ['required', 'string', 'max:50'],
            'content.philosophy.values.*.description' => ['required', 'string', 'max:2000'],
            'content.closing.*' => ['required', 'string', 'max:300'],
        ];
    }

    public function save(): void
    {
        $this->validate();
        VisionMissionContent::current()->update(['content' => $this->content, 'updated_by' => auth()->id()]);
        $this->saved = true;
        $this->notifyDashboard('Vision and mission changes were saved and published.');
    }

    public function restoreDefaults(): void
    {
        $this->content = VisionMissionDefaults::content();
        VisionMissionContent::current()->update(['content' => $this->content, 'updated_by' => auth()->id()]);
        $this->saved = true;
        $this->notifyDashboard('The vision and mission defaults were restored.');
    }

    public function render(): View
    {
        return view('livewire.admin.vision-mission-editor');
    }
}
