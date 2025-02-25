<?php

use App\Http\Controllers\Web\Projects\ShowProjectWebController;
use App\Livewire\Projects\ShowProject;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('projects/{id}', ShowProject::class)->name('show-project');

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});
