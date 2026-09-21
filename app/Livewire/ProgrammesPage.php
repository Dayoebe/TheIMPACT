<?php

namespace App\Livewire;

use Illuminate\View\View;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('layouts.app')]
class ProgrammesPage extends Component
{
    public function render(): View
    {
        return view('livewire.programmes-page')->layoutData([
            'title' => 'Programmes — THE IMPACT',
            'description' => 'Explore programme outlines in leadership, governance, practical skills, Christian character, community service and mentorship.',
        ]);
    }
}
