<?php

namespace App\Http\Controllers;

/**
 * Handles requests for the application's home page.
 */

class HomeController extends Controller
{

    /**
     * Display the home page.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        return view('pages.home');
    }
}
