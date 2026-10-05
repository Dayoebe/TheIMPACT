<?php

namespace App\Support;

trait InteractsWithDashboardNotifications
{
    protected function notifyDashboard(string $message, string $type = 'success'): void
    {
        $this->dispatch('dashboard-toast', message: $message, type: $type);
    }
}
