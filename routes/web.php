<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Livewire\AboutPage;
use App\Livewire\HomePage;
use App\Livewire\LeadershipPage;
use App\Livewire\MentorshipPage;
use App\Livewire\ProgrammeDetailPage;
use App\Livewire\ProgrammesPage;
use App\Livewire\VisionMissionPage;
use Illuminate\Support\Facades\Route;

Route::get('/', HomePage::class)->name('home');

Route::get('/about', AboutPage::class)->name('about');

Route::get('/about/vision-mission', VisionMissionPage::class)->name('about.vision-mission');
Route::get('/leadership', LeadershipPage::class)->name('leadership');
Route::get('/programmes', ProgrammesPage::class)->name('programmes.index');
Route::get('/programmes/{slug}', ProgrammeDetailPage::class)->where('slug', '[a-z0-9]+(?:-[a-z0-9]+)*')->name('programmes.show');
Route::get('/mentorship', MentorshipPage::class)->name('mentorship');

Route::middleware('guest')->group(function (): void {
    Route::get('/admin/login', [AuthenticatedSessionController::class, 'create'])->name('admin.login');
    Route::post('/admin/login', [AuthenticatedSessionController::class, 'store'])->name('admin.login.store');
});

Route::middleware(['auth', 'super_admin'])->prefix('admin')->name('admin.')->group(function (): void {
    Route::get('/', DashboardController::class)->name('dashboard');
    Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');
});
