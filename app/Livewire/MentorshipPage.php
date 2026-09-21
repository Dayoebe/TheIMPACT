<?php

namespace App\Livewire;

use Illuminate\View\View;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('layouts.app')]
class MentorshipPage extends Component
{
    public function render(): View
    {
        return view('livewire.mentorship-page')->layoutData([
            'title' => 'Mentorship — THE IMPACT',
            'description' => 'Discover the mentorship initiative, who it is for, the intended matching approach and opportunities to participate as a mentor or mentee.',
        ]);
    }
}
