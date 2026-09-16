<?php

namespace App\Livewire;

use Illuminate\View\View;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('layouts.app')]
class AboutPage extends Component
{
    public function render(): View
    {
        return view('livewire.about-page')->layoutData([
            'title' => 'About THE IMPACT — Faith, Leadership & Service in Africa',
            'description' => 'Discover why THE IMPACT exists, the gap we seek to address, and our approach to developing Christ-centred young leaders for public service and societal transformation.',
        ]);
    }
}
