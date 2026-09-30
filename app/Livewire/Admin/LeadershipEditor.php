<?php

namespace App\Livewire\Admin;

use App\Models\LeadershipPageContent;
use App\Support\LeadershipPageDefaults;
use Illuminate\View\View;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('layouts.admin')]
class LeadershipEditor extends Component
{
    /** @var array<string, mixed> */
    public array $content = [];

    public bool $saved = false;

    public function mount(): void
    {
        $this->content = LeadershipPageContent::current()->content;
    }

    /** @return array<string, mixed> */
    protected function rules(): array
    {
        return [
            'content.meta.title' => ['required', 'string', 'max:200'],
            'content.meta.description' => ['required', 'string', 'max:500'],
            'content.hero.*' => ['required', 'string', 'max:1000'],
            'content.notice.*' => ['required', 'string', 'max:1000'],
            'content.directory.label' => ['required', 'string', 'max:100'],
            'content.directory.sample_label' => ['required', 'string', 'max:100'],
            'content.directory.empty_label' => ['required', 'string', 'max:100'],
            'content.directory.empty_text' => ['required', 'string', 'max:500'],
            'content.directory.groups' => ['required', 'array', 'min:1'],
            'content.directory.groups.*.id' => ['required', 'string', 'max:100', 'regex:/^[a-z0-9]+(?:-[a-z0-9]+)*$/', 'distinct'],
            'content.directory.groups.*.title' => ['required', 'string', 'max:200'],
            'content.directory.groups.*.icon' => ['required', 'string', 'max:50'],
            'content.directory.groups.*.description' => ['required', 'string', 'max:1000'],
            'content.directory.groups.*.people' => ['present', 'array'],
            'content.directory.groups.*.people.*.initials' => ['required', 'string', 'max:5'],
            'content.directory.groups.*.people.*.name' => ['required', 'string', 'max:200'],
            'content.directory.groups.*.people.*.role' => ['required', 'string', 'max:200'],
            'content.directory.groups.*.people.*.bio' => ['required', 'string', 'max:1500'],
            'content.closing.*' => ['required', 'string', 'max:200'],
        ];
    }

    public function addGroup(): void
    {
        $this->content['directory']['groups'][] = ['id' => 'new-leadership-group', 'title' => 'New leadership group', 'icon' => 'leadership', 'description' => 'Describe this group’s responsibilities.', 'people' => []];
    }

    public function removeGroup(int $groupIndex): void
    {
        unset($this->content['directory']['groups'][$groupIndex]);
        $this->content['directory']['groups'] = array_values($this->content['directory']['groups']);
    }

    public function addPerson(int $groupIndex): void
    {
        $this->content['directory']['groups'][$groupIndex]['people'][] = ['initials' => 'NP', 'name' => 'New profile', 'role' => 'Leadership role', 'bio' => 'Add a clear, factual biography before publishing this profile.'];
    }

    public function removePerson(int $groupIndex, int $personIndex): void
    {
        unset($this->content['directory']['groups'][$groupIndex]['people'][$personIndex]);
        $this->content['directory']['groups'][$groupIndex]['people'] = array_values($this->content['directory']['groups'][$groupIndex]['people']);
    }

    public function save(): void
    {
        $this->validate();
        LeadershipPageContent::current()->update(['content' => $this->content, 'updated_by' => auth()->id()]);
        $this->saved = true;
    }

    public function restoreDefaults(): void
    {
        $this->content = LeadershipPageDefaults::content();
        LeadershipPageContent::current()->update(['content' => $this->content, 'updated_by' => auth()->id()]);
        $this->saved = true;
    }

    public function render(): View
    {
        return view('livewire.admin.leadership-editor');
    }
}
