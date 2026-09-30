<?php

namespace App\Livewire;

use App\Models\CohortPageContent;
use App\Models\Programme;
use Illuminate\View\View;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('layouts.app')]
class CohortsRegistrationPage extends Component
{
    public function render(): View
    {
        Programme::importDefaultsIfEmpty();
        $content = CohortPageContent::current()->content;

        return view('livewire.cohorts-registration-page', [
            'content' => $content,
            'programmes' => Programme::query()->published()->orderBy('sort_order')->orderBy('id')->get(),
        ])->layoutData([
            'title' => $content['meta']['title'],
            'description' => $content['meta']['description'],
        ]);
    }
}
