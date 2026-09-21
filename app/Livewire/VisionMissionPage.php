<?php

namespace App\Livewire;

use Illuminate\View\View;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('layouts.app')]
class VisionMissionPage extends Component
{
    public function render(): View
    {
        return view('livewire.vision-mission-page')->layoutData([
            'title' => 'Vision & Mission — THE IMPACT',
            'description' => 'Our vision for Christ-centred leadership in Africa, our five-step mission and the six-part philosophy that guides THE IMPACT.',
        ]);
    }
}
