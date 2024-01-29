<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthorController;

//Author routes
Route::prefix('/author')->name('author.')->group(function () {

    //Guest routes
    Route::middleware(['guest:web'])->group(function () {
        Route::view('/login', 'back.pages.auth.login')->name('login');
        Route::view('/forgot-password', 'back.pages.auth.forgot')->name('forgot-password');
    });

    //Logged user Routes
    Route::middleware(['auth:web'])->group(function () {
        Route::get('/home', [AuthorController::class, 'index'])->name('home');
        Route::view('/profile', 'back.pages.profile')->name('profile');
        Route::post('/logout', [AuthorController::class, 'logout'])->name('logout');
        Route::post('change-profile-picture', [AuthorController::class, 'changeProfilePicture'])->name('change-profile-picture');

        //Post routes
        Route::prefix('/posts')->name('posts.')->group(function () {
            Route::view('/add-post', 'back.pages.add-post')->name('add-post');
            Route::post('/create-post', [AuthorController::class, 'createPost'])->name('create-post');
        });

        //Admin Routes
        Route::middleware('isAdmin')->group(function () {
            Route::view('/settings', 'back.pages.settings')->name('settings');
            Route::view('/authors', 'back.pages.authors')->name('authors');
            Route::view('/categories', 'back.pages.categories')->name('categories');
        });
    });
});
