<?php

namespace App\Livewire;

use App\Models\MentorshipPageContent;
use App\Models\Programme;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('layouts.app')]
class MentorshipPage extends Component
{
    public function render(): View
    {
        Programme::importDefaultsIfEmpty();
        $content = MentorshipPageContent::current()->content;

        return view('livewire.mentorship-page', [
            'content' => $content,
            'whyImageUrl' => $this->imageUrl($content['why']['image']),
            'programmes' => Programme::query()->published()->orderBy('sort_order')->get(),
        ])->layoutData([
            'title' => $content['meta']['title'],
            'description' => $content['meta']['description'],
        ]);
    }

    private function imageUrl(string $path): string
    {
        return str_starts_with($path, 'images/') ? asset($path) : Storage::disk('public')->url($path);
    }
}
