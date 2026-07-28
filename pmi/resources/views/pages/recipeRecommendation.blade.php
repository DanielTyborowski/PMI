@extends('layouts.app')



@section('recipe-header')
    <div class="w3-container">
        <h1><b>Recipe Recommendation</b></h1>
        <div class="w3-section w3-bottombar w3-padding-16">
            <span class="w3-margin-right">Suche:</span>
            <input type="text" name="" id="">
        </div>
    </div>
@endsection



@section('meals')



@foreach($meals as $meal)
    <div>
        <h2>{{ $meal['strMeal'] }}</h2>

        <img src="{{ $meal['strMealThumb'] }}" alt="{{ $meal['strMeal'] }}" width="300">

        <p><strong>Kategorie:</strong> {{ $meal['strCategory'] }}</p>
        <p><strong>Tags:</strong> {{ $meal['strTags'] }}</p>
        <p><strong>Herkunft:</strong> {{ $meal['strArea'] }}</p>
        <p>{{ $meal['strInstructions'] }}</p>
        <a href="{{$meal['strYoutube']}}">Link</a>
    </div>
@endforeach

@endsection
