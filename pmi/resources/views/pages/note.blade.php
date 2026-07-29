@extends('layouts.app')



@section('note-header')
    <div class="w3-container">
        <h1><b>Stick it</b></h1>
        <div class="w3-section w3-bottombar w3-padding-16">
            <span class="w3-margin-right">Filter:</span>
            <button class="w3-button w3-black">ALL</button>
            <button class="w3-button w3-white"><i class="fa fa-diamond w3-margin-right"></i>Todo</button>
            <button class="w3-button w3-white w3-hide-small"><i class="fa fa-photo w3-margin-right"></i>Pending</button>
            <button class="w3-button w3-white w3-hide-small"><i class="fa fa-map-pin w3-margin-right"></i>Done</button>
            <button>reihenfolge</button>
        </div>
    </div>
@endsection


@section('note-header-new')


    <div class="w3-container">
        <h1><b>Stick it</b></h1>
        <div class="w3-section w3-bottombar w3-padding-16">
            <span class="w3-margin-right">Filter:</span>
            <a href="{{ route('resource.index') }}">
                <button class="w3-button w3 {{ $filter === null ? 'w3-black' : 'w3-white' }}">
                    ALL
                </button>
            </a>
            <a href="{{ route('resource.index', ['filter' => 'todo']) }}">
                <button class="w3-button  {{ $filter === 'todo' ? 'w3-black' : 'w3-white' }}">
                    Todo
                </button>
            </a>

            <a href="{{ route('resource.index', ['filter' => 'done']) }}">
                <button class="w3-button {{ $filter === 'done' ? 'w3-black' : 'w3-white' }}">
                    Done
                </button>
            </a>

        </div>
        <div class="w3-section w3-bottombar w3-padding-16">
            <span>Reihenfolge:</span>
            <a href="{{ route('resource.index', ['filter' => $filter, 'sort' => 'id', 'order' => 'desc']) }}">
                <button class="w3-button {{ $sortOrder === 'desc' ? 'w3-black' : 'w3-white' }}">
                    Neueste
                </button>
            </a>

            <a href="{{ route('resource.index', ['filter' => $filter, 'sort' => 'id', 'order' => 'asc']) }}">
                <button class="w3-button {{ $sortOrder === 'asc' ? 'w3-black' : 'w3-white' }}">
                    Älteste
                </button>
            </a>
        </div>
    </div>

@endsection

@section('note-grid')
    <div class="note-content-container ">



        {{-- @foreach ($notes as $note)
            @if ($note->status === $filter)
                <x-note-card :note="$note" :editing="$editingId !== null && $editingId === $note->id" />
            @endif
        @endforeach --}}
        @foreach ($notes as $note)
                <x-note-card
                    :note="$note"
                    :editing="$editingId !== null && $editingId === $note->id" />
            @endforeach

        {{-- Neue leere Karte --}}
        @if (isset($newNote) && $newNote)
            <x-note-card :new="true" />
        @endif
        <div class="note-card-add-container">
            <a href="{{ route('resource.create') }}">
                <button class="note-card-add-button">➕</button>
            </a>
        </div>


    </div>
@endsection
