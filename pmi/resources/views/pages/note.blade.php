@extends('layouts.app')


@section('note-header-new')
    <div class="page-container">
        <h1 class="page-title"><b>Stick it</b></h1>
        <div class="filter-controls">
            <span class="filter-label">Filter:</span>
            {{-- nicht value='null' ':' muss mit, da sonst string null --}}
            <x-filter-button :value='null' label='All' :filter="$filter" />
            <x-filter-button value='todo' label='Todo' :filter="$filter" />
            <x-filter-button value='done' label='Done' :filter="$filter" />
        </div>
        <div class="sort-controls">
            <span class="filter-label">Sort:</span>

            <x-sort-button column='id' label="Id" :currentSortBy="$sortBy" :currentSortOrder="$sortOrder" />
            <x-sort-button column='created_at' label="created at" :currentSortBy="$sortBy" :currentSortOrder="$sortOrder" />
            <x-sort-button column='updated_at' label="updated at" :currentSortBy="$sortBy" :currentSortOrder="$sortOrder" />

        </div>
    </div>
@endsection

@section('note-grid')
    <div class="note-content-container ">

        @foreach ($notes as $note)
                <x-note-card
                    :note="$note"
                    :editing="$editingId !== null && $editingId === $note->id" />
        @endforeach

        {{-- Neue leere Karte --}}
        @if (isset($newNote) && $newNote)
            <x-note-card :new="true" />
        @endif

        {{-- Button to add a new note --}}
        <div class="note-card-add-container">
            <a href="{{ route('resource.create', request()->query() ) }}">
                <button class="note-card-add-button"><i class="fa fa-plus w3-xxlarge w3-text-grey"></i></button>
            </a>
        </div>


    </div>
@endsection
