<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Validator;

class MealController extends Controller
{
    public function index(Request $request)
    {
        $validated = $request->validate([
            'search' => ['nullable', 'string', 'min:2', 'max:50'],
        ]);


        $validator = Validator::make($request->all(), [
        'search' => ['nullable', 'string', 'min:2', 'max:100'],
    ]);
        if ($validator->fails()) {
        return view('pages.recipeRecommendation', [
            'meals' => [],
            'hasSearched' => false,
            'errors' => $validator->errors(),
        ]);
    }

        // fängt ab, wenn noch kein input gegeben ist (beim erstmaligen aufrufen)
        //$mealName = $request->input('search');

        //$mealName = trim($validated['search'] ?? '');
        $mealName = trim($request->input('search') ?? '');
        $hasSearched = filled($mealName);


        if(!$hasSearched){
            return view('pages.recipeRecommendation', [
                'meals' => [],
                'hasSearched' => $hasSearched,
                ]);
        }
/*
        if(blank($mealName)){
            return view('pages.recipeRecommendation', ['meals' => []]);
        }
*/

        $baseUrl = 'https://www.themealdb.com';
        $apiPath = '/api/json/v1/1/search.php';

        $mealName = $request->input('search');

        $response = Http::get("{$baseUrl}{$apiPath}", [
            's' => $mealName,
        ]);




        $meals = $response->json()['meals'] ?? [];


        foreach ($meals as &$meal) {
            if(empty($meal['strYoutube'])){
                $searchQue = $meal['strMeal'];
                $meal['strYoutube'] = "https://www.google.com/search?q={$searchQue}";
            }
        }


        return view('pages.recipeREcommendation', [
            'meals' => $meals,
            'hasSearched' => $hasSearched,
        ]);
    }
}
