<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\NoteController;
use App\Http\Controllers\MealController;
use App\Models\Note;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Route;



Route::get('/', function () {
    return view('pages.home');
});

Route::resource('/note/resource', NoteController::class)->parameters(['resource' => 'note']);

Route::get('/home', [HomeController::class, 'index'])->name('home.index');

Route::get('/meals', [MealController::class, 'index'])->name('meals.index');

