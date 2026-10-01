<?php

use App\Livewire\CategoriesManager;
use App\Livewire\CreateTask;
use App\Livewire\TaskManager;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('login');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', TaskManager::class)->name('dashboard');
    Route::get('/add-task', CreateTask::class)->name('tasks.create');
    Route::get('/categories', CategoriesManager::class)->name('categories.index');
});
