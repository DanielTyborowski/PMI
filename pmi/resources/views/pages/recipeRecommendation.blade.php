@extends('layouts.app')



@section('recipe-header')
    <div class="w3-container">
        <h1><b>Recipe Recommendation</b></h1>
        <div class="w3-section w3-bottombar w3-padding-16">
            <form action="{{ route('meals.index') }}" method="GET">
                <input type="text" name="search" placeholder="Search for a meal..." value="{{ request('search') }}">
                <button type="submit">Search</button>
            </form>
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            {{-- <span class="w3-margin-right">Suche:</span>
            <input type="text" name="" id=""> --}}
        </div>
    </div>


@endsection



@section('meals')
    @forelse ($meals as $meal)
        <div>
            <h2>{{ $meal['strMeal'] ?? 'No meal name available' }}</h2>

            <img src="{{ $meal['strMealThumb'] }}" alt="{{ $meal['strMeal'] }}" width="300">

            <p><strong>Kategorie:</strong> {{ $meal['strCategory'] ?? 'No category available' }}</p>
            <p><strong>Tags:</strong> {{ $meal['strTags'] ?? 'No tags available' }}</p>
            <p><strong>Herkunft:</strong> {{ $meal['strArea'] ?? 'No origin available' }}</p>
            <p>{{ $meal['strInstructions'] ?? 'No instructions available' }}</p>
            <a href="{{ $meal['strYoutube'] ?? '#' }}" target="_blank">Link</a>
        </div>
    @empty
        @if ($hasSearched)
            <p>Es wurde kein Rezept gefunden, bitte gib etwas anderes ein.</p>
        @else
            <p>Bitte gib etwas in die Suche ein</p>
        @endif
    @endforelse
@endsection
