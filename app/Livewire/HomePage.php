<?php

namespace App\Livewire;

use App\Models\HomepageContent;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('layouts.app')]
class HomePage extends Component
{
    public function render(): View
    {
        $content = HomepageContent::current()->content;

        return view('livewire.home-page', [
            'content' => $content,
            'heroImageUrl' => $this->imageUrl($content['hero']['image']),
            'aboutImageUrl' => $this->imageUrl($content['about']['image']),
        ]);
    }

    private function imageUrl(string $path): string
    {
        return str_starts_with($path, 'images/') ? asset($path) : Storage::disk('public')->url($path);
    }
}
