<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function __invoke(): View
    {
        return view('admin.dashboard', [
            'menuGroups' => config('menu.groups', []),
            'programmeCount' => count(config('programmes', [])),
            'leadershipGroupCount' => count(config('impact.leadership', [])),
            'missionStepCount' => count(config('impact.mission_steps', [])),
        ]);
    }
}
