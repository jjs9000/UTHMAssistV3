<?php

use App\Http\Controllers\MessageController;
use App\Livewire\Admin\Application\Index as ApplicationIndex;
use App\Livewire\Admin\Rating\Index as RatingIndex;
use App\Livewire\Admin\Tag\Index as TagIndex;
use App\Livewire\Admin\TaskPost\Index as TaskPostIndex;
use App\Livewire\AdminDashboard;
use App\Livewire\AdminUser;
use Illuminate\Support\Facades\Route;

//Livewire Components 
use App\Livewire\TaskPostingPage;
use App\Livewire\TaskPostingIndex;
use App\Livewire\TaskPostingShow;
use App\Livewire\TaskPostingCreate;
use App\Livewire\TaskPostingEdit;
use App\Livewire\Application;
use App\Livewire\ApplicationCreateForm;
use App\Livewire\ApplicationList;
use App\Livewire\ApplicationReceive;
use App\Livewire\Bookmark\Index as BookmarkIndex;
use App\Livewire\Dashboard\Index;
use App\Livewire\Message\Index as MessageIndex;

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
    Route::get('/message', MessageIndex::class)->name('message.index');
    Route::get('/dashboard', Index::class)->name('dashboard.index');
});

// Admin & User Profile View Route
Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

// Admin Route
Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('admin/dashboard', AdminDashboard::class)->name('admin-dashboard');
    Route::get('/admin/user/{showUserTable?}', AdminUser::class)->name('admin-user');
    Route::get('/admin/task', TaskPostIndex::class)->name('admin.taskpost.index');
    Route::get('/admin/application', ApplicationIndex::class)->name('admin.application.index');
    Route::get('/admin/tag', TagIndex::class)->name('admin.tag.index');
    Route::get('/admin/feedback', RatingIndex::class)->name('admin.rating.index');
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
    Route::get('/application-list', ApplicationList::class)->name('application.list');
    Route::get('/application-receive', ApplicationReceive::class)->name('application.receive');

    Route::get('/bookmark', BookmarkIndex::class)->name('bookmark.index');
});


require __DIR__.'/auth.php';
