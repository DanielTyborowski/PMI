<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;




/**
 * -----------------------------------------------------------------------------
 * MealController
 * -----------------------------------------------------------------------------
 *
 * Handles meal recommendations and external recipe searches.
 *
 * This controller communicates with TheMealDB API to retrieve meals based on
 * user input and displays the results in the recipe recommendation view.
 *
 * Features:
 *
 * - Validates user search input
 * - Sends requests to an external meal API
 * - Processes API responses
 * - Provides fallback links when no YouTube recipe is available
 */


class MealController extends Controller
{


    /**
     * Display meal recommendations based on a search query.
     *
     * Validates the search input and requests matching meals from TheMealDB API.
     *
     * Workflow:
     *
     * 1. Validate user input
     * 2. Check if a search term was provided
     * 3. Return an empty result on the first page visit
     * 4. Request matching meals from the external API
     * 5. Add fallback search links if no YouTube video exists
     * 6. Return the results to the view
     *
     * @param Request $request Current HTTP request containing the search query
     *
     * @return \Illuminate\View\View
     */
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

        /**
         * Initial page load.
         *
         * When the user opens the page without searching,
         * an empty meal list is returned.
         */
        if (!$hasSearched) {
            return view('pages.recipeRecommendation', [
                'meals' => [],
                'hasSearched' => false,

            ]);
        }
/**
         * Request meals from TheMealDB API.
         *
         * The API searches for meals by name using the "s" parameter.
         */
        $baseUrl = 'https://www.themealdb.com';
        $apiPath = '/api/json/v1/1/search.php';

        $response = Http::get("{$baseUrl}{$apiPath}", [
            's' => $mealName,
        ]);

        /**
         * Extract meals from API response.
         *
         * If no matching meals are found, an empty array is used.
         */
        $meals = $response->json()['meals'] ?? [];

        /**
         * Add fallback links for missing YouTube videos.
         *
         * Some meals do not provide a recipe video.
         * In this case, a Google search link is generated instead.
         */
        foreach ($meals as &$meal) {
            if (empty($meal['strYoutube'])) {
                $searchQue = $meal['strMeal'];
                $meal['strYoutube'] = "https://www.google.com/search?q={$searchQue}";
            }
        }

        /**
         * Return meal recommendations view.
         *
         * Variables passed to the view:
         *
         * - meals:
         *   List of found meals
         *
         * - hasSearched:
         *   Indicates whether the user performed a search
         */
        return view('pages.recipeRecommendation', [
            'meals' => $meals,
            'hasSearched' => $hasSearched,
        ]);
    }
}
