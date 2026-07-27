<?php

use App\Models\Note;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});
Route::get('/home', function () {
    return view('pages.home');
});
Route::get('/app', function () {
    return view('layouts.app');
});


Route::get('/data/test', function () {
    $notes = Note::all();
    dump($notes);
});
