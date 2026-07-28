<?php

use App\Http\Controllers\NoteController;
use App\Models\Note;
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

Route::resource('/note/resource', NoteController::class)->parameters([
    'resource' => 'note'
]);

Route::get('/data/test', function () {
    $notes = Note::all();
    dump($notes);
});
