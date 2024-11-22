<?php

use App\Livewire\Auth\Login;
use App\Livewire\Admin\Profile;
use App\Livewire\Auth\Register;
use App\Livewire\Post\PostEdit;
use App\Livewire\Post\PostShow;
use App\Livewire\Post\PostIndex;
use App\Livewire\Admin\Dashboard;
use App\Livewire\Post\PostCreate;
use Illuminate\Auth\Events\Logout;
use Illuminate\Support\Facades\Auth;
use App\Livewire\Profile\ProfileEdit;
use App\Livewire\Profile\ProfileShow;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\NotificationController;

Route::get('/', function () {
    return redirect()->route('login');
});
Route::group(['middleware'=> 'auth'], function ()  {
    Route::get('/dashboard', Dashboard::class)->name('dashboard');

    Route::get('/notifications', [NotificationController::class, 'index'])->name('notifications.index');


    Route::get('profile', Profile::class)->name('profile');

    Route::prefix('profile')->group(function () {
        Route::get('/{id}/show', ProfileShow::class)->name('profile.show');
        Route::get('/{id}/edit', ProfileEdit::class)->name('profile.edit');
    });

    Route::group(['prefix' => 'posts'], function()  {
        Route::get('/', PostIndex::class)->name('posts.index');
        Route::get('/create', PostCreate::class)->name('posts.create');
        Route::get('/{post}/edit', PostEdit::class)->name('posts.edit');
        Route::get('/{post}', PostShow::class)->name('posts.show');
    });
});

Route::group(['middleware'=> 'guest'], function () {
    Route::get("/register", Register::class)->name("register");
    Route::get("/login", Login::class)->name("login");
});






