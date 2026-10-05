<?php

namespace App\Livewire;

use App\Models\LeadershipPageContent;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('layouts.app')]
class LeadershipPage extends Component
{
    public function imageUrl(string $path): string
    {
        return str_starts_with($path, 'images/') ? asset($path) : Storage::disk('public')->url($path);
    }

    public function render(): View
    {
        $content = LeadershipPageContent::current()->content;

        return view('livewire.leadership-page', compact('content'))->layoutData([
            'title' => $content['meta']['title'],
            'description' => $content['meta']['description'],
        ]);
    }
}
