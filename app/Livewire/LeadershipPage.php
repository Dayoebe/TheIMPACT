<?php

namespace App\Livewire;

use App\Models\LeadershipPageContent;
use Illuminate\View\View;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('layouts.app')]
class LeadershipPage extends Component
{
    public function render(): View
    {
        $content = LeadershipPageContent::current()->content;

        return view('livewire.leadership-page', compact('content'))->layoutData([
            'title' => $content['meta']['title'],
            'description' => $content['meta']['description'],
        ]);
    }
}
