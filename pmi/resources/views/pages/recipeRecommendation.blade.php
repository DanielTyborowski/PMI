@extends('layouts.app')



@section('recipe-header')
    <div class="w3-container">
        <h1><b>Recipe Recommendation</b></h1>
        <div class="w3-section w3-bottombar w3-padding-16">
            <span class="w3-margin-right">Filter:</span>
            <button class="w3-button w3-black">ALL</button>
            <button class="w3-button w3-white"><i class="fa fa-diamond w3-margin-right"></i>Todo</button>
            <button class="w3-button w3-white w3-hide-small"><i
                    class="fa fa-photo w3-margin-right"></i>Pending</button>
            <button class="w3-button w3-white w3-hide-small"><i
                    class="fa fa-map-pin w3-margin-right"></i>Done</button>
            <button>reihenfolge</button>
        </div>
    </div>
@endsection

