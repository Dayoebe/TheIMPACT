<?php

namespace App\Livewire;

use App\Models\Programme;
use App\Models\ProgrammePageContent;
use Illuminate\View\View;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('layouts.app')]
class ProgrammesPage extends Component
{
    public function render(): View
    {
        Programme::importDefaultsIfEmpty();
        $content = ProgrammePageContent::current()->content;

        return view('livewire.programmes-page', [
            'content' => $content,
            'programmes' => Programme::query()->published()->orderBy('sort_order')->orderBy('id')->get(),
        ])->layoutData([
            'title' => $content['meta']['title'],
            'description' => $content['meta']['description'],
        ]);
    }
}
