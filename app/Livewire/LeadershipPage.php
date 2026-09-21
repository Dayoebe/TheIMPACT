<?php

namespace App\Livewire;

use Illuminate\View\View;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('layouts.app')]
class LeadershipPage extends Component
{
    public function render(): View
    {
        return view('livewire.leadership-page')->layoutData([
            'title' => 'Leadership — THE IMPACT',
            'description' => 'Explore the leadership structure of THE IMPACT: Founder and President, Board, executive leadership, programme leads and advisors.',
        ]);
    }
}
