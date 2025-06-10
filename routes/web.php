<?php

use App\Livewire\Settings\Appearance;
use App\Livewire\Settings\Password;
use App\Livewire\Settings\Profile;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::get('dashboard', function () {
    $role = Auth::user()->role;

    return match ($role) {
        'admin'   => view('dashboard.admin'),
        'teacher' => view('dashboard.teacher'),
        'parent'  => view('dashboard.parent'),
        default   => abort(403, 'Forbidden'),
    };
})->middleware(['auth'])->name('dashboard');

Route::middleware(['auth'])->group(function () {
    Route::redirect('settings', 'settings/profile');

    Route::get('settings/profile', Profile::class)->name('settings.profile');
    Route::get('settings/password', Password::class)->name('settings.password');
    Route::get('settings/appearance', Appearance::class)->name('settings.appearance');
});

Route::get('/admin2', function () {
    return view('dashboard.admin2');
})->name('admin2');

Route::get('/admin3', function () {
    return view('dashboard.admin3');
})->name('admin3');

require __DIR__ . '/auth.php';
