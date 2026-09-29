<?php

namespace App\Livewire;

use App\Models\AboutPageContent;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('layouts.app')]
class AboutPage extends Component
{
    public function render(): View
    {
        $content = AboutPageContent::current()->content;

        return view('livewire.about-page', [
            'content' => $content,
            'heroImageUrl' => $this->imageUrl($content['hero']['image']),
            'approachImageUrl' => $this->imageUrl($content['approach']['image']),
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
