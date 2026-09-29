<?php

namespace App\Livewire\Admin;

use App\Models\AboutPageContent;
use App\Support\AboutPageDefaults;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\Features\SupportFileUploads\WithFileUploads;

#[Layout('layouts.admin')]
class AboutPageEditor extends Component
{
    use WithFileUploads;

    /** @var array<string, mixed> */
    public array $content = [];

    public mixed $heroImage = null;

    public mixed $approachImage = null;

    public bool $saved = false;

    public function mount(): void
    {
        $this->content = AboutPageContent::current()->content;
    }

    /** @return array<string, list<string>> */
    protected function rules(): array
    {
        return [
            'content.meta.title' => ['required', 'string', 'max:255'],
            'content.meta.description' => ['required', 'string', 'max:500'],
            'content.hero.*' => ['required', 'string', 'max:1000'],
            'content.contents' => ['required', 'array', 'size:6'],
            'content.contents.*' => ['required', 'string', 'max:80'],
            'content.who.*' => ['required'],
            'content.who.paragraphs' => ['required', 'array', 'size:2'],
            'content.who.paragraphs.*' => ['required', 'string', 'max:2000'],
            'content.why.*' => ['required'],
            'content.why.paragraphs' => ['required', 'array', 'size:3'],
            'content.why.paragraphs.*' => ['required', 'string', 'max:2000'],
            'content.problem.label' => ['required', 'string', 'max:150'],
            'content.problem.title_line_one' => ['required', 'string', 'max:200'],
            'content.problem.title_emphasis' => ['required', 'string', 'max:200'],
            'content.problem.introduction' => ['required', 'string', 'max:1000'],
            'content.problem.cards' => ['required', 'array', 'size:3'],
            'content.problem.cards.*.icon' => ['required', 'string', 'max:50'],
            'content.problem.cards.*.title' => ['required', 'string', 'max:200'],
            'content.problem.cards.*.description' => ['required', 'string', 'max:2000'],
            'content.philosophy.label' => ['required', 'string', 'max:150'],
            'content.philosophy.title_line_one' => ['required', 'string', 'max:200'],
            'content.philosophy.title_emphasis' => ['required', 'string', 'max:200'],
            'content.philosophy.introduction' => ['required', 'string', 'max:1000'],
            'content.philosophy.values' => ['required', 'array', 'size:6'],
            'content.philosophy.values.*.name' => ['required', 'string', 'max:100'],
            'content.philosophy.values.*.icon' => ['required', 'string', 'max:50'],
            'content.philosophy.values.*.description' => ['required', 'string', 'max:2000'],
            'content.approach.label' => ['required', 'string', 'max:150'],
            'content.approach.title_line_one' => ['required', 'string', 'max:200'],
            'content.approach.title_emphasis' => ['required', 'string', 'max:200'],
            'content.approach.introduction' => ['required', 'string', 'max:1000'],
            'content.approach.image' => ['required', 'string', 'max:500'],
            'content.approach.image_alt' => ['required', 'string', 'max:500'],
            'content.approach.image_caption' => ['required', 'string', 'max:300'],
            'content.approach.steps' => ['required', 'array', 'size:5'],
            'content.approach.steps.*.icon' => ['required', 'string', 'max:50'],
            'content.approach.steps.*.title' => ['required', 'string', 'max:100'],
            'content.approach.steps.*.description' => ['required', 'string', 'max:2000'],
            'content.difference.label' => ['required', 'string', 'max:150'],
            'content.difference.title_line_one' => ['required', 'string', 'max:200'],
            'content.difference.title_emphasis' => ['required', 'string', 'max:200'],
            'content.difference.introduction' => ['required', 'string', 'max:1000'],
            'content.difference.cards' => ['required', 'array', 'size:4'],
            'content.difference.cards.*.icon' => ['required', 'string', 'max:50'],
            'content.difference.cards.*.title' => ['required', 'string', 'max:200'],
            'content.difference.cards.*.description' => ['required', 'string', 'max:2000'],
            'content.closing.*' => ['required', 'string', 'max:300'],
            'heroImage' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:5120'],
            'approachImage' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:5120'],
        ];
    }

    public function save(): void
    {
        $this->validate();
        $record = AboutPageContent::current();
        $content = $this->content;

        if ($this->heroImage) {
            $this->deleteManagedImage($content['hero']['image']);
            $content['hero']['image'] = $this->heroImage->store('about-page', 'public');
        }
        if ($this->approachImage) {
            $this->deleteManagedImage($content['approach']['image']);
            $content['approach']['image'] = $this->approachImage->store('about-page', 'public');
        }

        $record->update(['content' => $content, 'updated_by' => auth()->id()]);
        $this->content = $content;
        $this->reset('heroImage', 'approachImage');
        $this->saved = true;
    }

    public function restoreDefaults(): void
    {
        $record = AboutPageContent::current();
        $this->deleteManagedImage($record->content['hero']['image'] ?? '');
        $this->deleteManagedImage($record->content['approach']['image'] ?? '');
        $this->content = AboutPageDefaults::content();
        $record->update(['content' => $this->content, 'updated_by' => auth()->id()]);
        $this->reset('heroImage', 'approachImage');
        $this->saved = true;
    }

    public function imageUrl(string $path): string
    {
        return str_starts_with($path, 'images/') ? asset($path) : Storage::disk('public')->url($path);
    }

    private function deleteManagedImage(string $path): void
    {
        if (str_starts_with($path, 'about-page/')) {
            Storage::disk('public')->delete($path);
        }
    }

    public function render(): View
    {
        return view('livewire.admin.about-page-editor');
    }
}
