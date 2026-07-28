<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class MealController extends Controller
{
    public function index()
    {
        $baseUrl = 'https://www.themealdb.com';
        $apiPath = '/api/json/v1/1/search.php';

        $response = Http::get("{$baseUrl}{$apiPath}", [
            's' => 'rice',
        ]);

        $meals = $response->json()['meals'] ?? [];

        return view('pages.recipeREcommendation', compact('meals'));
    }
}
