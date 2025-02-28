<?php

use App\Http\Controllers\Web\Projects\ShowProjectWebController;
use App\Livewire\Projects\ShowRemoteProject;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('projects/{id}', ShowRemoteProject::class)->name('show-remote-project');

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});
