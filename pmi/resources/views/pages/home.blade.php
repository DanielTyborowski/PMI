@extends('layouts.app')


@section('home')
    <div class="w3-container w3-padding-32">
        <h2><b>My Apps</b></h2>
        <div class="w3-row-padding w3-margin-top">

            {{-- Notes --}}
            <div class="w3-third w3-margin-bottom">
                <a href="{{ route('notes.index') }}" class="w3-text-black">
                    <div class="w3-card w3-hover-shadow w3-padding-32 w3-center">
                        <i class="fa fa-sticky-note w3-xxlarge w3-text-yellow"></i>
                        <h3>Stick it</h3>
                        <p class="w3-text-grey">Manage Notes</p>
                    </div>
                </a>
            </div>

            {{-- Recipes --}}
            <div class="w3-third w3-margin-bottom">
                <a href="{{ route('meals.index') }}" class="w3-text-black">
                    <div class="w3-card w3-hover-shadow w3-padding-32 w3-center">
                        <i class="fa fa-cutlery w3-xxlarge w3-text-green"></i>
                        <h3>Recipes</h3>
                        <p class="w3-text-grey">Search for recipes</p>
                    </div>
                </a>
            </div>

            {{-- Placeholder für weitere Apps --}}
            <div class="w3-third w3-margin-bottom">
                <div class="w3-card w3-padding-32 w3-center w3-light-grey">
                    <i class="fa fa-plus w3-xxlarge w3-text-grey"></i>
                    <h3 class="w3-text-grey">soon available</h3>
                    <p class="w3-text-grey">More apps to follow</p>
                </div>
            </div>

        </div>
    </div>
@endsection
