<?php

namespace App\Livewire\Admin;

use App\Models\PhilosophyFocusContent;
use App\Support\InteractsWithDashboardNotifications;
use App\Support\PhilosophyFocusDefaults;
use Illuminate\View\View;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('layouts.admin')]
class PhilosophyFocusEditor extends Component
{
    use InteractsWithDashboardNotifications;

    /** @var array<string, mixed> */
    public array $content = [];

    public bool $saved = false;

    public function mount(): void
    {
        $this->content = PhilosophyFocusContent::current()->content;
    }

    /** @return array<string, list<string>> */
    protected function rules(): array
    {
        return [
            'content.meta.*' => ['required', 'string', 'max:500'],
            'content.hero.*' => ['required', 'string', 'max:1000'],
            'content.philosophy.label' => ['required', 'string', 'max:150'],
            'content.philosophy.title_line_one' => ['required', 'string', 'max:200'],
            'content.philosophy.title_emphasis' => ['required', 'string', 'max:200'],
            'content.philosophy.introduction' => ['required', 'string', 'max:2000'],
            'content.philosophy.values' => ['required', 'array', 'size:6'],
            'content.philosophy.values.*.name' => ['required', 'string', 'max:100'],
            'content.philosophy.values.*.icon' => ['required', 'string', 'max:50'],
            'content.philosophy.values.*.description' => ['required', 'string', 'max:2000'],
            'content.focus.label' => ['required', 'string', 'max:150'],
            'content.focus.title_line_one' => ['required', 'string', 'max:200'],
            'content.focus.title_emphasis' => ['required', 'string', 'max:200'],
            'content.focus.introduction' => ['required', 'string', 'max:2000'],
            'content.focus.areas' => ['required', 'array', 'size:5'],
            'content.focus.areas.*.name' => ['required', 'string', 'max:150'],
            'content.focus.areas.*.icon' => ['required', 'string', 'max:50'],
            'content.focus.areas.*.title' => ['required', 'string', 'max:200'],
            'content.focus.areas.*.description' => ['required', 'string', 'max:2000'],
            'content.focus.areas.*.eyebrow' => ['required', 'string', 'max:150'],
            'content.closing.*' => ['required', 'string', 'max:300'],
        ];
    }

    public function save(): void
    {
        $this->validate();
        PhilosophyFocusContent::current()->update(['content' => $this->content, 'updated_by' => auth()->id()]);
        $this->saved = true;
        $this->notifyDashboard('Philosophy and focus area changes were saved and published.');
    }

    public function restoreDefaults(): void
    {
        $this->content = PhilosophyFocusDefaults::content();
        PhilosophyFocusContent::current()->update(['content' => $this->content, 'updated_by' => auth()->id()]);
        $this->saved = true;
        $this->notifyDashboard('The philosophy and focus area defaults were restored.');
    }

    public function render(): View
    {
        return view('livewire.admin.philosophy-focus-editor');
    }
}
