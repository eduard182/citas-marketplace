<?php

use Illuminate\Support\Facades\Route;
use App\Models\User;

Route::view('/', 'welcome');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

require __DIR__.'/auth.php';

Route::get('/p/{slug}', function ($slug) {
    $provider = User::where('role', 'provider')
        ->whereHas('providerProfile', fn($q) => $q->where('slug', $slug))
        ->with(['providerProfile'])
        ->firstOrFail();

    return view('provider.show', compact('provider'));
});
