<?php

use App\Livewire\AboutPage;
use App\Livewire\HomePage;
use Illuminate\Support\Facades\Route;

Route::get('/', HomePage::class)->name('home');

Route::get('/about', AboutPage::class)->name('about');
