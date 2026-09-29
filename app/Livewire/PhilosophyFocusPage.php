<?php

namespace App\Livewire;

use App\Models\PhilosophyFocusContent;
use Illuminate\View\View;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('layouts.app')]
class PhilosophyFocusPage extends Component
{
    public function render(): View
    {
        $content = PhilosophyFocusContent::current()->content;

        return view('livewire.philosophy-focus-page', ['content' => $content])->layoutData([
            'title' => $content['meta']['title'],
            'description' => $content['meta']['description'],
        ]);
    }
}
