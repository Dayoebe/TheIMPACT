<?php

namespace App\Livewire\Admin;

use App\Models\LeadershipPageContent;
use App\Support\InteractsWithDashboardNotifications;
use App\Support\LeadershipPageDefaults;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\Features\SupportFileUploads\WithFileUploads;

#[Layout('layouts.admin')]
class LeadershipEditor extends Component
{
    use InteractsWithDashboardNotifications;
    use WithFileUploads;

    /** @var array<string, mixed> */
    public array $content = [];

    public bool $saved = false;

    /** @var array<int, array<int, mixed>> */
    public array $profileImages = [];

    /** @var list<string> */
    public array $photosToDelete = [];

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
            'content.directory.label' => ['required', 'string', 'max:100'],
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
            'content.directory.groups.*.people.*.profile_label' => ['required', 'string', 'max:100'],
            'content.directory.groups.*.people.*.photo' => ['nullable', 'string', 'max:500'],
            'content.directory.groups.*.people.*.photo_alt' => ['nullable', 'string', 'max:500'],
            'profileImages.*.*' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:5120'],
            'content.closing.*' => ['required', 'string', 'max:200'],
        ];
    }

    public function addGroup(): void
    {
        $this->content['directory']['groups'][] = ['id' => 'new-leadership-group', 'title' => 'New leadership group', 'icon' => 'leadership', 'description' => 'Describe this group’s responsibilities.', 'people' => []];
    }

    public function removeGroup(int $groupIndex): void
    {
        foreach ($this->content['directory']['groups'][$groupIndex]['people'] as $person) {
            $this->queueManagedImageForDeletion($person['photo'] ?? null);
        }

        unset($this->content['directory']['groups'][$groupIndex]);
        $this->content['directory']['groups'] = array_values($this->content['directory']['groups']);
    }

    public function addPerson(int $groupIndex): void
    {
        $this->content['directory']['groups'][$groupIndex]['people'][] = ['initials' => 'NP', 'name' => 'New profile', 'role' => 'Leadership role', 'bio' => 'Add a clear, factual biography before publishing this profile.', 'profile_label' => 'LEADERSHIP', 'photo' => null, 'photo_alt' => ''];
    }

    public function removePerson(int $groupIndex, int $personIndex): void
    {
        $this->queueManagedImageForDeletion($this->content['directory']['groups'][$groupIndex]['people'][$personIndex]['photo'] ?? null);
        unset($this->content['directory']['groups'][$groupIndex]['people'][$personIndex]);
        $this->content['directory']['groups'][$groupIndex]['people'] = array_values($this->content['directory']['groups'][$groupIndex]['people']);
    }

    public function save(): void
    {
        $this->validate();

        foreach ($this->profileImages as $groupIndex => $images) {
            foreach ($images as $personIndex => $image) {
                if (! $image) {
                    continue;
                }

                $oldPath = $this->content['directory']['groups'][$groupIndex]['people'][$personIndex]['photo'] ?? null;
                $this->queueManagedImageForDeletion($oldPath);
                $this->content['directory']['groups'][$groupIndex]['people'][$personIndex]['photo'] = $image->store('leadership-profiles', 'public');
            }
        }

        LeadershipPageContent::current()->update(['content' => $this->content, 'updated_by' => auth()->id()]);
        foreach ($this->photosToDelete as $path) {
            Storage::disk('public')->delete($path);
        }
        $this->reset('profileImages');
        $this->photosToDelete = [];
        $this->saved = true;
        $this->notifyDashboard('Leadership changes were saved and published.');
    }

    public function removePhoto(int $groupIndex, int $personIndex): void
    {
        $this->queueManagedImageForDeletion($this->content['directory']['groups'][$groupIndex]['people'][$personIndex]['photo'] ?? null);
        $this->content['directory']['groups'][$groupIndex]['people'][$personIndex]['photo'] = null;
        unset($this->profileImages[$groupIndex][$personIndex]);
    }

    public function restoreDefaults(): void
    {
        foreach (LeadershipPageContent::current()->content['directory']['groups'] as $group) {
            foreach ($group['people'] as $person) {
                $this->queueManagedImageForDeletion($person['photo'] ?? null);
            }
        }

        $this->content = LeadershipPageDefaults::content();
        LeadershipPageContent::current()->update(['content' => $this->content, 'updated_by' => auth()->id()]);
        foreach ($this->photosToDelete as $path) {
            Storage::disk('public')->delete($path);
        }
        $this->reset('profileImages');
        $this->photosToDelete = [];
        $this->saved = true;
        $this->notifyDashboard('The leadership defaults were restored.');
    }

    public function imageUrl(string $path): string
    {
        return str_starts_with($path, 'images/') ? asset($path) : Storage::disk('public')->url($path);
    }

    private function queueManagedImageForDeletion(?string $path): void
    {
        if ($path && str_starts_with($path, 'leadership-profiles/')) {
            $this->photosToDelete[] = $path;
        }
    }

    public function render(): View
    {
        return view('livewire.admin.leadership-editor');
    }
}
