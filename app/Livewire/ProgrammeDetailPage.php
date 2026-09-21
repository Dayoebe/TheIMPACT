<?php

namespace App\Livewire;

use Illuminate\View\View;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Locked;
use Livewire\Component;

#[Layout('layouts.app')]
class ProgrammeDetailPage extends Component
{
    #[Locked]
    public string $slug;

    public function mount(string $slug): void
    {
        abort_unless(array_key_exists($slug, config('programmes')), 404);
        $this->slug = $slug;
    }

    public function render(): View
    {
        $programme = config('programmes')[$this->slug] ?? null;
        abort_if($programme === null, 404);

        return view('livewire.programme-detail-page', ['programme' => $programme])->layoutData([
            'title' => $programme['name'].' — Programmes | THE IMPACT',
            'description' => $programme['summary'],
        ]);
    }
}
