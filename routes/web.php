<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\PublicSessionController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Livewire\AboutPage;
use App\Livewire\Admin\HomepageEditor;
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
    Route::get('/login', [PublicSessionController::class, 'create'])->name('login');
    Route::post('/login', [PublicSessionController::class, 'store'])->name('login.store');
    Route::get('/register', [RegisteredUserController::class, 'create'])->name('register');
    Route::post('/register', [RegisteredUserController::class, 'store'])->name('register.store');
    Route::get('/admin/login', [AuthenticatedSessionController::class, 'create'])->name('admin.login');
    Route::post('/admin/login', [AuthenticatedSessionController::class, 'store'])->name('admin.login.store');
});

Route::post('/logout', [PublicSessionController::class, 'destroy'])->middleware('auth')->name('logout');

Route::middleware(['auth', 'super_admin'])->prefix('admin')->name('admin.')->group(function (): void {
    Route::get('/', DashboardController::class)->name('dashboard');
    Route::get('/homepage', HomepageEditor::class)->name('homepage.edit');
    Route::get('/users', [UserController::class, 'index'])->name('users.index');
    Route::patch('/users/{user}/administrator', [UserController::class, 'update'])->name('users.administrator.update');
    Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');
});
