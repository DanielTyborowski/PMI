<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class MealController extends Controller
{
    public function index(Request $request)
    {
        $validated = $request->validate([
            'search' => [
                'nullable',
                'string',
                'min:2',
                'max:50',
                'regex:/^[^<>&"\'{}()\[\]\/\\\\]*$/u'
            ],
        ]);


        $mealName = trim($validated['search'] ?? '');
        $hasSearched = filled($mealName);

        // check first time opening route => empty meals array
        if (!$hasSearched) {
            return view('pages.recipeRecommendation', [
                'meals' => [],
                'hasSearched' => false,

            ]);
        }

        // api request
        $baseUrl = 'https://www.themealdb.com';
        $apiPath = '/api/json/v1/1/search.php';

        $response = Http::get("{$baseUrl}{$apiPath}", [
            's' => $mealName,
        ]);


        $meals = $response->json()['meals'] ?? [];

        // Check if Youtuble Link is available, otherwise will change it to a google search
        foreach ($meals as &$meal) {
            if (empty($meal['strYoutube'])) {
                $searchQue = $meal['strMeal'];
                $meal['strYoutube'] = "https://www.google.com/search?q={$searchQue}";
            }
        }

        return view('pages.recipeRecommendation', [
            'meals' => $meals,
            'hasSearched' => $hasSearched,
        ]);
    }
}
