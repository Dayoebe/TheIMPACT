<?php

namespace App\Livewire;

use App\Models\Programme;
use App\Support\ProgrammeMedia;
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

        $media = collect($programme->media ?? [])->map(fn (array $item): array => ProgrammeMedia::present($item))->all();

        return view('livewire.programme-detail-page', ['programme' => $programme, 'media' => $media])->layoutData([
            'title' => $programme->name.' — Programmes | THE IMPACT',
            'description' => $programme->summary,
        ]);
    }
}
