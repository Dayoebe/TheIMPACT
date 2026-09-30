<?php

namespace App\Livewire\Admin;

use App\Models\MentorshipPageContent;
use App\Support\MentorshipPageDefaults;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\Features\SupportFileUploads\WithFileUploads;

#[Layout('layouts.admin')]
class MentorshipEditor extends Component
{
    use WithFileUploads;

    /** @var array<string, mixed> */
    public array $content = [];

    public mixed $whyImage = null;

    public bool $saved = false;

    public function mount(): void
    {
        $this->content = MentorshipPageContent::current()->content;
    }

    /** @return array<string, mixed> */
    protected function rules(): array
    {
        return [
            'content.meta.*' => ['required', 'string', 'max:500'],
            'content.hero.*' => ['required', 'string', 'max:1000'],
            'content.why.label' => ['required', 'string', 'max:150'],
            'content.why.title_line_one' => ['required', 'string', 'max:200'],
            'content.why.title_emphasis' => ['required', 'string', 'max:200'],
            'content.why.image' => ['required', 'string', 'max:500'],
            'content.why.image_alt' => ['required', 'string', 'max:500'],
            'content.why.image_caption' => ['required', 'string', 'max:300'],
            'content.why.lead' => ['required', 'string', 'max:1000'],
            'content.why.paragraphs' => ['required', 'array', 'size:3'],
            'content.why.paragraphs.*' => ['required', 'string', 'max:2000'],
            'content.participation.label' => ['required', 'string', 'max:150'],
            'content.participation.title_line_one' => ['required', 'string', 'max:200'],
            'content.participation.title_emphasis' => ['required', 'string', 'max:200'],
            'content.participation.introduction' => ['required', 'string', 'max:1000'],
            'content.participation.roles.*.eyebrow' => ['required', 'string', 'max:100'],
            'content.participation.roles.*.title' => ['required', 'string', 'max:200'],
            'content.participation.roles.*.description' => ['required', 'string', 'max:2000'],
            'content.participation.roles.*.points' => ['required', 'array', 'size:4'],
            'content.participation.roles.*.points.*' => ['required', 'string', 'max:500'],
            'content.participation.roles.*.link_label' => ['required', 'string', 'max:150'],
            'content.matching.label' => ['required', 'string', 'max:150'],
            'content.matching.title_line_one' => ['required', 'string', 'max:200'],
            'content.matching.title_emphasis' => ['required', 'string', 'max:200'],
            'content.matching.introduction' => ['required', 'string', 'max:1000'],
            'content.matching.steps' => ['required', 'array', 'size:4'],
            'content.matching.steps.*.icon' => ['required', 'string', 'max:50'],
            'content.matching.steps.*.title' => ['required', 'string', 'max:200'],
            'content.matching.steps.*.description' => ['required', 'string', 'max:2000'],
            'content.areas.*' => ['required', 'string', 'max:1000'],
            'content.take_part.label' => ['required', 'string', 'max:150'],
            'content.take_part.title_line_one' => ['required', 'string', 'max:200'],
            'content.take_part.title_emphasis' => ['required', 'string', 'max:200'],
            'content.take_part.introduction' => ['required', 'string', 'max:1000'],
            'content.take_part.closed_label' => ['required', 'string', 'max:150'],
            'content.take_part.preview_label' => ['required', 'string', 'max:150'],
            'content.take_part.preview_notice' => ['required', 'string', 'max:1000'],
            'content.take_part.back_label' => ['required', 'string', 'max:150'],
            'content.take_part.roles.*.title' => ['required', 'string', 'max:200'],
            'content.take_part.roles.*.description' => ['required', 'string', 'max:1000'],
            'content.take_part.roles.*.preparation' => ['required', 'string', 'max:1000'],
            'content.take_part.roles.*.application_url' => ['nullable', 'url:http,https', 'max:500'],
            'whyImage' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:5120'],
        ];
    }

    public function save(): void
    {
        $this->validate();
        $content = $this->content;
        if ($this->whyImage) {
            $this->deleteManagedImage($content['why']['image']);
            $content['why']['image'] = $this->whyImage->store('mentorship-page', 'public');
        }
        MentorshipPageContent::current()->update(['content' => $content, 'updated_by' => auth()->id()]);
        $this->content = $content;
        $this->reset('whyImage');
        $this->saved = true;
    }

    public function restoreDefaults(): void
    {
        $record = MentorshipPageContent::current();
        $this->deleteManagedImage($record->content['why']['image'] ?? '');
        $this->content = MentorshipPageDefaults::content();
        $record->update(['content' => $this->content, 'updated_by' => auth()->id()]);
        $this->reset('whyImage');
        $this->saved = true;
    }

    public function imageUrl(string $path): string
    {
        return str_starts_with($path, 'images/') ? asset($path) : Storage::disk('public')->url($path);
    }

    private function deleteManagedImage(string $path): void
    {
        if (str_starts_with($path, 'mentorship-page/')) {
            Storage::disk('public')->delete($path);
        }
    }

    public function render(): View
    {
        return view('livewire.admin.mentorship-editor');
    }
}
