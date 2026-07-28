<?php
use App\Http\Middleware\SortFilterMiddleware;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\NoteController;
use App\Models\Note;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Route;

/*
Route::get('/', function () {
    return view('welcome');
});
Route::get('/home', function () {
    return view('pages.home');
});
Route::get('/app', function () {
    return view('layouts.app');
});
Route::get('/app/note', function () {
    return view('pages.note');
});
Route::get('/app/recipe', function () {
    return view('pages.recipeRecommendation');
});

*/

Route::get('/', function () {
    return view('pages.home');
});

Route::resource('/note/resource', NoteController::class)
    ->parameters(['resource' => 'note']);
    //->middleware(SortFilterMiddleware::class);

Route::get('/data/test', function () {
    $notes = Note::all();
    dump($notes);
});


use App\Http\Controllers\MealController;

Route::get('/home', [HomeController::class, 'index'])->name('home.index');
Route::get('/meals', [MealController::class, 'index'])->name('meals.index');

Route::get('/api/themeal', function () {
    $baseUrl = 'https://www.themealdb.com/api/json/v1/';
    $apiPath = '/1/search.php';
    $mealName = 'Arrabiata';

    $response = Http::get("{$baseUrl}{$apiPath}",['s' => $mealName]);
    dump($response->json());
});
