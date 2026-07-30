@extends('layouts.app')



@section('recipe-header')
    <div class="w3-container">
        <h1><b>What can I eat?</b></h1>
        <div class="meal-search-container">
            <form action="{{ route('meals.index') }}" method="GET">
                <input class='meal-search-input' type="text" name="search" placeholder="Search for a meal..." value="{{ request('search') }}">
                <button class="meal-search-button" type="submit">Search</button>
            </form>
            @if ($errors->any())
                <div class="alert-alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li class="alert-alert-danger">{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

        </div>
    </div>
@endsection

@section('meals')
    @forelse ($meals as $meal )
        <div class="meal-card">
            {{-- Card Top --}}
            <div class="meal-card-top" >
                <div class="meal-card-top-left">
                    <div class="meal-card-top-title">
                        <h2>{{ $meal['strMeal'] ?? 'No meal name available' }}</h2>
                    </div>
                    <div class="meal-card-top-image">
                        <img src="{{ $meal['strMealThumb'] }}" alt="{{ $meal['strMeal'] }}" height="300">
                    </div>
                </div>
                <div class="meal-card-top-right">
                    <p><strong>Category:</strong> {{ $meal['strCategory'] ?? 'No category available' }}</p>
                    <p><strong>Tags:</strong> {{ $meal['strTags'] ?? 'No tags available' }}</p>
                    <p><strong>Origin:</strong> {{ $meal['strArea'] ?? 'No origin available' }}</p>
                    @if (str_contains($meal['strYoutube'] ?? '', 'youtube'))
                        <p><strong>Youtube:</strong> <a href="{{ $meal['strYoutube'] }}" target="_blank">▶️ Video tutorial</a></p>
                    @else
                        <p><strong>Google:</strong> <a href="{{ $meal['strYoutube'] ?? '#' }}" target="_blank">🔍 Google search</a></p>
                    @endif
                </div>
            </div>
            {{-- Card Bottom --}}
            <div class="meal-card-bottom" >
                <div class="meal-card-bottom-instruction">
                    <h4>Instruction:</h4>
                    <p>{{ $meal['strInstructions'] ?? 'No instructions available' }}</p>
                </div>
            </div>
        </div>
    @empty
        @if ($hasSearched)
            <div class="meal-card">
                <div class="meal-card-bottom" >
                    <p>No recipe was found. Please enter something else.</p>
                </div>
            </div>
        @else
            <div class="meal-card">
                <div class="meal-card-bottom" >
                    <p>Please enter something in the search box</p>
                </div>
            </div>
        @endif
    @endforelse

@endsection
