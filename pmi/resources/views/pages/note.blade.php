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


    <div class="page-container">
        <h1 class="page-title"><b>Stick it</b></h1>
        <div class="filter-controls">
            <span class="filter-label">Filter:</span>
            <a href="{{ route('resource.index', array_merge(request()->query(), ['filter' => null])) }}"
            class="filter-button {{ $filter === null ? 'filter-active' : '' }}">
                ALL
            </a>
            <a href="{{ route('resource.index', array_merge(request()->query(), ['filter' => 'todo'])) }}"
            class="filter-button {{ $filter === 'todo' ? 'filter-active' : '' }}">
                Todo
            </a>
            <a href="{{ route('resource.index', array_merge(request()->query(), ['filter' => 'done'])) }}"
            class="filter-button {{ $filter === 'done' ? 'filter-active' : '' }}">
                Done
            </a>
        </div>
        <div class="sort-controls">
            <span class="filter-label">Sort:</span>

            @php
                $nextOrderId = ($sortBy === 'id' && $sortOrder === 'desc') ? 'asc' : 'desc';
                $nextOrderCreated = ($sortBy === 'created_at' && $sortOrder === 'desc') ? 'asc' : 'desc';
                $nextOrderUpdated = ($sortBy === 'updated_at' && $sortOrder === 'desc') ? 'asc' : 'desc';
            @endphp
            <a href="{{ route('resource.index', array_merge(request()->query(), ['sort' => 'id', 'order' => $nextOrderId])) }}"
            class="{{ $sortBy === 'id' ? 'sort-active' : '' }}">
                Nach ID {{ $sortBy === 'id' ? ($sortOrder === 'desc' ? '↓' : '↑') : '' }}
            </a>

            @php
                $nextOrder = ($sortBy === 'created_at' && $sortOrder === 'desc') ? 'asc' : 'desc';
            @endphp

            <a href="{{ route('resource.index', array_merge(request()->query(), ['sort' => 'created_at', 'order' => $nextOrderCreated])) }}"
            class="{{ $sortBy === 'created_at' ? 'sort-active' : '' }}">
                Nach Erstellungsdatum {{ $sortBy === 'created_at' ? ($sortOrder === 'desc' ? '↓' : '↑') : '' }}
            </a>

            <a href="{{ route('resource.index', array_merge(request()->query(), ['sort' => 'updated_at', 'order' => $nextOrderUpdated])) }}"
            class="{{ $sortBy === 'updated_at' ? 'sort-active' : '' }}">
                Nach Bearbeitungsdatum {{ $sortBy === 'updated_at' ? ($sortOrder === 'desc' ? '↓' : '↑') : '' }}
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
                <button class="note-card-add-button"><i class="fa fa-plus w3-xxlarge w3-text-grey"></i></button>
            </a>
        </div>


    </div>
@endsection
