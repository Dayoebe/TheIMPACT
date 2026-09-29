<?php

namespace App\Livewire\Admin;

use App\Models\HomepageContent;
use App\Support\HomepageDefaults;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\Features\SupportFileUploads\WithFileUploads;

#[Layout('layouts.admin')]
class HomepageEditor extends Component
{
    use WithFileUploads;

    /** @var array<string, mixed> */
    public array $content = [];

    public mixed $heroImage = null;

    public mixed $aboutImage = null;

    public bool $saved = false;

    public function mount(): void
    {
        $this->content = HomepageContent::current()->content;
    }

    /**
     * @return array<string, list<string>>
     */
    protected function rules(): array
    {
        $rules = [
            'content.hero.*' => ['required', 'string', 'max:500'],
            'content.philosophy' => ['required', 'array', 'size:6'],
            'content.philosophy.*' => ['required', 'string', 'max:80'],
            'content.about.label' => ['required', 'string', 'max:100'],
            'content.about.title_line_one' => ['required', 'string', 'max:150'],
            'content.about.title_emphasis' => ['required', 'string', 'max:150'],
            'content.about.image' => ['required', 'string', 'max:500'],
            'content.about.image_alt' => ['required', 'string', 'max:500'],
            'content.about.image_caption' => ['required', 'string', 'max:200'],
            'content.about.lead' => ['required', 'string', 'max:1000'],
            'content.about.paragraphs' => ['required', 'array', 'size:2'],
            'content.about.paragraphs.*' => ['required', 'string', 'max:2000'],
            'content.about.link_label' => ['required', 'string', 'max:100'],
            'content.vision.*' => ['required', 'string', 'max:2000'],
            'content.mission.*' => ['required', 'string', 'max:2000'],
            'content.focus.label' => ['required', 'string', 'max:100'],
            'content.focus.title_line_one' => ['required', 'string', 'max:150'],
            'content.focus.title_emphasis' => ['required', 'string', 'max:150'],
            'content.focus.introduction' => ['required', 'string', 'max:1000'],
            'content.focus.link_label' => ['required', 'string', 'max:100'],
            'content.focus.areas' => ['required', 'array', 'size:5'],
            'content.focus.areas.*.name' => ['required', 'string', 'max:100'],
            'content.focus.areas.*.icon' => ['required', 'string', 'max:50'],
            'content.focus.areas.*.title' => ['required', 'string', 'max:180'],
            'content.focus.areas.*.description' => ['required', 'string', 'max:2000'],
            'content.focus.areas.*.eyebrow' => ['required', 'string', 'max:150'],
            'content.journey.label' => ['required', 'string', 'max:100'],
            'content.journey.title_line_one' => ['required', 'string', 'max:150'],
            'content.journey.title_line_two' => ['required', 'string', 'max:150'],
            'content.journey.title_emphasis' => ['required', 'string', 'max:150'],
            'content.journey.introduction' => ['required', 'string', 'max:1000'],
            'content.journey.steps' => ['required', 'array', 'size:5'],
            'content.journey.steps.*.name' => ['required', 'string', 'max:100'],
            'content.journey.steps.*.icon' => ['required', 'string', 'max:50'],
            'content.journey.steps.*.label' => ['required', 'string', 'max:150'],
            'content.journey.steps.*.description' => ['required', 'string', 'max:1000'],
            'content.closing.*' => ['required', 'string', 'max:300'],
            'heroImage' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:5120'],
            'aboutImage' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:5120'],
        ];

        return $rules;
    }

    public function save(): void
    {
        $this->validate();

        $record = HomepageContent::current();
        $content = $this->content;

        if ($this->heroImage) {
            $this->deleteManagedImage($content['hero']['image']);
            $content['hero']['image'] = $this->heroImage->store('homepage', 'public');
        }

        if ($this->aboutImage) {
            $this->deleteManagedImage($content['about']['image']);
            $content['about']['image'] = $this->aboutImage->store('homepage', 'public');
        }

        $record->update([
            'content' => $content,
            'updated_by' => auth()->id(),
        ]);

        $this->content = $content;
        $this->reset('heroImage', 'aboutImage');
        $this->saved = true;
    }

    public function restoreDefaults(): void
    {
        $record = HomepageContent::current();
        $this->deleteManagedImage($record->content['hero']['image'] ?? '');
        $this->deleteManagedImage($record->content['about']['image'] ?? '');

        $this->content = HomepageDefaults::content();
        $record->update(['content' => $this->content, 'updated_by' => auth()->id()]);
        $this->reset('heroImage', 'aboutImage');
        $this->saved = true;
    }

    public function imageUrl(string $path): string
    {
        return str_starts_with($path, 'images/') ? asset($path) : Storage::disk('public')->url($path);
    }

    private function deleteManagedImage(string $path): void
    {
        if (str_starts_with($path, 'homepage/')) {
            Storage::disk('public')->delete($path);
        }
    }

    public function render(): View
    {
        return view('livewire.admin.homepage-editor');
    }
}
