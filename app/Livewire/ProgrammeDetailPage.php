<?php

namespace App\Livewire;

use App\Models\Programme;
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
        Programme::importDefaultsIfEmpty();
        abort_unless(Programme::query()->published()->where('slug', $slug)->exists(), 404);
        $this->slug = $slug;
    }

    public function render(): View
    {
        $programme = Programme::query()->published()->where('slug', $this->slug)->firstOrFail();

        return view('livewire.programme-detail-page', ['programme' => $programme])->layoutData([
            'title' => $programme->name.' — Programmes | THE IMPACT',
            'description' => $programme->summary,
        ]);
    }
}
