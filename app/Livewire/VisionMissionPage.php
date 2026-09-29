<?php

namespace App\Livewire;

use App\Models\VisionMissionContent;
use Illuminate\View\View;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('layouts.app')]
class VisionMissionPage extends Component
{
    public function render(): View
    {
        $content = VisionMissionContent::current()->content;

        return view('livewire.vision-mission-page', ['content' => $content])->layoutData([
            'title' => $content['meta']['title'],
            'description' => $content['meta']['description'],
        ]);
    }
}
