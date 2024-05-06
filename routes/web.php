<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\MessageController;
use Illuminate\Support\Facades\Route;

//Livewire Components 
use App\Livewire\TaskPostingPage;
use App\Livewire\TaskPostingIndex;
use App\Livewire\TaskPostingShow;
use App\Livewire\TaskPostingCreate;
use App\Livewire\TaskPostingEdit;
use App\Livewire\Application;
use App\Livewire\ApplicationCreateForm;
use App\Livewire\SavedTask;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::view('/', 'welcome');

// Navigation Link For User
Route::middleware(['auth', 'verified', 'redirect.if.admin'])->group(function () {
    Route::get('/message', [MessageController::class, 'index'])->name('message.index');
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
});

// Admin & User Profile View Route
Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

// Admin Route
Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('admin/dashboard', [HomeController::class, 'index'])->name('admin.dashboard'); 
});

// Task Posting Route (Livewire Component)
Route::middleware(['auth', 'redirect.if.admin'])->group(function () {
    Route::get('/task-posting-page', TaskPostingPage::class)->name('task-posting-page');
    Route::get('/task-posting', TaskPostingIndex::class)->name('task-posting.index');
    Route::get('/task-posting/{id}', TaskPostingShow::class)->name('task-posting.show');
    Route::get('/task-posting/create', [TaskPostingCreate::class, 'create'])->name('task-posting.create');
    Route::get('/task-posting/{taskPosting}/edit', [TaskPostingEdit::class, 'edit'])->name('task-posting.edit');

    Route::get('/application', Application::class)->name('application');
    Route::get('/application/create/{taskId}', ApplicationCreateForm::class)->name('application-create-form');

    Route::get('/saved-task', SavedTask::class)->name('saved-task');
});


require __DIR__.'/auth.php';
